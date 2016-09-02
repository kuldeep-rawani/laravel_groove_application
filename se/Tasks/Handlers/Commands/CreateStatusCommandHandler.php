<?php

namespace Platform\Tasks\Handlers\Commands;

use Platform\Tasks\Repositories\Contracts\StatusRepository; 
use Platform\App\Commanding\CommandHandler;

class CreateStatusCommandHandler implements CommandHandler
{


		protected $statusRepository;

		public function __construct(StatusRepository $statusRepository)
       {

				
				$this->statusRepository = $statusRepository;

		}

		public function handle($command)
		{
			$status = $this->statusRepository->master_table_status($command);
			
			return $status;
		
		}

}