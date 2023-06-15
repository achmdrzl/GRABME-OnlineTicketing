<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PdfEmail;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaymentController extends Controller
{
    public function callbackPayment(Request $request)
    {
        $server_key = config('midtrans.server_key');
        $signature_key = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $server_key);

        if ($signature_key == $request->signature_key) {
            if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
                $transaction = Transaction::where('order_id', $request->order_id)->update([
                    'transaction_id' => $request->transaction_id,
                    'order_id' => $request->order_id,
                    'payment_type' => $request->payment_type,
                    'status_payment' => 'settlement',
                    'expiry_time' => $request->expiry_time,
                    'bank' => isset($request->va_numbers[0]['bank']) ? $request->va_numbers[0]['bank'] : null,
                    'va_number' => isset($request->va_numbers[0]['va_number']) ? $request->va_numbers[0]['va_number'] : null,
                    'permata_va_number' => isset($request->permata_va_number) ? $request->permata_va_number : null,
                    'merchant_id' => isset($request->merchant_id) ? $request->merchant_id : null,
                    'reference_id' => isset($request->reference_id) ? $request->reference_id : null,
                    'signature_key' => isset($request->signature_key) ? $request->signature_key : null,
                ]);

                // Sending Email
                $data1 = Transaction::with(['user'])->where('order_id', $request->order_id)->first();

                // generate qr code
                $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('https://e2a3-180-253-105-68.ngrok-free.app/show-ticket/' . $data1->order_id));

                // custom paper
                $customPaper = array(0, 0, 720, 1440);

                // define data
                $data["email"] = $data1->user->email;
                $data["qrcode"] = $qrcode;

                // generate pdf
                $pdf = pdf::loadView('frontend.order.etiket', ['qrcode' => $data['qrcode']])->setPaper($customPaper, 'portrait');

                // sending the email
                Mail::send('frontend.order.etiket', $data, function ($message) use ($data, $pdf) {
                    $message->to($data["email"])
                        ->subject("E-ticket")
                        ->attachData($pdf->output(), "E-ticket.pdf");
                });
            } elseif ($request->transaction_status == 'pending') {
                $transaction = Transaction::where('order_id', $request->order_id)->update([
                    'transaction_id' => $request->transaction_id,
                    'order_id' => $request->order_id,
                    'payment_type' => $request->payment_type,
                    'status_payment' => 'pending',
                    'expiry_time' => $request->expiry_time,
                    'bank' => isset($request->va_numbers[0]['bank']) ? $request->va_numbers[0]['bank'] : null,
                    'va_number' => isset($request->va_numbers[0]['va_number']) ? $request->va_numbers[0]['va_number'] : null,
                    'permata_va_number' => isset($request->permata_va_number) ? $request->permata_va_number : null,
                    'merchant_id' => isset($request->merchant_id) ? $request->merchant_id : null,
                    'signature_key' => isset($request->signature_key) ? $request->signature_key : null,
                    'reference_id' => isset($request->reference_id) ? $request->reference_id : null,
                ]);
            } else {
                $transaction = Transaction::where('order_id', $request->order_id)->update([
                    'transaction_id' => $request->transaction_id,
                    'order_id' => $request->order_id,
                    'payment_type' => $request->payment_type,
                    'status_payment' => 'expire',
                    'expiry_time' => $request->expiry_time,
                    'bank' => isset($request->va_numbers[0]['bank']) ? $request->va_numbers[0]['bank'] : null,
                    'va_number' => isset($request->va_numbers[0]['va_number']) ? $request->va_numbers[0]['va_number'] : null,
                    'permata_va_number' => isset($request->permata_va_number) ? $request->permata_va_number : null,
                    'merchant_id' => isset($request->merchant_id) ? $request->merchant_id : null,
                    'reference_id' => isset($request->reference_id) ? $request->reference_id : null,
                    'signature_key' => isset($request->signature_key) ? $request->signature_key : null,
                ]);
            }
        }
    }
}
