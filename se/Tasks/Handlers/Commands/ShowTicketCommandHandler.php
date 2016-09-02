<?php

namespace Platform\Tasks\Handlers\Commands;


use Platform\App\Commanding\CommandHandler;
use Platform\Tasks\Repositories\Contracts\TicketRepository; 


class ShowTicketCommandHandler implements CommandHandler
{
	protected $ticketRepository;

	public function __construct(TicketRepository $ticketRepository)
	{
		$this->ticketRepository = $ticketRepository;

	}

	public function handle($command)
	{
		 $ticket = $this->ticketRepository->showticket($command);
		
		 return $ticket;			
	
	}
}