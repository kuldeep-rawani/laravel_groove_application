<?php

namespace Platform\Tasks\Commands;

class ShowTicketCommand
{
	
	public $to;


	public function __construct($data)
	{

	   $this->to = $data['to'];	

	}


}