<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $start_of_month = now()->startOfMonth();

        $unpaid_expenses = Expense::where('created_at', '>=', $start_of_month->toDateTimeString())
            ->where('is_done', false)
            ->get();
        $paid_expenses   = Expense::where('created_at', '>=', $start_of_month->toDateTimeString())
            ->where('is_done', true)
            ->get();
        $paid_incomes    = Income::where('created_at', '>=', $start_of_month->toDateTimeString())
            ->where('is_done', true)
            ->get();
        $unpaid_incomes  = Income::where('created_at', '>=', $start_of_month->toDateTimeString())
            ->where('is_done', false)
            ->get();

        $in_alert_categories = DB::table('categories')
            ->selectRaw('categories.id, categories.name, categories.alert_value, sum(expenses.value) expenses_sum')
            ->join('expenses', 'categories.id', '=', 'expenses.category_id')
            ->where('expenses.created_at', '>=', $start_of_month->toDateTimeString())
            ->groupByRaw('categories.id, categories.name, categories.alert_value')
            ->havingRaw('sum(expenses.value) > categories.alert_value')
            ->get();

        return view('dashboard', compact('unpaid_expenses', 'unpaid_incomes', 'paid_expenses', 'paid_incomes', 'in_alert_categories'));
    }

}
