<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alarm;
use App\Task;
use DB;

class Maintenance extends Model
{
    public function assignAndSave( $request )
    {	
    	try {
            DB::beginTransaction();

            $this->assign( $request );
            $this->disableAlarmsRelated();
    		$status   = $this->save();

            $status ?   DB::commit() :  DB::rollback();
            return $status;
    	
        } catch( Exception $e ) {
            DB::rollback();
    		return false;
        }
    }

    private function disableAlarmsRelated()
    {
        if( !isset( $this->car_id ) || !isset( $this->task_id ) )
            return false;
        return Alarm::disableAlarms( $this->car_id, $this->task_id );
    }

    private function assign( $request )
    {
        $this->made_by  = $request[ 'm-name' ];
        $this->comments = $request[ 'm-comments' ];
        $this->car_id   = $request[ 'm-car_id' ];
        $this->task_id  = $request[ 'm-task_id' ];
        $this->period   = $this->calculatePeriod();
    }

    private function calculatePeriod()
    {
        $init_km    = $this->getInitKm();
        $task       = Task::find( $this->task_id );

        return $init_km + $task->km_peridiocity;
    }

    private function getInitKm()
    {
        $maintenance = Maintenance::where( 'car_id', $this->car_id )
                            ->where( 'task_id', $this->task_id )
                            ->orderBy( 'id', 'DESC' )
                            ->first();
                            
        if( !isset( $maintenance) )
            return 0;
        return $maintenance->period;
    }

}
