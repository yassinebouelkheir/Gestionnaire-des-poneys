<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoriqueController extends Controller
{
    public function index()
    {
        $historiques = DB::table('historique')
            ->orderBy('année', 'desc')
            ->orderByRaw("CASE 
                WHEN mois = 'Janvier' THEN 1
                WHEN mois = 'Février' THEN 2
                WHEN mois = 'Mars' THEN 3
                WHEN mois = 'Avril' THEN 4
                WHEN mois = 'Mai' THEN 5
                WHEN mois = 'Juin' THEN 6
                WHEN mois = 'Juillet' THEN 7
                WHEN mois = 'Août' THEN 8
                WHEN mois = 'Septembre' THEN 9
                WHEN mois = 'Octobre' THEN 10
                WHEN mois = 'Novembre' THEN 11
                WHEN mois = 'Décembre' THEN 12
                ELSE 13
            END")
            ->get();

        $frenchMonths = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre'
        ];

        $currentMonthNumber = now()->month;
        $currentMonthFr = $frenchMonths[$currentMonthNumber];

        $currentMonthTotal = Historique::where('mois', $currentMonthFr)
            ->where('année', now()->year)
            ->sum('total');

        return view('historique', [
            'historique' => $historiques,
            'currentMonthTotal' => $currentMonthTotal,
            'frenchMonths' => $frenchMonths
        ]);
    }
}