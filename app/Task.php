<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Active;
use App\Maintenance;
use App\Car;
use DB;

class Task extends Model
{
    use active;

    public $timestamps = false;

    public function assignAndSave( $request )
    {
        $this->name             = $request[ 'task-name' ];
        $this->description      = $request[ 'task-description' ];
        $this->km_peridiocity   = $request[ 'task-km' ];

        try
        {
            DB::beginTransaction();
            if( $this->save() )
            {
                DB::commit();
                return true;
            }
            DB::rollback();
            return false;
        }
        catch( Exception $e )
        {
            DB::rollback();
            return false;
        }
    }

    public static function getActiveTasks()
    {
        return Task::where( 'active', 1 )->get();
    }

    private function createDefaultMaintenances()
    {
        $cars = Car::where( 'active', 1 )->get();
        foreach ($cars as $key => $car) 
        {
            $m           = new Maintenance();
            $m->made_by  = 'Inicial-'. $this->name;
            $m->comments = 'Inicial-'. $this->description;
            $m->car_id   = $car->id;
            $m->task_id  = $this->id;
            $m->period   = $car->km_peridiocity;
            $this->save();
        }
    }

}
