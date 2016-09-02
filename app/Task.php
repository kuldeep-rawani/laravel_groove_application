<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use softDeletes;
   
    protected $table='tasks';
   
    protected $primaryKey='task_id';

    protected $foreignKey='status_id';
   
    protected $fillable=['body','subject','author','to','assign_to','status_id'];


    public function status()
    {

    	return $this->belongsTo('App\Status', 'status_id', 'status_id');
    	
    	

    }


}
