<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['status']     = false;
        $data['tasks']      = Task::getActiveTasks();

        if( count( $data['tasks'] ) )
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
        return view( 'forms/task' );
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
        $task 			= new Task();

        if( $task->assignAndSave( $request->all() ) )
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
        $task = Task::find( $id );
        if( isset($task) && $task !== null )
        {
            return response()->json( [ 'status' => true , 'data' => $task ] );
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
        $task = Task::find( $id );
        if( isset($task) && $task !== null )
        {
            return view( 'task/form' )->compact( $task );
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
        $task           = Task::find( $id );
        
        if( $task !== null && $task->assignAndSave( $request->all() ) )
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
        $task           = Task::find( $id );
        
        if( $task !== null && $task->active( false ) )
        {
            $data['status'] = true;
        }
        return response()->json( $data );        
    }
}