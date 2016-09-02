<?php

namespace Platform\Tasks\Commands;

class SearchTicketCommand
{

	public $word;

	public function  __construct($data)
	{
		

		$this->word = $data['word'];
		

	}

}