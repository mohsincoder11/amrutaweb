<?php 
use App\MeterReading;
function checklogins($routename=null)
{

	$userdata=Session::get('userdata');
	if($userdata!=null)
	{
			echo view($routename);
	}
	else
	{
			echo view('login');

	}
}


if (!function_exists('get_meter_reading')) {
    function get_meter_reading($date,$user_id)
    {
		$date=MeterReading::select('reading')->where('user_id',$user_id)->whereDate('created_at', $date)->orderby('id','desc')->get();
		//echo json_encode(count($date));
		$reading='';
		foreach($date as $key=>$d){
			if(count($date)!=$key+1)
			$reading.= '<b>'.$d->reading.'</b> - ';		
			else
			$reading.= '<b>'.$d->reading.'</b>';		
				}
		return $reading;
	}
}


?>
