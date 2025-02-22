<?php

namespace App\Http\Controllers;

use App\Models\RDV;
use App\Models\Poney;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezvous = RDV::with(['poneyOne', 'poneyTwo', 'poneyThree', 'poneyFour'])->get();

        $poneys = Poney::all();

        return view('rendezvous', compact('rendezvous', 'poneys'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'heures' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
            'personnes' => 'required|integer|min:1|max:4',
            'date_time' => 'required|date_format:H:i',
            'poney_1' => 'nullable|exists:poneys,id',
            'poney_2' => 'nullable|exists:poneys,id',
            'poney_3' => 'nullable|exists:poneys,id',
            'poney_4' => 'nullable|exists:poneys,id',
        ]);

        $heures = $validated['heures'];
        
        $poneyIds = array_filter([
            $request->poney_1, 
            $request->poney_2, 
            $request->poney_3, 
            $request->poney_4
        ], function($value) {
            return $value != -1 && !is_null($value);
        });

        if (count($poneyIds) != count(array_unique($poneyIds))) {
            return redirect()->back()->withErrors(['poney' => 'Vous ne pouvez pas sélectionner le même poney plusieurs fois']);
        }

        if (count($poneyIds) != $validated['personnes']) {
            return redirect()->back()->withErrors(['personnes' => 'Le nombre de poneys sélectionnés ('.count($poneyIds).') doit correspondre au nombre de personnes ('.$validated['personnes'].')']);
        }

        $ponies = Poney::whereIn('id', $poneyIds)->get();

        foreach ($ponies as $poney) {
            $heures_restantes = $poney->heures_max - $poney->heures;
            if ($heures > $heures_restantes) {
                return redirect()->back()->withErrors([
                    "Le poney {$poney->nom} ne peut pas travailler plus que {$heures_restantes} heures aujourd'hui."
                ]);
            }
        }
        if ($request->rdv_id) {
            $rdv = RDV::findOrFail($request->rdv_id);
            $rdv->update([
                'poney_1' => $request->poney_1,
                'poney_2' => $request->poney_2,
                'poney_3' => $request->poney_3,
                'poney_4' => $request->poney_4,
            ]);

            return redirect()->route('rendezvous.index')->with('success', 'Poneys mis à jour avec succès.');
        }
        $rdv = RDV::create([
            'nom_client' => $validated['nom_client'],
            'heures' => $heures,
            'prix' => $validated['prix'],
            'personnes' => $validated['personnes'],
            'date_time' => $validated['date_time'],
            'poney_1' => $validated['poney_1'],
            'poney_2' => $validated['poney_2'],
            'poney_3' => $validated['poney_3'],
            'poney_4' => $validated['poney_4'],

        ]);

        foreach ($ponies as $poney) {
            $poney->increment('heures', $heures);
        }

        return redirect()->back()->with('success', 'Rendez-vous ajouté avec succès.');
    }

    public function cancel($id)
    {
        $rdv = RDV::findOrFail($id);

        $heures = $rdv->heures;
        $poneyIds = array_filter([$rdv->poney_1, $rdv->poney_2, $rdv->poney_3, $rdv->poney_4]);

        Poney::whereIn('id', $poneyIds)->decrement('heures', $heures);

        $rdv->delete();

        return redirect()->back()->with('success', 'Rendezvous annulé avec succès');
    }
}
