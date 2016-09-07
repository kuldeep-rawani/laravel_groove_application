<?php

namespace Platform\Tasks\Handlers\Commands;

use Platform\App\Commanding\DefaultCommandBus;
use Platform\App\Commanding\CommandHandler;
use Platform\Tasks\Repositories\Contracts\TicketRepository;

class DeleteTicketCommandHandler implements CommandHandler
{

		protected $ticketRepository;

		public function __construct(TicketRepository $ticketRepository)
		{
			$this->ticketRepository = $ticketRepository;
		}

		public function handle($command)
		{
			$ticket = $this->ticketRepository->deleteticket($command);

			return $ticket;
		}

}
