<?php

namespace Platform\Tasks\Commands;

class UpdateTicketCommand
{
	public $task_id;

	public $author;

    public $body;


	public function __construct($data)
	{
	    //dd($data);
	    $this->task_id = $data['task_id'];		
		$this->author = $data['author'];
		$this->body = $data['body'];
	
	}
}