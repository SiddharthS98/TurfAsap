<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Turfasap\ImageHelper\ImageRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'r_name' => 'required|string|max:255',
            'r_email' => 'required|string|email|max:255|unique:users,email',
            'r_password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $i = new ImageRepository();
        $p = $i->getImageFromName($data['r_name']);

        return User::create([
            'name' => $data['r_name'],
            'email' => $data['r_email'],
            'image_path' => $p,
            'phone' => $data['r_phone'],
            'role_id' => $data['r_role'],
            'verified' => $data["r_role"] == 3 ? 1 : 0,
            'password' => Hash::make($data['r_password']),
        ]);
    }
}
