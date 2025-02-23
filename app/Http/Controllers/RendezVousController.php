<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RDV;
use App\Models\Poney;
use App\Models\Historique;
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
            $rdv = RDV::find($request->rdv_id);
            if (!$rdv) {
                return redirect()->back()->with('error', 'Ce rendezvous est introuvable.');
            }

            $oldPoneys = [$rdv->poney_1, $rdv->poney_2, $rdv->poney_3, $rdv->poney_4];
            foreach ($oldPoneys as $poneyId) {
                if ($poneyId) {
                    $poney = Poney::find($poneyId);
                    if ($poney) {
                        $poney->heures -= $rdv->heures;
                        $poney->save();
                    }
                }
            }

            $rdv->update($validated);

            $newPoneys = [$request->poney_1, $request->poney_2, $request->poney_3, $request->poney_4];
            foreach ($newPoneys as $poneyId) {
                if ($poneyId) {
                    $poney = Poney::find($poneyId);
                    if ($poney) {
                        $poney->heures += $request->heures;
                        $poney->save();
                    }
                }
            }

            return redirect()->route('rendezvous.index')->with('success', 'Rendezvous a été mise à jour.');
        } else {
            $rdv = RDV::create($validated);

            $this->updateHistorique($request->nom_client, $request->prix, $request->heures);

            $newPoneys = [$request->poney_1, $request->poney_2, $request->poney_3, $request->poney_4];
            foreach ($newPoneys as $poneyId) {
                if ($poneyId) {
                    $poney = Poney::find($poneyId);
                    if ($poney) {
                        $poney->heures += $request->heures;
                        $poney->save();
                    }
                }
            }

            return redirect()->route('rendezvous.index')->with('success', 'Rendezvous a été crée avec succès.');
        }
    }

    public function cancel($id)
    {
        $rdv = RDV::findOrFail($id);

        $heures = $rdv->heures;
        $poneyIds = array_filter([$rdv->poney_1, $rdv->poney_2, $rdv->poney_3, $rdv->poney_4]);

        Poney::whereIn('id', $poneyIds)->decrement('heures', $heures);

        $this->updateHistorique($rdv->nom_client, -$rdv->prix, -$rdv->heures);

        $rdv->delete();

        return redirect()->back()->with('success', 'Rendezvous annulé avec succès');
    }

    private function updateHistorique($nom_client, $prix, $heures)
    {
        $now = Carbon::now();
        $annee = $now->format('Y');

        $frenchMonths = [
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre',
        ];

        $mois = $frenchMonths[$now->format('m')];
        $historique = Historique::firstOrNew([
            'nom' => $nom_client,
            'mois' => $mois,
            'année' => $annee
        ]);

        $historique->total += $prix;
        $historique->heures += $heures;

        $historique->save();
    }
}
