<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentOption;

class PaymentOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paymentOptions = PaymentOption::orderBy('created_at', 'desc')->paginate(10);

        return view('pages.payment-options.index', compact('paymentOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.payment-options.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
        ]);

        $paymentRequest = $request->all();

        $paymentOption = PaymentOption::create(
            $paymentRequest
        );

        return redirect()->route('payment-options.index')
            ->with('success', 'Meio de pagamento cadastrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentOption = PaymentOption::find($id);

        return view('pages.payment-options.edit', compact('paymentOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
        ]);

        $payment = PaymentOption::find($id);

        $paymentRequest = $request->all();

        $payment->update($paymentRequest);

        return redirect()->route('payment-options.index')
            ->with('success', 'Meio de pagamento cadastrado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentOption = PaymentOption::find($id);
        $paymentOption->delete();
        return redirect()->back()->with('success', 'Meio de pagamento apagado');
    }
}
