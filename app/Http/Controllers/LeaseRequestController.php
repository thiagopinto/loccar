<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\LeaseRequest;
use App\Models\PaymentOption;

class LeaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $status = null)
    {
        $leaseRequests = LeaseRequest::with('car', 'client')->where('status', $status)->paginate(10);

        return view('pages.lease-request.index', compact('leaseRequests', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $status, $id)
    {
        if ($request->session()->has('client')) {
            $client = $request->session()->get('client');
            $car = Car::find($id);
            $payments = PaymentOption::get();

            return view('pages.lease-request.create', compact('client', 'status', 'car', 'payments'));
        } else {
            return redirect()->route('login-client.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $status)
    {
        $request->validate([
            'client_id' => 'required',
            'car_id' => 'required',
            'lease_start' => 'required|date',
            'lease_end' => 'required|date|after:lease_start',
            'payment_option_id' => 'required'
        ]);

        $leaseRequest = new LeaseRequest();

        $leaseRequest->client_id = $request->client_id;
        $leaseRequest->car_id = $request->car_id;
        $leaseRequest->lease_start = $request->lease_start;
        $leaseRequest->lease_end = $request->lease_end;
        $leaseRequest->status = $status;

        $leaseRequest->save();

        return redirect()->route('home');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $leaseRequest = LeaseRequest::find($id);
        $leaseRequest->status = $request->get('status');
        $leaseRequest->save();

        if($leaseRequest->status == 'active') {
            return redirect()->back()->with('success', 'Aluguel confirmado!');
        }

        if($leaseRequest->status == 'canceled') {
            return redirect()->back()->with('error', 'Aluguel cancelado!');
        }

        if($leaseRequest->status == 'pending') {
            return redirect()->back()->with('error', 'Aguardando o cliente vir buscar o carro!');
        }

        if($leaseRequest->status == 'finished') {
            return redirect()->back()->with('error', 'Aluguel finalizado!');
        }


    }
}
