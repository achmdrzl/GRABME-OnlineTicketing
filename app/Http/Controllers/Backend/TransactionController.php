<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function transactionIndex(Request $request)
    {
        if ($request->ajax()) {

            $transaction = Transaction::with(['user', 'transaksiDetail.ticketCategory', 'event'])->get();
            return DataTables::of($transaction)
                ->addIndexColumn()
                ->addColumn('order_id', function ($data) {
                    return Str::limit($data->order_id, 15);
                })
                ->addColumn('name_event', function ($data) {
                    return ucfirst($data->event->event_name);
                })
                ->addColumn('user', function ($data) {
                    return (ucfirst($data->user->name));
                })
                ->addColumn('total_payment', function ($data) {
                    return ' Rp.' . number_format($data->total_payment);
                })
                ->addColumn('status_payment', function ($data) {
                    if ($data->status_payment == 'settlement') {
                        return '<div class="btn btn-success">' . ucfirst($data->status_payment) . '</div>';
                    } elseif ($data->status_payment == 'pending') {
                        return '<div class="btn btn-warning">' . ucfirst($data->status_payment) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($data->status_payment) . '</div>';
                    }
                })
                ->addColumn('status_cetak', function ($data) {
                    if ($data->cetak == 'sudah') {
                        return '<div class="btn btn-success">' . ucfirst($data->cetak) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($data->cetak) . '</div>';
                    }
                })
                ->addColumn('action', function ($data) {

                    $btn = '<button id="tf-update" data-id="' . $data->tf_id . '" class="btn btn-success btn-sm ms-1" title="Update Status Event"><i class="mdi mdi-pencil"></i></button>';

                    $btn = $btn . '<button id="transaction-show" data-id="' . $data->tf_id . '" class="btn btn-primary btn-sm ms-1" title="Show"><i class="mdi mdi-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['status_cetak', 'status_payment', 'action'])
                ->make(true);
        }

        return view('backend.transaction.index-transaction');
    }

    public function showTransaction(Request $request)
    {
        return view('backend.transaction.show-transaction');
    }

    // public function getDetailTransaction($id)
    // {
    //     $getauditors   =   Events::all();

    //     $auditors    =   [];
    //     foreach ($getauditors as $row) {
    //         $id     =   $row->auditor_id;
    //         $nama   =   $row->auditor_nama;
    //         $tlp    =   $row->auditor_tlp;
    //         $email  =   $row->auditor_email;
    //         $npp    =   $row->auditor_npp;

    //         $action     =   '<a class="btn btn-outline-primary" href="/profil-auditor-ia">Lihat detail<i class="ms-2 icon-md" data-feather="eye"></i>';

    //         $auditors[]     =   [
    //             'id'        =>  $id,
    //             'nama'      =>  $nama,
    //             'tlp'       =>  $tlp,
    //             'email'     =>  $email,
    //             'npp'       =>  $npp,
    //             'action'    =>  $action
    //         ];
    //     }

    //     return DataTables::of($auditors)->toJson();
    // }

    public function getDetailTransaction(Request $request)
    {
        $data = Transaction::with(['user', 'event', 'transaksiDetail.ticketCategory'])->where('tf_id', $request->tf_id)->first();

        return response()->json($data);
    }

    public function updateCetak(Request $request)
    {
        $data = Transaction::find($request->tf_id);

        if ($data->cetak == 'belum') {
            $data->update([
                'cetak' => 'sudah',
            ]);
        } else {
            $data->update([
                'cetak' => 'belum',
            ]);
        }

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Successfully Update the Data!',
        ]);
    }

    public function eventTransaction(Request $request)
    {
        if ($request->ajax()) {

            $events = Events::latest()->get();
            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('event_name', function ($event) {
                    return (ucfirst($event->event_name));
                })
                ->addColumn('date_held', function ($event) {
                    $date = date('d F Y', strtotime($event->date_held));

                    $date = $date . ' | ' . date('h:i:sa', strtotime($event->date_held));

                    return $date;
                })
                ->addColumn('event_location', function ($event) {
                    return (ucfirst($event->location_held));
                })
                ->addColumn('event_status', function ($event) {
                    if ($event->event_status == 'listing') {
                        return '<div class="btn btn-secondary">' . ucfirst($event->event_status) . '</div>';
                    } elseif ($event->event_status == 'archive') {
                        return '<div class="btn btn-danger">' . ucfirst($event->event_status) . '</div>';
                    } elseif ($event->event_status == 'publish') {
                        return '<div class="btn btn-info">' . ucfirst($event->event_status) . '</div>';
                    } else {
                        return '<div class="btn btn-success">' . ucfirst($event->event_status) . '</div>';
                    }
                })
                ->addColumn('action', function ($event) {

                    $btn = '<button id="event-show" data-id="' . $event->event_id . '" class="btn btn-primary btn-sm ms-1" title="Show"><i class="mdi mdi-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['event_status', 'action'])
                ->make(true);
        }

        return view('backend.transaction.event-transaction');
    }

    public function transactionGetData(Request $request)
    {
        $transaction = Transaction::with(['user', 'event', 'transaksiDetail.ticketCategory'])->where('event_id', $request->event_id)->first();

        return response()->json($transaction);
    }

    public function transactionShow($id, Request $request)
    {
        if ($request->ajax()) {

            $transaction = Transaction::with(['user', 'transaksiDetail.ticketCategory', 'event'])->where('event_id', $id)->where('status_payment', 'settlement')->get();
            return DataTables::of($transaction)
                ->addIndexColumn()
                ->addColumn('order_id', function ($data) {
                    return Str::limit($data->order_id, 15);
                })
                ->addColumn('name_event', function ($data) {
                    return ucfirst($data->event->event_name);
                })
                ->addColumn('user', function ($data) {
                    return (ucfirst($data->user->name));
                })
                ->addColumn('internet_tax', function ($data) {
                    return ' Rp.' . number_format($data->internet_tax);
                })
                ->addColumn('total_payment', function ($data) {
                    return ' Rp.' . number_format($data->total_payment - $data->internet_tax);
                })
                ->addColumn('status_payment', function ($data) {
                    if ($data->status_payment == 'settlement') {
                        return '<div class="btn btn-success">' . ucfirst($data->status_payment) . '</div>';
                    } elseif ($data->status_payment == 'pending') {
                        return '<div class="btn btn-warning">' . ucfirst($data->status_payment) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($data->status_payment) . '</div>';
                    }
                })
                ->addColumn('status_cetak', function ($data) {
                    if ($data->cetak == 'sudah') {
                        return '<div class="btn btn-success">' . ucfirst($data->cetak) . '</div>';
                    } else {
                        return '<div class="btn btn-danger">' . ucfirst($data->cetak) . '</div>';
                    }
                })
                ->addColumn('action', function ($data) {

                    $btn = '<button id="tf-update" data-id="' . $data->tf_id . '" class="btn btn-success btn-sm ms-1" title="Update Status Event"><i class="mdi mdi-pencil"></i></button>';

                    $btn = $btn . '<button id="transaction-show" data-id="' . $data->tf_id . '" class="btn btn-primary btn-sm ms-1" title="Show"><i class="mdi mdi-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['status_cetak', 'status_payment', 'action'])
                ->make(true);
        }
        
        $tax = Transaction::with(['user', 'transaksiDetail.ticketCategory', 'event'])->where('event_id', $id)->where('status_payment', 'settlement')->sum('internet_tax');
        $total_payment = Transaction::with(['user', 'transaksiDetail.ticketCategory', 'event'])->where('event_id', $id)->where('status_payment', 'settlement')->sum('total_payment');

        return view('backend.transaction.show-transaction', compact('id', 'total_payment', 'tax'));
    }
}
