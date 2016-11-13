<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AssignData;
use App\Traits\Active;
use App\Traits\Validating;
use DB;

class Alarm extends Model
{
    use assignData, active, validating;

    private $rules      = [ 
                'a-title'   => 'required|string',
                'a-content' => 'required|string',
                'a-id-car'  => 'required|integer',
                'a-id-task' => 'integer',
    ];
    private $map_fields = [
                'title'     => 'a-title',
                'content'   => 'a-content',
                'car_id'    => 'a-id-car',
                'task_id'   => 'a-id-task'
    ];

    public function car()
    {
        return $this->belongsTo( Car::class );
    }

    public function assignAndSave( $request )
    {
        if( !$this->validate( $request )['status'] )
            return false;

        $this->assignInputToFields( $request, $this->map_fields );
        $this->active   = 1;

        try 
        {
            return $this->save();   
        } 
        catch (Exception $e) 
        {
            return false;
        }
    }

    public static function disableAlarms( $car_id, $task_id )
    {
        try {
            $rows = DB::update( "UPDATE alarms SET active = 0 WHERE task_id = $task_id AND car_id = $car_id " );
        } catch( Exception $e ){
            return -1;
        }
    }

    public function deactivate()
    {
        $this->active = false;
        try 
        {
            return $this->save();
        }
        catch( Exception $e )
        {
            return false;
        }
    }

}
