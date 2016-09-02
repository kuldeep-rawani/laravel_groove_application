<?php

namespace Platform\Tasks\Handlers\Commands;

use Platform\App\Commanding\CommandHandler;
use Platform\Tasks\Repositories\Contracts\TicketRepository;

class UpdateTicketCommandHandler implements CommandHandler
{

		protected $ticketRepository;

		public function __construct(TicketRepository $ticketRepository)
		{
			$this->ticketRepository = $ticketRepository;
		}

		public function handle($command)
		{
		
			$this->ticketRepository->updateticket($command);
		}

}
