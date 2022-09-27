<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $users = User::all();
        if(count($users) > 0){
            if(isset($data['type']) && $data['type'] == 'Pro'){
                return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'phone' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255', 'unique:users'],
                    'image' => ['image', 'max:2048'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            }
            else{
                return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'image' => ['image', 'max:2048'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
            }
        }
        else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'image' => ['image', 'max:2048'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $users = User::all();
        if(count($users) >  0){
            if(isset($data['type']) && $data['type'] == 'Pro'){
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'type' => 'Pro',
                    'password' => Hash::make($data['password']),
                ]);
                $image = request()->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $extension = $image->getClientOriginalExtension();
                    $fullname = $name.'.'.$extension;
                    $path = 'public/images/users/';
                    $url = $path.$fullname;
                    $resize_image=Image::make($image->getRealPath());
                    $resize_image->resize(500,500);
                    $resize_image->save('public/images/users/'.$fullname);
                    $user->update(['image' => $url]);
                }
                return $user;
            }
            else{
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'type' => 'User',
                    'password' => Hash::make($data['password']),
                ]);
                $image = request()->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $extension = $image->getClientOriginalExtension();
                    $fullname = $name.'.'.$extension;
                    $path = 'public/images/users/';
                    $url = $path.$fullname;
                    $resize_image=Image::make($image->getRealPath());
                    $resize_image->resize(500,500);
                    $resize_image->save('public/images/users/'.$fullname);
                    $user->update(['image' => $url]);
                }
                return $user;
            }
        }
        else{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => 'Admin',
                'password' => Hash::make($data['password']),
            ]);
            $image = request()->file('image');
            if($image){
                $name = hexdec(uniqid());
                $extension = $image->getClientOriginalExtension();
                $fullname = $name.'.'.$extension;
                $path = 'public/images/users/';
                $url = $path.$fullname;
                $resize_image=Image::make($image->getRealPath());
                $resize_image->resize(500,500);
                $resize_image->save('public/images/users/'.$fullname);
                $user->update(['image' => $url]);
            }
            return $user;
        }
    }
}
