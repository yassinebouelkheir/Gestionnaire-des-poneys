<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuth extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            'nom_utilisateur' => 'required',
            'mdp' => 'required',
        ]);

        $user = User::where('nom_utilisateur', $req->nom_utilisateur)->first();

        if (!$user || !Hash::check($req->mdp, $user->mdp)) {
            return back()->withErrors(['mdp' => 'Mot de passe ou utilisateur incorrect']);
        }

        Auth::login($user);
        return redirect()->route('rendezvous.index');

    }
    public function logout(Request $req) {
        Auth::logout();
        $req->session()->forget('user');
        return redirect('/login');
    }
}

