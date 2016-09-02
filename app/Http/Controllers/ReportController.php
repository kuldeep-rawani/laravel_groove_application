<!-- <!-- <?php

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
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

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
    public function update(Request $request, $id)
    {
        //
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

    public function show_yesterday_task()
    {
        
        $current = Carbon::now();
        $yesterday = Carbon::yesterday();

        $yesterday_task = \App\Task::where('created_at','>=',$yesterday)
                                   ->where('created_at','<=',$current)
                                   ->get();
        
        return $yesterday_task;                         


    }

    public function show_last_seven_days_task()
    {

         // $current = Carbon::now();
         // $last_week = $current->subWeek();
         // dd($last_week);
         // $last_seven_days_task = \App\Task::where('created_at','>=',$last_week)
         //                                  ->where('created_at','<=',$current)
         //                                  ->get();

         // return $last_seven_days_task;    

         $last_seven_days_task = DB::select(DB::raw(SELECT * FROM tasks WHERE now()-created_at <= 7 ) );
         return $last_seven_days_task;                                


    }

   





}
 --> -->