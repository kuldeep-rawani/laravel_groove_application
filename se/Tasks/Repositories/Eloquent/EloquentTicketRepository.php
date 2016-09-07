<?php

namespace Platform\Tasks\Repositories\Eloquent;

use Platform\Tasks\Repositories\Contracts\TicketRepository;

class EloquentTicketRepository implements TicketRepository
{

   public function __construct()
   {
    
   }

   public function newticket($command)
   {   
              
  	   $ticket = \App\Task::create(['body'=>$command->body,
                                  'subject'=>$command->subject,
                                   'author'=>$command->author,
                                   'status_id'=>$command->status_id
                    
                                ]);

          $count = count($command->to);

           for($x = 0; $x<=$count-1; $x++) {

                  $receiver_mail_id = \App\Receiver_mail_id::create(['task_id'=>$ticket->task_id,
                                                              'email'=>$command->to[$x]
                                                             ]);
      
          }
      

      

      return $ticket;
      

  }
  

  public function showticket($command)
  {
    
          // $status =  \App\Status::with('tasks')->get();
          // dd($status);
       
          // $task = \App\Task::with('status')->where('task_id', 8)->get();
          // dd($task);
          $to = $command->to;
          $ticket = \App\Task::where('to',$to)
                              ->orderBy('task_id','desc')
                              ->simplePaginate(1);

           
           return $ticket;

          
          
    
  }

  public function updateticket($command)
  {
        
        $task_id = $command->task_id;
        $author = $command->author;
        $body = $command->body;
        $ticket = \App\Task::where('task_id',$task_id)
                             ->where('author',$author)
                             ->update(['body'=>$body]);
      
        $get_updated_ticket =  \App\Task::where('task_id',$task_id)
                                         ->where('author',$author)
                                         ->get();

         return $get_updated_ticket;   

  }


  public function deleteticket($command)
  {
      $task_id = $command->task_id;
      $ticket = \App\Task::where('task_id',$task_id)
                        ->delete();

      return $ticket;                       


  }


  public function ticketstatus($command)
  {
        
        $to = $command->to;
        $status_id = $command->status_id;

                $status = \App\Task::where('to',$to)
                                    ->where('status_id',$status_id) 
                                    ->paginate(15);
                
                return $status;               
                                    

}

   public function updateticketstatus($command)
   {

         $task_id = $command->task_id; 
         $to = $command->to;
         $status_id = $command->status_id;

         $status = \App\Task::where('task_id',$task_id)
                            ->where('to',$to)
                            ->update(['status_id'=>$status_id]); 

         $get_updated_ticket = \App\Task::where('task_id',$task_id)
                                         ->where('to',$to)
                                         ->get();                     

         return $get_updated_ticket;                                      
   
   } 

   public function ticketsearch($command)
   {

        $word = $command->word;

        $body = \App\Task::where('body','ilike',$word.'%')->get();
      
        $author = \App\Task::where('author','ilike',$word.'%')->get();

        $to = \App\Task::where('to','ilike',$word.'%')->get();

        //$status = \App\Task::where('status_id',$word)->get();


         if (!$body->isEmpty()) {
            
             return $body;
         }

         elseif (!$author->isEmpty()) {
            
            return $author;
         }

         elseif (!$to->isEmpty()) {
            
            return $to;
         
         }

          //elseif (!$status->isEmpty()) {
            
            // return $status;
         
        // }


         else {
            
            return "No match found"; 

         }
         

   }


 }





















  // public function ticketstatus($command)
  // {
         
  //     $task_id = $command->task_id;
  //     $author = $command->author;
  //     $to = $command->to;
  //     $status = $command->status;
  //     if ($status == 'pending') {

  //         $ticket = \App\Task::where('to',$to)
  //                            ->join('status','status.status_id','=','tasks.task_id')
  //                            ->where('status','pending');
  //                            ->orderBy('task_id','desc')
  //                            ->get();
          
  //          if ($ticket->isEmpty()) {
  //           echo "there are no closed ticket";
         
  //         }

  //         else {                   
          
  //             echo $ticket;
  //         }      

  // }

  //      elseif ($status == 'closed'){

  //         $ticket = \App\Task::where('author',$author)
  //                            ->join('status','status.status_id','=','tasks.task_id')
  //                            ->where('state','closed')
  //                            ->orderBy('task_id','desc')
  //                            ->get();

  //         if ($ticket->isEmpty()) {
  //           echo "there are no closed ticket";
         
  //         }

  //         else {
         
  //            return $ticket;
  //         }

  //       }

      
  //     else {

  //         $ticket = \App\Task::where('to',$to)
  //                            ->join('status','status.status_id','=','tasks.task_id')
  //                            ->where('state','spam')
  //                            ->orderBy('task_id','desc')
  //                            ->get();
           
  //           if ($ticket->isEmpty()) {
  //           echo "there are no closed ticket";
         
  //          }                  
          
  //         else {
              
  //              return $this->ticket;
          
  //         }    

  //     }


  // }


  

