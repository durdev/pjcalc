<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeStatusRequest;
use App\Http\Requests\IncomeRequest;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::all();

        return view('income.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\IncomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeRequest $request)
    {
        Income::create($request->validated());

        return redirect()->route('incomes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        return view('income.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IncomeRequest  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeRequest $request, Income $income)
    {
        $income->fill($request->validated());
        $income->save();

        return redirect()->route('incomes.index');
    }

    /**
     * Update the specified status resource in storage.
     *
     * @param  \App\Http\Requests\IncomeRequest  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(IncomeStatusRequest $request, Income $income)
    {
        $income->is_done = $request->validated()['status'] ?? false;
        $income->save();

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->delete();

        return redirect()->route('incomes.index');
    }

}
