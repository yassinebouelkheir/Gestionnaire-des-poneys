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
                        <th>Date</th>
                        <th>Heures</th>
                        <th>Poneys</th>
                        <th>Nbr perso.</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rendezvous as $rdv)
                        <tr>
                            <td>{{ $rdv->nom_client }}</td>
                            <td>{{ $rdv->date_time }}</td>
                            <td>{{ $rdv->heures }}h</td>
                            <td>
                                {{ $rdv->poneyOne?->nom ?? '-' }},
                                {{ $rdv->poneyTwo?->nom ?? '-' }},
                                {{ $rdv->poneyThree?->nom ?? '-' }},
                                {{ $rdv->poneyFour?->nom ?? '-' }}
                            </td>
                            <td>{{ $rdv->personnes }}</td>
                            <td>€ {{ $rdv->prix }}</td>
                            <td>
                                <button class="edit-btn"
                                    data-id="{{ $rdv->id }}"
                                    data-nom="{{ $rdv->nom_client }}"
                                    data-date="{{ $rdv->date_time }}"
                                    data-heures="{{ $rdv->heures }}"
                                    data-prix="{{ $rdv->prix }}"
                                    data-personnes="{{ $rdv->personnes }}"
                                    data-poney1="{{ $rdv->poney_1 }}"
                                    data-poney2="{{ $rdv->poney_2 }}"
                                    data-poney3="{{ $rdv->poney_3 }}"
                                    data-poney4="{{ $rdv->poney_4 }}">
                                    Modifier
                                </button>
                                 <form action="{{ route('rendezvous.cancel', $rdv->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="all: revert;">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section>
            <h3 id="form-title">Ajouter un nouveau rendez-vous</h3>
            <form id="rendezvous-form" method="POST" action="{{ route('rendezvous.store') }}">
                @csrf
                <input type="hidden" name="rdv_id" id="edit-rdv-id">

                <label>Nom du client
                    <input type="text" name="nom_client" id="nom-client" required>
                </label>

                <label>Heures
                    <input type="number" name="heures" id="heures" min=0 max=4 required>
                </label>

                <label>Prix
                    <input type="number" name="prix" id="prix" min=0 max=4 required>
                </label>

                <label>Nbr Personnes
                    <input type="number" name="personnes" id="personnes" min=0 max=4 required>
                </label>

                <label>Heure du rendez-vous
                    <input type="time" name="date_time" id="date-time" min="{{ now()->timezone('Europe/Brussels')->format('H:i') }}" max="17:00" required>
                </label>
                @for ($i = 1; $i <= 4; $i++)
                    <label>Poney {{ $i }}
                        <select name="poney_{{ $i }}">
                            <option value="">-- Choisir --</option>
                            @foreach ($poneys as $poney)
                                <option value="{{ $poney->id }}">
                                    {{ $poney->nom }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                @endfor
                <button type="submit" id="submit-btn">Ajouter Rendez-vous</button>
                @if(session('success'))
                    <p style="color: green; margin-top: 10px;">{{ session('success') }}</p>
                @endif

                @if($errors->any())
                    <p style="color: red; margin-top: 10px;">
                        {{ implode(', ', $errors->all()) }}
                    </p>
                @endif
            </form>
        </section>
    </div>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("rendezvous-form");
            const submitButton = document.getElementById("submit-btn");
            const formTitle = document.getElementById("form-title");
            const hiddenIdField = document.getElementById("edit-rdv-id");
            const nomClientField = document.getElementById("nom-client");
            const heuresField = document.getElementById("heures");
            const prixField = document.getElementById("prix");
            const nbrPersonnes = document.getElementById("personnes");
            const dateTimeField = document.getElementById("date-time");
            const selects = document.querySelectorAll(".pony-select");
            const editButtons = document.querySelectorAll(".edit-btn");

            function updateOptions() {
                let selectedValues = new Set();

                selects.forEach(select => {
                    if (select.value) {
                        selectedValues.add(select.value);
                    }
                });

                selects.forEach(select => {
                    let currentValue = select.value;
                    select.querySelectorAll("option").forEach(option => {
                        if (option.value && option.value !== currentValue) {
                            option.disabled = selectedValues.has(option.value);
                        }
                    });
                });
            }

            selects.forEach(select => {
                select.addEventListener("change", updateOptions);
            });

            updateOptions();

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    form.action = "{{ route('rendezvous.store') }}";
                    hiddenIdField.value = this.dataset.id;
                    nomClientField.value = this.dataset.nom;
                    heuresField.value = this.dataset.heures;
                    prixField.value = this.dataset.prix;
                    nbrPersonnes.value = this.dataset.personnes;
                    dateTimeField.value = this.dataset.date;

                    nomClientField.disabled = true;
                    heuresField.disabled = true;
                    prixField.disabled = true;
                    nbrPersonnes.disabled = true;
                    dateTimeField.disabled = true;

                    selects.forEach((select, index) => {
                        select.value = this.dataset["poney" + (index + 1)];
                    });

                    updateOptions();
                    submitButton.textContent = "Modifier Poneys";
                    formTitle.textContent = "Modifier les poneys du rendez-vous";
                });
            });

            form.addEventListener("submit", function() {
                nomClientField.disabled = false;
                heuresField.disabled = false;
                prixField.disabled = false;
                nbrPersonnes.disabled = false;
                dateTimeField.disabled = false;
            });
        });
    </script>
@endsection
