<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;


class AuthenticateController extends Controller
{

	/**
	 * Enforce authentication
	 */
	public function __construct()
	{
		$this->middleware('jwt.auth', ['except' => ['authenticate']]);
	}

	public function authenticate(Request $request)
	{
		// grab credentials from the request
		$credentials = $request->only('email', 'password');

		try {
			// attempt to verify the credentials and create a token for the user
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['error' => 'invalid_credentials'], 401);
			}
		} catch (JWTException $e) {
			// something went wrong whilst attempting to encode the token
			return response()->json(['error' => 'could_not_create_token'], 500);
		}

		$ThisUser = User::where('email', $request->email)->first();
		$ThisUser->remember_token = $token;
		$ThisUser->save();

		// all good so return the token
		return json_encode($ThisUser);
	}
}