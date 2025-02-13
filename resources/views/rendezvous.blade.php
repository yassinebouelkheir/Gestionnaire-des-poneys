@extends('app')
 
@section('content')
  <h1>{{ ucfirst(now()->translatedFormat('l, d F Y')) }}</h1>
  <div class="main-container">
    <section>
      <h2>Rendez-vous prévus :</h2>
      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Période</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Z'amis des Z'animaux</td>
            <td>12h30 à 14h30</td>
          </tr>
        </tbody>
      </table>
    </section>
    <section>
      <form class="assign-ponies">
        <h3>Enregistrer un nouveau client:</h3>
        <label>
          Nom du client
          <input type="text" id="nom_client" name="nom_client" size="24" required>
        </label>
        <label>
          Nbr personnes
          <input type="number" id="nom_client" name="nom_client" required>
        </label>
        <label>
          Date
          <input type="datetime-local" id="rendezvous" name="rendezvous" min="<?= date('Y-m-d', strtotime('tomorrow')) . 'T00:00' ?>" required>
        </label>
        <label>
          Heures
          <input type="number" id="nom_client" name="nom_client" required>
        </label>
        <label>
          Prix
          <input type="number" id="nom_client" name="nom_client" required>
        </label>
        <label>
          Poney 1
          <select>
            <option>Bébert le gros</option>
          </select>
        </label>
        <label>
          Poney 2
          <select>
            <option>Gros Tonnerre</option>
          </select>
        </label>
        <label>
          Poney 3
          <select>
            <option>Bébert le gros</option>
          </select>
        </label>
        <label>
          Poney 4
          <select>
            <option>Gros Tonnerre</option>
          </select>
        </label>
        <button type="submit">Confirmer</button>
      </form>
    </section>
  </div>
@endsection