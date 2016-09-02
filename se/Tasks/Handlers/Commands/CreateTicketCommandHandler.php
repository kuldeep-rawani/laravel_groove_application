<?php

namespace Platform\Tasks\Handlers\Commands;

use Platform\Tasks\Repositories\Contracts\TicketRepository; 
use Platform\App\Commanding\DefaultCommandBus;
use Platform\App\Commanding\CommandHandler;
use Mail;



class CreateTicketCommandHandler implements CommandHandler
{

		protected $ticketRepository;

		public function __construct(TicketRepository $ticketRepository)
    {

				
				$this->ticketRepository = $ticketRepository;

		}


		public function handle($command)
		{

           $ticket = $this->ticketRepository->newticket($command);

           return $ticket;
        

    }
		

  
 }

  























           //if ($ticket) {

           //$data = [];
           //$to = $command->to;
           //$subject=$command->subject;
         //$path=$command->path;
         //if ($path == null) {

                // Mail::send('emails.description', $data, function ($message) use ($to,$subject) {
                // $message->from('kuldeep@sourceeasy.com','User');

                // $message->to($to)->subject($subject);
                // });

         //}  

       //   else {
 
       //     Mail::send('emails.description', $data, function ($message) use ($to,$subject,$path) {
       //         $message->from('kuldeep@sourceeasy.com','User');

       //         $message->to($to)->subject($subject)->attach($path);
       //    });
       // }