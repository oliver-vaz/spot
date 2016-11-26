<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Car;
use App\Alarm;
use App\CarAssignment;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['status'] = false;
        $data['cars']   = Car::where( 'active', 1 )->get() ;
        if( count( $data['cars'] ) )
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
        return view( 'forms/car' );
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
        $car         	= new Car();

        if( $car->assignAndSave( $request->all() ) )
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
        $car = Car::find( $id );
        if( isset($car) && $car !== null )
        {
            return response()->json( [ 'status' => true , 'data' => $car ] );
        }
        return response()->json( [ 'status' => false ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find( $id );
        if( isset($car) && $car !== null )
        {
            return view( 'driver/form' )->compact( $car );
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
        $data['status'] = false;
        $car            = Car::find( $id );
        
        if( $car !== null && $car->update_car( $request ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );
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
        $car            = Car::find( $id );
        
        if( $car !== null && $car->active( false ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );
    }

    public function showWithData( $id )
    {
        $data['status']     = true;
        $data['car']        = Car::find( $id );

        if( !isset( $data['car'] ) )
            return response()->json( [ 'status' => false ] );

        $data['assignment'] = CarAssignment::where( 'car_id', $data['car']->id )
                                            ->where( 'active', 1 )
                                            ->first();
        return response()->json( $data );
    }

    public function saveAlarm( Request $request )
    {
        $status     = false;
        $alarm      = new Alarm();
        if( $alarm->assignAndSave( $request->all() ) )
        {
            $status = true;
        }
        return response()->json( [ 'status' => $status ] );
    }

    public function deleteAlarm( Request $request, $id )
    {
        $alarm = Alarm::find( $id );
        if( !isset( $alarm ) || $alarm === null )
        {
            return response()->json( [ 'status' => false ] );
        }
        return response()->json( [ 'status' => $alarm->deactivate() ] );
    }

}
