<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\Category;

class BillController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();

        return view('bill.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories  = Category::all();
        $recurrences = Bill::getRecurrences();

        return view('bill.create', compact('recurrences', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
        Bill::create($request->validated());

        return redirect()->route('bills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        $categories  = Category::all();
        $recurrences = Bill::getRecurrences();

        return view('bill.edit', compact('bill', 'recurrences', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BillRequest  $request
     * @param  \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function update(BillRequest $request, Bill $bill)
    {
        $bill->fill($request->validated());
        $bill->save();

        return redirect()->route('bills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();

        return redirect()->route('bills.index');
    }

}
