<?php

namespace Platform\Tasks\Repositories\Eloquent;

use Platform\Tasks\Repositories\Contracts\StatusRepository;


class EloquentStatusRepository implements StatusRepository
{

	public function status_master_table()
	{
		
		$status = \App\Status::select('status_id','status')
							 ->get();
							 


		return $status; 			 



	}

	


}