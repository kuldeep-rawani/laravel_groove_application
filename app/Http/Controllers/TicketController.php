<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Platform\App\Commanding\DefaultCommandBus;
use Platform\Tasks\Repositories\Contracts\StatusRepository;
use Platform\Tasks\Commands\CreateTicketCommand;
use Platform\Tasks\Commands\ShowTicketCommand;
use Platform\Tasks\Commands\UpdateTicketCommand;
use Platform\Tasks\Commands\DeleteTicketCommand;
use Platform\Tasks\Commands\CreateStatusCommand;
use Platform\Tasks\Commands\StatusTicketCommand;
use Platform\Tasks\Commands\UpdateTicketStatusCommand;
use Platform\Tasks\Commands\SearchTicketCommand;








class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $commandBus;

    protected $ticketRepository;


    public function __construct(DefaultCommandBus $commandBus,StatusRepository $statusRepository)
    {

        $this->commandBus = $commandBus;
        $this->statusRepository = $statusRepository;

    }   


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
         $ticket = $this->commandBus->execute(new CreateTicketCommand($request->all()));
         $status_id = $ticket['status_id'];
         $status = $ticket['status'];
         if ($ticket){

            $this->commandBus->execute(new CreateStatusCommand($status_id,$status));
         
         }


         
    }


    public function show(Request $request)
    {
          $ticket = $this->commandBus->execute(new ShowTicketCommand($request->all()));
    

         if (!$ticket->isEmpty()){
       
            return $ticket;

         }

         else {

            echo "No Tickets";
         }

    }


    public function update(Request $request)
    {
        $this->commandBus->execute(new UpdateTicketCommand($request->all()));
    
    }


    public function delete(Request $request)
    {

        $this->commandBus->execute(new DeleteTicketCommand($request->all()));

    }

    public function getstatus(Request $request,$status)
    {
        $ticket = $this->commandBus->execute(new StatusTicketCommand($request->all(),$status));

        if (!$ticket->isEmpty()){
       
            return $ticket;

         }

         else {

            echo "No Tickets";
         }

    }

    public function updateticketstatus(Request $request)
    {

        $this->commandBus->execute(new UpdateTicketStatusCommand($request->all()));

        return 1;

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function search(Request $request)
    {

        $ticket = $this->commandBus->execute(new SearchTicketCommand($request->all()));

        return $ticket;
    
    }

    public function status_master_table()
    {

        $status = $this->statusRepository->status_master_table();

        return $status;
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
