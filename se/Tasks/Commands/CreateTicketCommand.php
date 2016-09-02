<?php

namespace Platform\Tasks\Commands;

class CreateTicketCommand
{
	public $body;

	public $subject;

	public $to;

	public $status;

	public $author;

	public $assign_to;

   public $status_id;



   public function __construct($data)
   {
         
   	 	$this->body = $data['body'];
   	 	$this->subject = $data['subject'];
   	 	$this->to = $data['to'];
   	 	$this->status = $data['status'];
   	 	$this->author = $data['author'];
   	 	$this->assign_to = $data['assign_to'];
         $this->status_id = $data['status_id'];

   }

}
