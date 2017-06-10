<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\CarDriver;
use Auth;

class DriverController extends Controller
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
        $data['status']     = false;
        $data['drivers']    = CarDriver::all();
        if( count( $data['drivers'] ) )
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
        $user = Auth::user();
        return view( 'forms/driver', compact('user') );
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
        $driver         = new CarDriver();

        if( $driver->assignAndSave( $request->all() ) )
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
        $driver = CarDriver::find( $id );
        if( isset($driver) && $driver !== null )
        {
            return response()->json( [ 'status' => true , 'data' => $driver ] );
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
        $driver = CarDriver::find( $id );
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
        $data['status'] = false;
        $driver         = CarDriver::find( $id );
        
        if( isset( $driver->id ) && $driver->assignAndSave( $request->all() ) )
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
        $driver         = CarDriver::find( $id );
        
        if( $driver !== null && $driver->active( false ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );
        
    }

    /**
     *
     */
    public function activate($id)
    {
        $driver         = CarDriver::find( $id );
        if( isset($driver->id) && $driver->active( true ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );
        
    }
}