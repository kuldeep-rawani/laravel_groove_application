<?php

namespace Platform\Tasks\Handlers\Commands;

use Platform\Tasks\Repositories\Contracts\TicketRepository; 
use Platform\App\Commanding\CommandHandler;

class UpdateTicketStatusCommandHandler implements CommandHandler
{


		public $ticketRepository;

		public function __construct(TicketRepository $ticketRepository)
		{

			$this->ticketRepository = $ticketRepository;
		}


		public function handle($command)
		{

			$status = $this->ticketRepository->updateticketstatus($command);

			return $status;
		}


}