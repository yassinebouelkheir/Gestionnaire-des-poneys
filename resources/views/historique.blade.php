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
          <tr>
            <td>Septembre 2024</td>
            <td>14 500 €</td>
          </tr>
        </tbody>
      </table>
      </section>
      <section>
      <h3>Mois en cours :</h3>
      <table>
        <thead>
          <tr>
            <th>Client</th>
            <th>Nombre de jours</th>
            <th>Montant</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Z'amis des Z'animaux</td>
            <td>10</td>
            <td>1 700 €</td>
          </tr>
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
            <td style='text-align:center; vertical-align:middle'>1 700 €</td>
          </tr>
        </tbody>
      </table>
      <form class="envoyer-factures">

        <button type="submit">Envoyer toutes les factures</button>
      </form>
    </section>
  </div>
@endsection
