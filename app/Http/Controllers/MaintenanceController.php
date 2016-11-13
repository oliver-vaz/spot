<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Maintenance;

class MaintenanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $data['status']     	= false;
        $data['maintenances']   = Maintenance::all();

        if( count( $data['maintenances'] ) )
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
        return view( 'forms/maintenance' );
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
        $maintenance 	= new Maintenance();

        if( $maintenance->assignAndSave( $request->all() ) )
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
        $maintenance = Maintenance::find( $id );
        if( isset($maintenance) && $maintenance !== null )
        {
            return response()->json( [ 'status' => true , 'data' => $maintenance ] );
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
        $maintenance = Maintenance::find( $id );
        if( isset($maintenance) && $maintenance !== null )
        {
            return view( 'form/maintenance' )->compact( $maintenance );
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
        $maintenance    = Maintenance::find( $id );
        
        if( $maintenance !== null && $maintenance->assignAndSave( $request->all() ) )
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
        $maintenance    = Maintenance::find( $id );
        
        if( $maintenance !== null && $maintenance->active( false ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );        
    }
}
