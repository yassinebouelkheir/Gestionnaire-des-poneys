<?php

namespace App\Http\Controllers;

use App\Models\Poney;
use Illuminate\Http\Request;

class PoneyController extends Controller
{
    public function index()
    {
        $poneys = Poney::all();
        return view('gestion_poneys', compact('poneys'));
    }

    public function add(Request $req)
    {
        $req->validate([
            'nom_poney' => 'required',
            'max_heures' => 'required',
        ]);

        Poney::create([
            'nom' => $req->nom_poney,
            'heures_max' => $req->max_heures,
            'heures' => 0,
        ]);

        return redirect()->route('poneys.index');
    }

    public function edit($id)
    {
        $poney = Poney::findOrFail($id);
        return view('edit', compact('poney'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'nom_poney' => 'required',
            'heures_max' => 'required',
        ]);

        $poney = Poney::findOrFail($id);
        $poney->update([
            'nom' => $req->nom_poney,
            'heures_max' => $req->heures_max,
        ]);

        return redirect()->route('poneys.index');
    }

    public function destroy($id)
    {
        $poney = Poney::findOrFail($id);
        $poney->delete();

        return redirect()->route('poneys.index');
    }
}
