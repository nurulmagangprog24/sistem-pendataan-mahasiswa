<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
// {
//     use RegistersUsers;

//     /**
//      * Where to redirect users after registration.
//      *
//      * @var string
//      */
//     protected $redirectTo = '/home';

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest');
//     }

//     /**
//      * Get a validator for an incoming registration request.
//      *
//      * @param  array  $data
//      * @return \Illuminate\Contracts\Validation\Validator
//      */
//     protected function validator(array $data)
//     {
//         return Validator::make($data, [
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);
//     }

//     /**
//      * Create a new user instance after a valid registration.
//      *
//      * @param  array  $data
//      * @return \App\Models\User
//      */
//     protected function create(array $data)
//     {
//         $user = User::create([
//             'username' => $data['username'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//             'role' => $data['role'],
//         ]);
    
//         if ($data['role'] == 'kaprodi') {
//             Kaprodi::create([
//                 'user_id' => $user->id,
//                 'kode_dosen' => $data['kode_dosen'],
//                 'name' => $data['name'],
//             ]);
//         } elseif ($data['role'] == 'dosen') {
//             Dosen::create([
//                 'user_id' => $user->id,
//                 'kelas_id' => $data['kelas_id'],
//                 'kode_dosen' => $data['kode_dosen'],
//                 'name' => $data['name'],
//             ]);
//         } elseif ($data['role'] == 'mahasiswa') {
//             Mahasiswa::create([
//                 'user_id' => $user->id,
//                 'kelas_id' => $data['kelas_id'],
//                 'nim' => $data['nim'],
//                 'name' => $data['name'],
//                 'tempat_lahir' => $data['tempat_lahir'],
//                 'tanggal_lahir' => $data['tanggal_lahir'],
//             ]);
//         }
    
//         return $user;
//     }
// }
{
    public function register(){
        return view('auth.register');
    }

    public function register_proses(Request $request){
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|uique:users,email',
            'password' => 'required|min:6'
        ]);

        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($login)){
            return redirect()->route('dashboard');
        }
        else {
            return redirect()->route('login')->with('failed', 'Email atau Password salah');
        }
        
    }
}