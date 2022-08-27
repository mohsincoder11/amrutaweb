<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Godawn_user;
class Live_bird_transfer extends Controller
{
	public function gtognew()
	{

		$userdata=Session::get('userdata');
		if($userdata!=null)
		{
			if($userdata['role']==5)
			{
				$get=Godawn_user::where('user_id',$userdata->id)->first();
				if($get['gtog']==1)
				{
					return view('live_bird_transfer/gtognew');
				}
				else
				{
					return redirect()->route('login');
				}
			}
			if($userdata['role']==1)
			{
				return view('live_bird_transfer/gtognew');
			}
		}
		else
		{
			return redirect()->route('login');
		}
		

	}
	public function stognew()
	{
		$userdata=Session::get('userdata');
		if($userdata!=null)
		{
			if($userdata['role']==5)
			{
				$get=Godawn_user::where('user_id',$userdata->id)->first();
				if($get['stog']==1)
				{
					return view('live_bird_transfer/stognew');
				}
				else
				{
					return redirect()->route('login');
				}
			}
			if($userdata['role']==1)
			{
				return view('live_bird_transfer/stognew');
			}
		}
		else
		{
			return redirect()->route('login');
		}
		
	}
	public function stosnew()
	{
		$userdata=Session::get('userdata');
		if($userdata!=null)
		{
			if($userdata['role']==5)
			{
				$get=Godawn_user::where('user_id',$userdata->id)->first();
				if($get['stos']==1)
				{
					return view('live_bird_transfer/stosnew');
				}
				else
				{
					return redirect()->route('login');
				}
			}
			if($userdata['role']==1)
			{
				return view('live_bird_transfer/stosnew');
			}
		}
		else
		{
			return redirect()->route('login');
		}
		
	}
}
