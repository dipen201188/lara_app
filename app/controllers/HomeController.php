<?php

class HomeController extends BaseController {

	public function Home()
	{
	//	Mail::send('emails.auth.test',array('name' => 'Dipen'), function($message){$message->to('dipen201188@gmail.com','dipen shah')->subject('Test email');});


		return View::make('home');
	}

}
 ?>