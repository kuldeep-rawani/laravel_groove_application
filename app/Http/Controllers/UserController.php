<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController; 
use App\Http\Controllers\Auth\PasswordController;     
use Mail;

class UserController extends Controller
{


    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user=\App\User::create(['name' => $request['name'],
                              ' password' => bcrypt($request['password']),
                               'email' => $request['email']]);
        
    }


    public function show(Request $request)
    {

     $author = $request['author'];
     $tickets = \App\Task::where('author',$author)->get(); 
     return $tickets; 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


     public function login(Request $request)
    {

        $this->validate($request,[
             'email' => 'required',
             'password' => 'required'
              ]);
        // $data=array(
        //     'Username'=> DB::table('users')->select('Username'),
        //     'Password'=>DB::table('users')->select('Password')
        //     );
        
        $data = ['email' => $request['email'],
                'password' => $request['password']];
        //dd($data);
        if (Auth::attempt($data)) {
            //echo "success";
            return 1;
        }
        else {
            return 0;
        }

    }
    // public function getstate(Request $request)
    // {
    //   $user=Auth::user();
    //   $task_id=$user->task_id;
    //   $pending=\App\Task::where('task_id',$task_id)->where('state',pending)->get();
    //   retu


    // }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $word=$request['word'];
        $author=\App\Task::where('author','like',$word.'%')->get();
        // $author = DB::table('tasks')->where('author', $word)->get();
        //dd($author);
        $to=\App\Task::where('to','like',$word.'%')->get();
        // dd($author);
        if (!$author->isEmpty()) {
            
             return $author;
         }

         elseif (!$to->isEmpty()) {
            return $to;
         }

         else {
            echo "nothing"; 

         }
         

 
   }

     // * Show the form for editing the specified resource.
     // *
     // * @param  int  $id
     // * @return \Illuminate\Http\Response
     // */

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
    public function update(Request $request)    
    {
        $id=$request['task_id'];
        $author=$request['author'];
        $body=$request['body'];
        $tickets=\App\Task::where('id',$id)->where('author',$author)->update(['body'=>$body]);
        return $tickets;

    }

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


    public function delete(Request $request) 
    {
        $id=$request['task_id'];
        $task=\App\Task::where('id',$id)->delete();


    }


    public function newticket(Request $request)
    {
        //$user=Auth::user();
        //$id=$user->id;           
         $data = [];
         $to = $request['to'];
         $subject=$request['subject'];
         $path=$request['path'];
         if ($path == null) {

                Mail::send('emails.description', $data, function ($message) use ($to,$subject,$path) {
                $message->from('kuldeep@sourceeasy.com','User');

                $message->to($to)->subject($subject);
                });

         }  

         else {
 
           Mail::send('emails.description', $data, function ($message) use ($to,$subject,$path) {
               $message->from('kuldeep@sourceeasy.com','User');

               $message->to($to)->subject($subject)->attach($path);
          });
       }

        $user=\App\Task::create(['body'=>$request['body'],
                                  'to'=>$request['to'],
                                  'subject'=>$request['subject'],
                                   'state'=>$request['state'],
                                   'author'=>$request['author'],
                                   'assign_to'=>$request['assign_to']
                    

                                ]);


    }

   public function open(Request $request) 
   {
    //$user=Auth::user();
    //$user_id=$user->id;
    $to=$request['to'];

    $task=\App\Task::where('to',$to)->orderBy('task_id','desc')->get();
    return $task;

     
   }


   public function mine(Request $request) 
   {
         
     $author=$request['author'];

     $task=\App\Task::where('author',$author)->orderBy('task_is','desc')->get();
     return $task;

   }
   


   public function closed(Request $request)
   {
     //$user=Auth::user();
     //$user_id=$user->id;
     $author=$request['author'];
     $task=\App\Task::where('author',$author)->where('state','closed')->orderBy('task_id','desc')->get();
     return $task;


   } 

   public function pending(Request $request)
   {
       //$user=Auth::user();
       //$user_id=$user->id;
        $to=$request['to'];
        $id=$request['id'];
        $task=\App\Task::where('to',$to)->where('state','pending')->orderBy('task_id','desc')->get();
        return $task;
        
    }

   public function spam(Request $request)
   {
         
        $to=$request['to'];
        $task=\App\Task::where('to',$to)->where('state','spam')->select('subject','body')->get();
        return $task;
   }


   public function resolved(Request $request)
  {
           $state=$request['state'];
           $task_id=$request['task_id'];
           $data=[];
           $to=$request['to'];
           Mail::send('emails.description', $data, function ($message) use($to) {
           $message->from('kuldeep.rawani159@gmail.com','User');

           $message->to($to);
      });
         $task=\App\Task::where('task_id',$task_id)->update(['state'=>$state]);  
        
    }
        
  public function test(Request $request)
  {
            $aa=$request['aa'];
            $bb=$request['bb'];
            return
            [
                 "aa"=>$aa,
                 "bb"=>$bb
   
            ];

  }

  public function notification()
  {
           
            
            $data['message'] = 'hello world';
            $app_id = '241211';
            $app_key = 'bcd2a7f0519b295a11f3';
            $app_secret = 'fad2324e6cceffeac728';

            $pusher = new \Pusher( $app_key, $app_secret, $app_id );
            //dd($pusher);
            $pusher->trigger('testChannel', 'myevent', $data);

    }




 }
   


