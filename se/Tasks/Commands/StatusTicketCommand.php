<?php

namespace Platform\Tasks\Commands;

class StatusTicketCommand
{

	public $to;

	public $status;

	public $status_id;

	public function __construct($data,$status)
	{
		
		$this->to = $data['to'];
		$this->status_id = $data['status_id'];
		$this->status = $status;

		
	}

}