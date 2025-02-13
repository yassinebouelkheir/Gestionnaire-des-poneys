@extends('app')

@section('content')
    <h1>Gestion des Poneys</h1>
    <div class="main-container">
    <section>
      <table>
        <thead>
          <tr>
            <th>Nom du poney</th>
            <th>Heures travaillées</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($poneys as $poney)
        <tr>
            <td>{{ $poney->nom }}</td>
            <td>{{ $poney->heures }}h sur {{ $poney->heures_max }}h</td>
            <td>
              <form action="{{ route('poneys.edit', $poney->id) }}">
                <button type="submit" style="all: revert;">✏️ Modifier</a>
              </form>
              <form method="POST" action="{{ route('poneys.destroy', $poney->id) }}" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="all: revert;">🗑️ Supprimer</button>
              </form>
            </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </section>
    <section>
      <form class="add-pony" method="POST" action="{{ route('poneys.add') }}">
        @csrf
        <h3>Ajouter un nouveau poney :</h3>
        <input type="text" id="nom_poney" name="nom_poney" placeholder="Nom du poney" required>
        <input type="number" id="max_heures" name="max_heures" placeholder="Heures de travail max" required>
        <button type="submit">Ajouter</button>
      </form>
    </section>
  </div>
@endsection
