<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $start_of_month = now()->startOfMonth();

        $expenses      = Expense::where('created_at', '>=', $start_of_month->toDateTimeString())->where('is_done', false)->get();
        $paid_expenses = Expense::where('is_done', true)->get();
        $paid_incomes  = Income::where('is_done', true)->get();
        $incomes       = Income::where('created_at', '>=', $start_of_month->toDateTimeString())->where('is_done', false)->get();

        return view('dashboard', compact('expenses', 'incomes', 'paid_expenses', 'paid_incomes'));
    }

}
