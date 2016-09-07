<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
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

     


     public function store(Request $request)
    {

        $this->validate($request,[
             'First_Name'=>'required',
             'Last_Name'=>'required',
            'email'=>'required',
            'Username'=>'required',
              'Password'=>'required',
              'ConfirmPassword'=>'required'

              ]);
        

        if($request['ConfirmPassword']==$request['Password']) {
        
                $us=\App\User::create(['name'=>$request['Username'],
                                     'password'=>bcrypt($request['Password']),
                                      'email'=>$request['email']]);
                $user_id=$us->id;

                $data = ['user_id'=>$user_id,'First_Name'=>$request['First_Name'],
                        'Last_Name'=>$request['Last_Name']];
        
                $li=\App\Lists::create($data);
                
                return view('after_registration');
        

        }

        else {
            
            return view('password_page');
        
        }
        //DB::table('users')->insert($us);
        //return make::('users',compact($us));

        
         
    }


    public function login(Request $request)
    {

        $this->validate($request,[
             'email'=>'required',
             'password'=>'required'
            ]);
        
        $data = ['name'=>$request['name'],
        'password'=>$request['password']];
        
        if(Auth::attempt($data)) {
             
             return view('after_login');
         
         }
        
        else {
            
            return redirect()->back()->with('error','something went wrong');
        
        }

     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $this->validate($request, [
        // 'to' => 'required|email',
        'body' => 'required',
        ]);
        

         $ticket = $this->commandBus->execute(new CreateTicketCommand($request->all()));

         return $ticket;
         // $status_id = $ticket['status_id'];
         // $status = $ticket['status'];
         // if ($ticket){

         //    $this->commandBus->execute(new CreateStatusCommand($status_id,$status));
         
         // }


         
    }


    public function show($to)
    {
          $ticket = $this->commandBus->execute(new ShowTicketCommand($to));
    

         if (!$ticket->isEmpty()){
       
            return $ticket;

         }

         else {

            return "No Tickets";
         }

    }


    public function update(Request $request)
    {
        $ticket = $this->commandBus->execute(new UpdateTicketCommand($request->all()));
        
        return $ticket;
    
    }


    public function delete(Request $request)
    {

        $ticket = $this->commandBus->execute(new DeleteTicketCommand($request->all()));

        if ($ticket) {

            return "ticket successfully deleted";
        
        }

    }

    public function getstatus(Request $request,$status)
    {
        $status_id = $request['status_id'];

        if($status_id > 0 && $status_id < 4) {

                $ticket = $this->commandBus->execute(new StatusTicketCommand($request->all(),$status));

                if (!$ticket->isEmpty()){
       
                        return $ticket;

                }

             else {

                return "No Tickets";
            }

    }
    else {

           return "not a valid status_id";    
    
    }

  
   }

    public function updateticketstatus(Request $request)
    {

        $status = $this->commandBus->execute(new UpdateTicketStatusCommand($request->all()));

        return $status;

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
