<?php

namespace Platform\Tasks\Commands;

class DeleteTicketCommand
{

		public $task_id;

		public function __construct($data)
		{
	    
	    $this->task_id = $data['task_id'];		
				
		}


}