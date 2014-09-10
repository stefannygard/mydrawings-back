<?php

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		Auth::logout();
        return Response::json([
                'flash' => 'you have been disconnected'],
            200
        );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}
  
  public function register()
  {
    $validator = Validator::make(
      array(
          'password' => Input::json('password'),
          'email' => Input::json('email')
      ),
      array(
          'password' => 'required|min:4',
          'email' => 'required|email|unique:users'
      )
    );
    
    if ($validator->fails())
    {
      $messages = $validator->messages();
      return Response::json(array('flash' => $messages->first('email') . " " . $messages->first('password')), 401);  
    } else {
        $user = new User;
        $user->email = Input::json('email');
        $user->password = Hash::make(Input::json('password'));
        $user->save();
        return Response::json(array('flash' => 'Konto skapat!'));
    }
  }
  
	public function login()
  {
    if(Auth::attempt(array('email' => Input::json('email'), 'password' => Input::json('password'))))
    {
      return Response::json(Auth::user());
    } else {
      return Response::json(array('flash' => Lang::get('messages.auth_failed')), 401);
    }
  }

  public function logout()
  {
    Auth::logout();
    return Response::json(array('flash' => 'Logged Out!'));
  }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
