<?php

namespace Platform\Tasks\Handlers\Commands;

use Platform\Tasks\Repositories\Contracts\TicketRepository; 
use Platform\App\Commanding\CommandHandler;

class SearchTicketCommandHandler implements CommandHandler
{


		protected $ticketRepository;

		public function __construct(TicketRepository $ticketRepository)
       {

				
				$this->ticketRepository = $ticketRepository;

		}

		public function handle($command)
		{
			$ticket = $this->ticketRepository->ticketsearch($command);
			
			return $ticket;
			
		}

}