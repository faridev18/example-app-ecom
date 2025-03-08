<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function register()
    {
        return view("auth.register");
    }

    public function saveuser(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name'            => 'required',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:6',
            "repeat-password" => "required|same:password",
        ], [
            'name.required'            => 'Le champ nom est obligatoire.',
            'email.required'           => 'Le champ e-mail est obligatoire.',
            'email.email'              => 'Veuillez entrer une adresse e-mail valide.',
            'email.unique'             => 'Cette adresse e-mail est déjà utilisée.',
            'password.required'        => 'Le champ mot de passe est obligatoire.',
            'password.min'             => 'Le mot de passe doit contenir au moins :min caractères.',
            'repeat-password.required' => 'Le champ répéter le mot de passe est obligatoire.',
            'repeat-password.same'     => 'Les mots de passe ne correspondent pas.',
        ]);

        // Methode 1

        // $user = new User;

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);

        
        // $query = $user->save();


        // Methode 2

        // $query = DB::table('users')->insert([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     "created_at" => date('Y-m-d H:i:s')
        // ]);

        // Methode 3

        $query = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

       
        return back()->with('success','You have been successfuly registered');

    }
}
