<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver_mail_id extends Model
{
    
	 protected $table = 'receiver_mail_id';

	 protected $fillable = ['task_id','email'];

}
