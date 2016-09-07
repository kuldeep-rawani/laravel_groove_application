<?php

namespace Platform\Tasks\Commands;

class ShowTicketCommand
{
	
	public $to;


	public function __construct($to)
	{

	   $this->to = $to;	

	}


}