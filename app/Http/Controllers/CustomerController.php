<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Customer;
use App\Location;
use App\Tariff;
use App\TariffHandler;
use App\Trip;
use App\TripSaver;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['status']       = false;
        $data['customers']    = Customer::where( 'active', 1 )->get();
        if( count( $data['customers'] ) )
            $data['status'] = true;
        return response()->json( $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view( 'forms/customer', compact('user') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer   = new Customer();
        $data       = $customer->assignAndSave( $request->all() );
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
        if(isset($customer->id))
        {
            return response()->json( [ 'status' => true, 'data' => $customer ] );
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
        $c = Customer::find( $id );
        if( isset($c->id) )
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
        $c = Customer::find( $id );
        if( isset($c->id) )
        {
            return response()->json( $c->assignAndSave( $request->all() ) );
        }
        return response()->json([ 'status' => false, 'message' => 'Cliente no encontrado en el sistema' ]);
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
        if( !isset($customer->id) )
            return response()->json( [ 'status' => false ] );

        $handler = new TariffHandler();
        if( $handler->createNewTariff( new Tariff(), $customer, $request->all() ) )
            return response()->json( [ 'status' => true ] );
        return response()->json( [ 'status' => false ] );
    }

    /**
     * Saving a trip.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_trip( Request $request )
    {
        $customer = Customer::find( $request->input( 'customer_id' ) );
        if( !isset($customer->id) )
            return response()->json( [ 'status' => false ] );

        $ts = new TripSaver();
        if( $ts->save( $request->all(), $customer, new Trip()))
            return response()->json( [ 'status' => true ] );
        return response()->json( [ 'status' => false ] );
    }

    /**
     * Get all locations for a customer
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getLocations( $id )
    {
        $customer = Customer::find( $id );
        if(!isset( $customer->id ))
        {
            return response()->json([ 'status' => false, 'message' => 'Error: Cliente no encontrado']);
        }
        return response()->json([ 'status' => true, 'data' => $customer->getLocations() ]);
    }

    /**
     * Get all tariffs for a customer
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getTariffs($id)
    {
        $tariffs = Tariff::where('customer_id', $id )->orderBy('active', 'DESC')->get();
        if( count( $tariffs ) <= 0 )
        {
            return response()->json([ 'status' => false, 'message' => 'Error: No hay datos']);
        }
        return response()->json([ 'status' => true, 'data' => $tariffs ]);
    }
}