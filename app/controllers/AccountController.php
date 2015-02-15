<?php
/**
 * 
 */
class AccountController extends BaseController {


	public function getLogin(){
		return View::make('account.login');
	}

	public function postLogin(){
		$validator = Validator::make(Input::all(),
			array(
				'email'	=> 'required|email',
				'password' => 'required'
			)
			);
		if ($validator->fails())
		{
			return Redirect::route('login-post')
				->withErrors($validator)
				->withInput();
		}
		else{
			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password'=>Input::get('password'),
				'active' => 1
			),true);

			if($auth)
			{
				//Redirect to the intended page
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('login-post')
				->with('global','Email/Password wrong or account not activated');
			}
		}

		return Redirect::route('login-post')
			->with('global','There was a problem signing you in.');

	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home');
	}


	public function getCreate(){
		return View::make('account.create');
	}
	
	public function postCreate()
	{
		$validator = Validator::make(Input::all(),
		array(
			'email' 			=> 'required|email|max:50|unique:users',
			'username' 			=> 'required|max:20|min:3|unique:users',
			'password' 			=> 'required|min:6',
			'password_again' 	=> 'required|same:password' 	
		));
		
		if($validator->fails())
		{
			return Redirect::route('account-create')
				-> withErrors($validator)
				-> withInput();

		}
		else
		{
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');

			//activation code

			$code = str_random(60);
			$user = User::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
			));

			if($user)
			{
				//send activation email
				Mail::send('emails.auth.activate',
							array('link' => URL::route('account-activate',$code),'username' =>$username),
							function($message) use ($user){
								$message->to($user->email,$user-> username)->subject('Activate Account');
							});


				return Redirect::route('home')
					->with('global','Your account has been created! we have sent you activation email please activate your account');
			}


		}
	}

	public function getActivate($code)
	{
		$user = User::where('code', '=',$code)->where('active','=',0);
		if($user->count())
		{
			$user = $user->first();
			$user->active = 1;
			$user->code = '';
			if($user->save())
			{
				return Redirect::route('home')
					->with('global','Your account is now activated you can now log in.');
			}

		}
		return Redirect::route('home')
			->with('global','we could not activate your account try again later');
	}

	public function getChangePassword()
	{
		return View::make('account.password');
	}
	public function postChangePassword()
	{	echo"<pre>".("inpostchange method")."</pre>";

		$validator = Validator::make(Input::all(),
			array(
				'current_password' => 'required',
				'password' => 'required|min:6',
				'password_again' => 'required|same:password'
			)
		);
		if($validator->fails())
		{
			//redirect
			//}
			Redirect::route('account-change-password')
				->withErrors($validator);
		}
		else{
			//change password
			$user = User::find(Auth::user()->id);
			$current_password = Input::get('current_password');
			$password = Input::get('password');

			if(Hash::check($current_password,$user->getAuthPassword()))
			{
				//password provided by user maches
				$user->password = Hash::make('password');
				if($user->save())
				{
					return Redirect::route('home')
						->with('global','your password has been change');
				}
			}
			else
			{
				return Redirect::route('account-change-password')
					->with("global","Current password is invalid");
			}
		}
		return Redirect::route('account-change-password')
			->with("global","Your password cannot be changed");
	}
}



