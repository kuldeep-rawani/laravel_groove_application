<?php

namespace Platform\Tasks\Commands;

class UpdateTicketStatusCommand
{

	public $task_id;

	public $status_id;

	public $to;

	public function  __construct($data)
	{
		$this->task_id = $data['task_id'];
		$this->status_id = $data['status_id'];
		$this->to = $data['to'];

	}

}