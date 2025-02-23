@extends('app')

@section('content')
    <h1>Historique des Paiements</h1>
    <div class="main-container">
        <section>
            <h2>Historique :</h2>
            <table>
                <thead>
                    <tr>
                        <th>Mois</th>
                        <th>Montant (€)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historique as $entry)
                    <tr>
                        <td>{{ $entry->mois }} {{ $entry->année }}</td>
                        <td>€ {{ number_format($entry->total, 0, ',', ' ') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section>
            <h3>Mois en cours :</h3>
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Nombre des heures</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                    <tbody>
                    @php
                        $currentMonthNumber = now()->month;
                        $currentYear = now()->year;
                        $currentMonthFr = $frenchMonths[$currentMonthNumber] ?? 'Mois inconnu';
                    @endphp

                    @foreach ($historique->where('mois', $currentMonthFr)->where('année', $currentYear) as $current)
                    <tr>
                        <td>{{ $current->nom }}</td>
                        <td>{{ $current->heures }}h</td>
                        <td>€ {{ number_format($current->total, 0, ',', ' ') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <th style='text-align:center; vertical-align:middle'>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style='text-align:center; vertical-align:middle'>
                            € {{ number_format($currentMonthTotal, 0, ',', ' ') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <form class="envoyer-factures" action="rendezvous" method="GET">
                @csrf
                <button type="submit">Envoyer toutes les factures</button>
            </form>
        </section>
    </div>
@endsection