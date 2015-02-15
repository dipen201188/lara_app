<?php
Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
)
);


/*
 * authenticated group
 * */

Route::group(array('before' => 'auth'),function(){


	Route::group(array('before'  => 'csrf'),function(){
		/*change password post */
		Route::post('/account/change',array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));
	});

	/*log out*/
	Route::get('/account/logout',array(
		'as' => 'logout-account',
		'uses' => 'AccountController@getLogout'
	));

	/*change password */
	Route::get('/account/change',array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));
}

);

/*
 * unauthenticated group
 * */
Route::group(array('before' => 'guest'),function(){
		
	/* 
	 * before csrf
	 */
	
	Route::group(array('before'  => 'csrf'),function(){

			/*
		 * create account(Post)
		 * */

			Route::post('/account/create',array(
				'as' => 'account-create',
				'uses' => 'AccountController@postCreate'
			));


			/*sign in post*/
			Route::post('/account/login',array(
				'as'=>'login-post',
				'uses' => 'AccountController@postLogin'
			));



	});
	
	/*
	 * create account(Get)
	 * */
	 
	Route::get('/account/create',array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));
	


	Route::get('/account/activate/{code}',array(
	'as'=>'account-activate',
	'uses' => 'AccountController@getActivate'
	));


	/*sign in gets*/
	Route::get('/account/login',array(
		'as'=>'login-get',
		'uses' => 'AccountController@getLogin'
	));

});
