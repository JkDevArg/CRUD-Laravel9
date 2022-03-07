<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = "Customers";
        $data['q'] = $request->get('q');
        $data['customers'] = Customer::where('customer_name', 'like', '%' . $data['q'] . '%')->get();
        return view('customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Customer';
        return view('customer.create', $data); 
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
            'customer_name' => 'bail|required|unique:tb_customer|min:5',
            'contact_name' => 'bail|required|unique:tb_customer|min:5',
            'address' => 'unique:tb_customer',
        ]);
        $customer = new Customer($request->all());
        $customer->save();
        return redirect('customer')->with('success', 'Customer Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $data['title'] = 'Edit Customer';
        $data['customer'] = $customer;
        return view('customer.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'customer_name' => 'required',
            'contact_name' => 'required',
        ]);
        
        $customer->customer_name = $request->customer_name;
        $customer->contact_name = $request->contact_name;
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->save();
        return redirect('customer')->with('success', 'Customer Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('customer')->with('success', 'Customer Deleted Successfully');
    }
}
