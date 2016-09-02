<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Status extends Model
{
    
    protected $table = 'status';

    protected $primarykeys ='status_id'; 
    
    protected $fillable = ['status'];


    public function tasks()
    {

    	return $this->hasMany('App\Task', 'status_id', 'status_id');

    }


}
