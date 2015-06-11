<?php 

class UserController extends BaseController {
	
	// GET: /user/login
	public function showLogin() {
		if (Auth::check()) {
			return Redirect::to('/task');
		}

		return View::make('login');
	}

	// POST: /user/login
	public function processLogin() {
		$credientials = array(
			'email' => Input::get('email'),
			'password' => Input::get('pass')
		);
		
		if (Auth::attempt($credientials, Input::get('remember'))) {
			return Redirect::intended('/task/list');
		}

		return View::make('login')->with('message', 'Your email and/or password is invalid.');
	}	

	// GET: /user/logout
	public function processLogout() {
		if (Auth::check()) {
			Auth::logout();
		}

		return Redirect::to('/');
	}

	public function checkLogin() {
			if (Auth::check()) {
			return 'You are logged in';
		}

		return 'You aren\'t logged in.';
	}

	// GET: /user/register
	public function showForm() {
		return View::make('register');
	}

	// POST: /user/register
	public function processForm() {
		
		if (Input::get('agree') == false) {
			return View::make('register')->with('message', 'Cookies are required for <em>Todo</em> to remember your tasks and settings.');
		}

		$user = new User;
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('pass'));
		
		// if: account exists, reject registration
		$input['email'] = Input::get('email');
		
		// Must not already exist in the `email` column of `users` table
		$rules = array('email' => 'unique:users,email');
		
		$validator = Validator::make($input, $rules);
		
		if ($validator->fails()) {
		    return View::make('register')->with('message', 'An account with that email address already exists.');
		}
		
		else {
		    $user->save();
			return View::make('show_tasks');
		}
	}

	// GET: /user/settings
	public function showSettings() {
		$user = Auth::user();

		return View::make('settings')->with( 
			array(
				'hide_empty' => $user->hide_empty,
				'notify' => $user->notify,
				'auto_push' => $user->auto_push,
				'fast_remove' => $user->fast_remove
			)
		);

	}

	// POST: /user/settings
	public function processSettings() {
		$user = Auth::user();

		$user->hide_empty = Input::get('hide_empty');
		$user->notify = Input::get('notify');
		$user->auto_push = Input::get('auto_push');
		$user->fast_remove = Input::get('fast_remove');
		$user->save();
		
		return View::make('settings')->with(
			array(
				'message' => 'Your settings have been saved.',
				'hide_empty' => $user->hide_empty,
				'notify' => $user->notify,
				'auto_push' => $user->auto_push,
				'fast_remove' => $user->fast_remove
			)
		);
	}

}