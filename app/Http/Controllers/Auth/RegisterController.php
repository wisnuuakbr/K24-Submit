<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

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
            'nama'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:6', 'confirmed'],
            'no_hp'             => ['required'],
            'no_ktp'            => ['required'],
            'tanggal_lahir'     => ['required'],
            'jenis_kelamin'     => ['required'],
            'foto_path'         => ['required','file','max:1024','mimes:jpg,jpeg,png']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $tanggal_lahir = Carbon::createFromFormat('m/d/Y', $data['tanggal_lahir'])->format('Y-m-d');

        // Validate file size
        if (request()->hasFile('foto_path')) {
            $file = request()->file('foto_path');
            // $maxSize = 1024; // Maximum size in kilobytes (1MB)

            // $this->validate(request(), [
            //     'foto_path' => ['file', 'max:' . $maxSize],
            // ]);
            $path = $file->store('photos');
            // Update the 'foto_path' field in the user record
            $data['foto_path'] = $path;
        }

        return User::create([
            'nama'              => $data['nama'],
            'email'             => $data['email'],
            'role'              => 'member',
            'no_hp'             => $data['no_hp'],
            'no_ktp'            => $data['no_ktp'],
            'tanggal_lahir'     => $tanggal_lahir,
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'password'          => Hash::make($data['password']),
        ]);
    }
}