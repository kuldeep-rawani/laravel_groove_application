<?php

namespace Platform\Tasks\Commands;

class CreateStatusCommand
{

	public $status_id;

	public $status;

	public function __construct($data)
	{
	    
	    $this->status_id = $data['status_id'];
	    $this->status = $data['status'];		
				
	}


}