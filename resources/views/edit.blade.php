@extends('app')

@section('content')
    <h1>Modifier le Poney</h1>
    <form method="POST" action="{{ route('poneys.update', $poney->id) }}">
        @csrf
        @method('PUT')

        <label>Nom du Poney:</label>
        <input type="text" name="nom_poney" value="{{ $poney->name }}" required>

        <label>Heures Max:</label>
        <input type="number" name="heures_max" value="{{ $poney->heures_max }}" required>

        <button type="submit">Modifier</button>
    </form>
    <form action="{{ route('poneys.index') }}">
        <button type="submit">Annuler</a>  
    </form>
@endsection
