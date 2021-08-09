<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
	public function index() {
		$users = User::all();
		return view('user.index', compact('users'));
	}

	public function create() {
		return view('user.create');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'role' => 'required|string|max:255',
			'password' => ['required', Password::defaults()],
		]);

		try {

			User::create([
				'name' => $request->name,
				'email' => $request->email,
				'role' => $request->role,
				'password' => Hash::make($request->password),
			]);

		} catch (\Exception $e) {
		    Log::error('Location: UserController store Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return Redirect::route('users.index');
	}

	public function edit(User $user) {
		return view('user.edit', compact('user'));
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function update(Request $request, User $user)
	{

		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
			'role' => 'required|string|max:255',
			'password' => ['nullable', Password::defaults()],
		]);

		try {

			$user->name = $request->name;
			$user->email = $request->email;
			$user->role = $request->role;

			if( !empty($request->password) ){
				$user->password = Hash::make($request->password);
			}

			$user->save();

		} catch (\Exception $e) {
		    Log::error('Location: UserController update Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return Redirect::route('users.index');
	}

	public function destroy(User $user){

		try {

			$user->forceDelete();

		} catch (\Exception $e) {
			Log::error('Location: UserController destroy Line: ' . $e->getLine(). ' - Message ' . $e->getMessage());
		}

		return Redirect::route('users.index');
	}
}
