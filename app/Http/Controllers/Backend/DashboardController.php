<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'user')->count();
        $transaction = Transaction::where('status_payment', 'settlement')->count();
        $event = Events::count();

        return view('backend.dashboard', compact('user', 'transaction', 'event'));
    }
}
