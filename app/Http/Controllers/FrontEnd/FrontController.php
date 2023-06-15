<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Profile;
use App\Models\TicketCategory;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use App\Models\User;
use App\Rules\OldPasswordRule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FrontController extends Controller
{
    public function index()
    {
        $event = Events::where('event_status', 'publish')->orderBy('created_at', 'desc')->get();
        return view('frontend.index', compact('event'));
    }

    public function eventDetails($slug)
    {
        $event = Events::with(['user', 'ticketCategory', 'eventTalent'])->where('slug', $slug)->first();
        $id = $event->event_id;
        return view('frontend.order.event-details', compact('event', 'id'));
    }

    public function getTicketCategory(Request $request)
    {
        $ticketCategory = TicketCategory::where('event_id', $request->event_id)->get();

        return response()->json($ticketCategory);
    }

    public function getTotal(Request $request)
    {
        $category = TicketCategory::where('ticket_category_id', $request->ticket_category_id)->first();
        return response()->json($category);
    }

    public function checkoutTicket(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'amount_ticket' => 'required|array|min:1',
        ], [
            // 'temuan_judul.required' => 'Temuan Wajib di Isi!',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $event = Events::find($request->event_id);
        $ticketCategory = TicketCategory::whereIn('ticket_category_id', $request->ticket_category_id)->pluck('ticket_category_name');
        $char_to_remove = '"';
        $new_string = str_replace($char_to_remove, "", $ticketCategory);
        $char_to_remove2 = '[';
        $new_string2 = str_replace($char_to_remove2, "", $new_string);
        $char_to_remove3 = ']';
        $new_string3 = str_replace($char_to_remove3, "", $new_string2);
        $category = explode(",", $new_string3);

        $priceCategory = TicketCategory::whereIn('ticket_category_id', $request->ticket_category_id)->pluck('ticket_category_price');
        $new_string4 = str_replace($char_to_remove, "", $priceCategory);
        $new_string5 = str_replace($char_to_remove2, "", $new_string4);
        $new_string6 = str_replace($char_to_remove3, "", $new_string5);
        $price = explode(",", $new_string6);

        $min = 7000;
        $max = 8000;
        $tax = rand($min, $max);

        $data = [
            // show data
            'event' => $event,
            'internetTax' => $tax,
            'ticketCategory' => $category,
            'price' => $price,

            // store data
            'event_id' => $request->event_id,
            'ticket_category_id' => $request->ticket_category_id,
            'amount_ticket' => $request->amount_ticket,
            'totalPrice' => $request->totalPrice,
        ];

        session(['data' => $data]);

        // $redirect_url = route('confirm.order', ['data' => $data]);
        $redirect_url = route('confirm.order');
        return response()->json([
            'data' => $data,
            'success' => true,
            'redirect_url' => $redirect_url,
        ]);
    }

    public function confirmOrder()
    {
        return view('frontend.order.checkout');
    }

    public function dashboardUser()
    {
        return view('frontend.user.user-dashboard');
    }

    public function getRegisUser()
    {
        $user = User::with(['profile'])->where('user_id', Auth::user()->user_id)->first();
        return response()->json($user);
    }

    public function updateUserData(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'date_birthday' => 'required',
            'gender' => 'required|in:male,female',
            'address' => 'required',
            'job' => 'required',
        ], [
            'name.required' => 'Name must be included!',
            'email.required' => 'Email must be included!',
            'phone_number.required' => 'Mobile No must be included!',
            'date_birthday.required' => 'Date Birthday must be included!',
            'gender.required' => 'Gender must be included!',
            'job.required' => 'Job must be included!',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = User::updateOrCreate([
            'user_id' => $request->user_id
        ], [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        $profile = Profile::updateOrCreate([
            'user_id' => $request->user_id
        ], [
            'date_birthday' => $request->date_birthday,
            'gender' => $request->gender,
            'address' => $request->address,
            'job' => $request->job,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Saving the Data!',
        ]);
    }

    public function order(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'date_birthday' => 'required',
            'gender' => 'required|in:male,female',
            'address' => 'required',
            'job' => 'required',
        ], [
            'name.required' => 'Name must be included!',
            'email.required' => 'Email must be included!',
            'phone_number.required' => 'Mobile No must be included!',
            'date_birthday.required' => 'Date Birthday must be included!',
            'gender.required' => 'Gender must be included!',
            'job.required' => 'Job must be included!',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $session = session('data');

        $user = User::updateOrCreate([
            'user_id' => Auth::user()->user_id,
        ], [
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        $profile = Profile::updateOrCreate([
            'user_id' => Auth::user()->user_id,
        ], [
            'gender' => $request->gender,
            'date_birthday' => $request->date_birthday,
            'address' => $request->address,
            'job' => $request->job,
        ]);

        $randomString = Str::random(8);
        $order_id = md5($randomString);

        $transaction = Transaction::create([
            'order_id' => $order_id,
            'total_payment' => $session['totalPrice'] + $session['internetTax'],
            'internet_tax' => $session['internetTax'],
            'user_id' => Auth::user()->user_id,
            'event_id' => $session['event_id'],
        ]);

        for ($x = 0; $x < count($session['ticket_category_id']); $x++) {
            $transactionDetails = TransactionDetails::create([
                'ticket_category_id' => $session['ticket_category_id'][$x],
                'amount_ticket' => $session['amount_ticket'][$x],
                'total_ticket' => $session['price'][$x],
                'tf_id' => $transaction->tf_id,
            ]);
        }

        $event = Events::find($session['event_id']);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $item = [
            'id' => 1,
            'name' => 'Pembelian Tiket ' . $event->event_name . ', Jumlah Tiket x' . array_sum($session['amount_ticket']),
            'price' => $session['totalPrice'] + $session['internetTax'],
            'quantity' => 1,
        ];

        $transactionDetails = [
            'order_id' => $order_id,
            'gross_amount' => $session['totalPrice'] + $session['internetTax'],
        ];

        // Customer details
        $customerDetails = [
            'first_name' => Auth::user()->name,
            'last_name' => '',
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone_number,
        ];

        // Create transaction request
        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => [$item],
            'customer_details' => $customerDetails
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);

        //return response
        return response()->json([
            'snapToken' => $snapToken,
            'success' => true,
            'message' => 'Successfully Saving the Transaction Data!',
        ]);
    }

    public function continueOrder(Request $request)
    {
        $data = Transaction::with(['event', 'transaksiDetail'])->where('tf_id', $request->tf_id)->first();

        $randomString = Str::random(15);
        $order_id = md5($randomString);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        $item = [
            'id' => 1,
            'name' => 'Pembelian Tiket ' . $data->event->event_name . ', Jumlah Tiket x' . $data->transaksiDetail->sum('amount_ticket'),
            'price' => $data->total_payment,
            'quantity' => 1,
        ];

        $transactionDetails = [
            'order_id' => $order_id,
            'gross_amount' => $data->total_payment,
        ];

        // Customer details
        $customerDetails = [
            'first_name' => Auth::user()->name,
            'last_name' => '',
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone_number,
        ];

        // Create transaction request
        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => [$item],
            'customer_details' => $customerDetails
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);

        //return response
        return response()->json([
            'snapToken' => $snapToken,
            'success' => true,
            'message' => 'Successfully Saving the Transaction Data!',
        ]);
    }

    public function history()
    {
        $transaction = Transaction::with(['transaksiDetail', 'event'])->where('user_id', Auth::user()->user_id)->orderBy('created_at', 'desc')->get();

        return view('frontend.user.transaction-history', compact('transaction'));
    }

    public function detailTransaction($order_id)
    {
        $data = Transaction::with(['event', 'transaksiDetail.ticketCategory'])->where('order_id', $order_id)->first();

        return view('frontend.user.detail-transaction', compact('data'));
    }

    public function cancelOrder(Request $request)
    {
        $data = Transaction::where('order_id', $request->order_id)->first();
        $data->update([
            'status_payment' => 'cancel'
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Cancel the Order!',
        ]);
    }

    public function ticketIndex()
    {
        $data = Transaction::with(['transaksiDetail', 'event'])->where('user_id', Auth::user()->user_id)->where('status_payment', 'settlement')->orderBy('created_at', 'desc')->get();

        return view('frontend.user.user-tickets', compact('data'));
    }

    public function deleteSession(Request $request)
    {
        $sessionKey = $request->session_key;

        // Delete the specified session key
        Session::forget($sessionKey);
        Session::forget('order_id');

        $transaction = Transaction::where('user_id', Auth::user()->user_id)->get();

        foreach ($transaction as $item) {
            if ($item->transaction_id == null) {
                $item->delete();
            }
        }

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Saving the Transaction Data!',
        ]);
    }

    public function deleteTransaction()
    {
        $transaction = Transaction::where('user_id', Auth::user()->user_id)->get();

        foreach ($transaction as $item) {
            if ($item->transaction_id == null) {
                $item->delete();
            }
        }
        //return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function updatePasswordUser(Request $request)
    {
        // define validation rules
        $validator = Validator::make($request->all(), [
            'old_password' =>
            [
                'required',
                new OldPasswordRule(),
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = User::updateOrCreate([
            'user_id' => $request->user_id
        ], [
            'password' => Hash::make($request->password),
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Saving the Data!',
        ]);
    }

    public function etiket($order_id)
    {
        $data1 = Transaction::with(['user'])->where('order_id', $order_id)->first();

        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('https://e2a3-180-253-105-68.ngrok-free.app/show-ticket/' . $data1->order_id));

        $customPaper = array(0, 0, 720, 1440);

        $data["email"] = $data1->user->email;
        $data["qrcode"] = $qrcode;

        $pdf = pdf::loadView('frontend.order.etiket', ['qrcode' => $data['qrcode']])->setPaper($customPaper, 'portrait');

        Mail::send('frontend.order.etiket', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"])
                ->subject("E-ticket")
                ->attachData($pdf->output(), "E-ticket.pdf");
        });

        return $pdf->download($data1->order_id . '.pdf');

        // return $pdf->download('Table - ' . strtoupper($table->no_table) . '.pdf');
    }

    public function showTicket($order_id)
    {
        $data = Transaction::with(['user', 'event', 'transaksiDetail.ticketCategory'])->where('order_id', $order_id)->first();

        return view('frontend.user.show-ticket', compact('data'));
    }
}
