<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AssignData;
use App\Traits\Active;
use App\CarAssignment;
use App\Alarm;
use DB;

class Car extends Model
{
    use assignData, active;

    protected $table        = 'cars';
    private   $map_fields_c = [ 
                            'marca'             => 'brand', 
                            'modelo'            => 'model', 
                            'placas'            => 'placas', 
                            'anio'              => 'year-selector', 
                            'insurance_price'   => 'insurance-price',
                            'insurance_end'     => 'insurance_end',
                            'insurance_company' => 'insurance_company',
                            'insurance_number'  => 'insurance_number'
                            ];

    private   $map_fields_u = [ 
                            'marca'             => 'u-brand', 
                            'modelo'            => 'u-model', 
                            'placas'            => 'u-placas', 
                            'anio'              => 'u-year', 
                            'km'                => 'u-km',
                            'insurance_price'   => 'u-insurance-price',
                            'insurance_end'     => 'u-insurance_end',
                            'insurance_company' => 'u-insurance_company',
                            'insurance_number'  => 'u-insurance_number'
                            ];
    public function assigments()
    {
        return $this->hasMany( CarAssignment::class );
    }

    public function alarms()
    {
        return $this->hasMany( Alarm::class );
    }

    /** 
     * Method to assign data and save the object
     * @param $request
     * @return boolean
     */
    public function assignAndSave( $request )
    {
        $status = false;
        DB::beginTransaction();
        $this->assignInputToFields( $request, $this->map_fields_c );

        if( $this->save() )
        {
            $assignment   = new CarAssignment();
            $status       = $assignment->assignAndSave( $this->id, $request['driver-selector'] );
            $status === true ? DB::commit() : DB::rollback();
        }
        return array( 'status' => $status );
    }

    /**
     * Method to update a Car
     * @param $request
     * @return $status
     */
    public function update_car( $request )
    {
        DB::beginTransaction();

        $this->assignInputToFields( $request, $this->map_fields_u );
        $status1        = $this->save();
        $assignment     = new CarAssignment();
        $assignment->deactivateOthers( $this->id );
        $status2        = $assignment->assignAndSave( $this->id, $request['u-driver-selector'] );
        
        $this->checkAlarms();
        if( $status1 && $status2 )
            DB::commit();
        else
            DB::rollback();
        return array( 'status' => $status1 && $status2 );
    }

    /**
     * Checking and create the alarms
     * @param None
     * @return None
     */
    public function checkAlarms()
    {
        $tasks              = Task::where( 'active', 1 )->get();
        $maintenances       = $this->getLastMaintenances();
        $alarms_to_create   = [];

        foreach ($tasks as $task ) 
        {
            isset( $maintenances[$task->id] ) ? 
                $km_maintenance = $maintenances[$task->id]->km_peridiocity :
                $km_maintenance = 0;

            if( $this->isNeeded( $task->km_peridiocity, $km_maintenance ) )
                $alarms_to_create[] = $task;
        }
        $this->createAlarms( $alarms_to_create );
    }

    /**
     * Getting the data of furthest maintenances created per task
     * @param None
     * @return $result ( Array of the furthest maintenances done ) 
     */
    private function getLastMaintenances()
    {
        $result = [];
        $rows = DB::select( DB::raw( 
            "SELECT TA.id, TA.name, TA.km_peridiocity, TEMP.car_id, TEMP.maintenance_id, TEMP.max
                FROM tasks TA JOIN (
                    SELECT M.id maintenance_id,  M.car_id, M.task_id, MAX( M.period ) max 
                    FROM tasks T JOIN maintenances M ON M.task_id =  T.id
                    WHERE M.car_id = $this->id
                    GROUP BY M.car_id, M.task_id
                ) TEMP ON TEMP.task_id = TA.id " 
        ));
        foreach ($rows as $row)
            $result[ $row->id ] = $row; 
        return $result;
    }

    /**
     * Creating the alarms
     * @param $alarms_to_create
     * @return None
     */
    public function createAlarms( $tasks_to_create )
    {
        foreach ( $tasks_to_create as $task ) {
            $a = new Alarm();
            $a->title   = 'Autogenerado- '.$task->name;
            $a->content = 'Autogenerado- '. $task->description ;
            $a->active  = 1;
            $a->task_id = $task->id;
            $a->car_id  = $this->id;
            $a->save();
        }
    }

    /**
     * Validating if the alarms must be created
     * @param $task_km, $last_maintenance_km
     * @return  
     */
    public function isNeeded( $task_km, $last_maintenance_km )
    {
        $diff = ( $this->km - $last_maintenance_km ) / $task_km ;
        if( $diff > 1 )
            return true;
        return false;
    }
}
