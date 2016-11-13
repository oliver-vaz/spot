<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use App\Location;
use App\Tariff;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['status']     = false;
        $data['customers']    = Customer::where( 'active', 1 )->get();
        if( count( $data['customers'] ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'forms/customer' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['status'] = false;
        $customer         = new Customer();

        if( $customer->assignAndSave( $request->all() ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find( $id );
        if( isset( $customer ) && $customer !== null )
        {
            return response()->json( [ 'status' => false, 'data' => $customer ] );
        }
        return [ 'status' => false ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Customer::find( $id );
        if( isset($driver) && $driver !== null )
        {
            return view( 'driver/form' )->compact( $driver );
        }
        return view( '404' );
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
        $data['status'] = false;
        $customer         = Customer::find( $id );
        
        if( $customer !== null && $customer->active( false ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );
        
    }

    /**
     * Saving a location belonging to a customer.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_location( Request $request )
    {
        $customer = Customer::find( $request->input( 'location-selector' ) );
        if( !$customer )
            return response()->json( [ 'status' => false ] );

        $location = new Location();
        if( $location->assignAndSave( $request->all(), $customer ) )
            return response()->json( [ 'status' => true ] );
        return response()->json( [ 'status' => false ] );
    }

    /**
     * Saving a tariff belonging to a customer.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_tariff( Request $request )
    {
        $customer = Customer::find( $request->input( 'tariff-selector' ) );
        if( !$customer )
            return response()->json( [ 'status' => false ] );

        $tariff = new Tariff();
        if( $tariff->assignAndSave( $request->all(), $customer ) )
            return response()->json( [ 'status' => true ] );
        return response()->json( [ 'status' => false ] );
    }
}
