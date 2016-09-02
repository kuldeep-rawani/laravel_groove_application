<?php

namespace Platform\Tasks\Handlers\Commands;

use Platform\App\Commanding\CommandHandler;
use Platform\Tasks\Repositories\Contracts\TicketRepository;

class StatusTicketCommandHandler implements CommandHandler
{
	protected $statusRepository;

	public function __construct(TicketRepository $ticketRepository)
	{
		$this->ticketRepository=$ticketRepository;
	}

	public function handle($command)
	{
		
		$ticket = $this->ticketRepository->ticketstatus($command);
		return $ticket;
	}
}