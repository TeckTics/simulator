@extends('admin.master', ['activePage' => 'map'])
@section('title', __('Map'))
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <div class="container-fluid py-4">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Map</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                                                                                                                                                                                                                                                                                                                                                                                                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>
        <div>
            <div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="mutedInput" class="sr-only peer">
                    <div
                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all  peer-checked:bg-blue-600">
                    </div>
                    <audio id="audio" muted hidden src="{{ asset('assets/son/warning.mp3') }}"></audio>
                    <span class="ms-3 text-sm font-medium text-gray-900 ">Desactiver le son</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 ">Toggle me</span>
                </label> <br>
                <div class="inline-flex items-center gap-2">
                    <input type="range" min="5" max="30" value="15">
                    <label class="ms-3 text-sm font-medium text-gray-900 " for="">Zoom</label>
                </div>
                <div class="inline-flex items-center gap-2">
                    <input id="volumeInput" type="range" min="0" max="100" value="50">
                    <label class="ms-3 text-sm  font-medium text-gray-900 " for="">Volume des
                        effects de son</label>
                </div>
            </div>
            <form id="alert-mission" method="POST">
                @csrf
                <div id="card-mission" hidden class="alert flex flex-col gap-4 text-sm border-l-8 border-red-400">

                    <div>
                        Régulation SAMU: <br>
                        <p>Bonjour, je suis Olivier de la régulation SAMU, nous avons une mission sur votre secteur:</p>
                    </div>

                    Message: <p id="mission-description"></p>
                    <div class="mt-2">
                        <input hidden value="${element.id}" id="mission_id" name="mission_id" />
                        <button value type="button" id="accept-btn" data-modal-target="mission-modal"
                            data-modal-toggle="mission-modal" name="accept"
                            class="btn bg-orange-400 start-mission text-xs btn-warning">Envoyer unité</button>
                        <button type="submit" name="waiter" id="waiter-btn"
                            class="btn bg-stone-200 add-mission-to-map text-xs btn-light">En attente</button>
                        <button type="submit" name="reject"
                            class="btn reject-mission bg-red-500 text-xs btn-danger">Refuser</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div id="map" class="w-full col-lg-8 relative z-40 h-96 "></div>
            <div class="col-lg-4 p-4">
                <div class="relative overflow-x-auto">
                    <h2>Mes missions </h2>
                    <ol style="list-style: none;" class="ps-5 mt-2 space-y-1 list-decimal list-inside">
                        @foreach ($missionUser as $item)
                            <li>
                                <div class="w-full mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                        {{ $item->nom_mission }}</div>
                                                    <div class="h5 mb-0 text-xs text-gray-500">Recompense:
                                                        {{ $item->recompense }} Pièces
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button name="mission{{ $item->id }}"
                                                        class="btn btn-primary getMissionMap text-xs">Envoyer une
                                                        unité</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mt-4 gap-4">
            <div class="col-lg-4 overflow-hidden ">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Capacite
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Position
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hopitals as $item)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $item->nom_hopital }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->capacite_hopital }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $item->position_x }}, {{ $item->position_y }}
                                    </td>
                                    <td class="px-6 py-4 flex gap-2 items-start">
                                        <button class="text-sm btn btn-primary">Focus sur la carte </button>
                                        <a href="{{ url('/admin/api/delete-hopital/' . $item->id) }}"
                                            class="text-sm btn btn-danger"><svg class="w-4 h-4 text-gray-800 "
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" fill="#ffffff" viewBox="0 0 24 24">
                                                <path fill-rule="#ffffff"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="#ffffff" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4  rounded-md overflow-hidden ">
                <div class="mb-2">
                    <button name="add-hopital" id="add-hopital-map"
                        class="btn btn-primary text-sm show-formation-edit ">Nouveau hôpital</button>
                </div>
                <div class="relative overflow-x-auto " id="add-hopital" hidden>
                    <form class="modal-content" enctype="multipart/form-data" method="POST"
                        action="{{ route('add.hopital') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouveau hôpital</h5>
                            <button name="add-hopital" id="remove-hopital-map" class="close-modal-button" type="button"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-1">
                                <label for="nom_hopital" class="block mb-2 text-sm font-medium text-gray-900 ">Nommer
                                    l'hôpital</label>
                                <input type="text" id="nom_hopital" name="nom_hopital" required
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                            </div>
                            <div class="mb-1">
                                <label for="capacite_hopital" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre
                                    de place
                                    maximal</label>
                                <input type="number" id="capacite_hopital" placeholder="0" name="capacite_hopital"
                                    required
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                            </div>
                            <div class="mb-1">
                                <label for="capacite_hopital"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Position sur la
                                    map</label>
                                <div class="flex gap-4">
                                    <input type="text" inputmode="decimal" id="position_x" placeholder="longitude"
                                        name="position_x" required pattern="/^([-+,0-9.]+)(.*)/g"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                    <input type="text" inputmode="decimal" id="position_y" placeholder="latitude"
                                        name="position_y" required pattern="/^([-+,0-9.]+)(.*)/g"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                </div>
                            </div>

                            <div class=" mt-3 mx-auto">
                                <label class="block mb-2 text-sm font-medium text-gray-900 " for="image">Icon sur la
                                    map</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none  "
                                    aria-describedby="image_help" id="imageIconHop" type="file" name="image">
                            </div>
                            <div class=" mt-3 mx-auto">
                                <label class="block mb-2 text-sm font-medium text-gray-900 " for="image">Images</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none  "
                                    aria-describedby="image_help" id="imageHop" type="file" name="image">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-sm text-blue-500" type="submit">Enregistrer</button>
                            <button class="btn btn-secondary btn-sm text-stone-500" type="button"
                                data-dismiss="modal">Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 overflow-hidden ">
                <div class="rounded-md overflow-hidden ">
                    <div class="mb-2">
                        <button name="add-base" id="add-base-map"
                            class="btn btn-primary text-sm show-formation-edit ">Nouvelle base</button>
                    </div>
                    <div class="relative overflow-x-auto " id="add-base" hidden>
                        <form class="modal-content" enctype="multipart/form-data" method="POST"
                            action="{{ route('add.base') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nouveau Base</h5>
                                <button name="add-base" id="remove-base-map" class="close-modal-button" type="button"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-1">
                                    <label for="nom_base" class="block mb-2 text-sm font-medium text-gray-900 ">Nommer
                                        la base</label>
                                    <input type="text" id="nom_base" name="nom_base" required
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                </div>
                                <div class="mb-1">
                                    <label for="type_base_id" class="block mb-2 text-sm font-medium text-gray-900 ">Type
                                        de base</label>
                                    <select id="type_base_id" name="type_base_id" required
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                        <option>Selectionner le type de votre base</option>
                                        @foreach ($typeDeBase as $item)
                                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="description_base"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Petite description de la
                                        base</label>
                                    <textarea type="text" id="description_base" name="description_base"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 "></textarea>
                                </div>
                                <div class="mb-1">
                                    <label for="capacite_hopital"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Position sur la
                                        map</label>
                                    <div class="flex gap-4">
                                        <input type="text" inputmode="decimal" id="position_x_base"
                                            placeholder="longitude" name="position_x" required
                                            pattern="/^([-+,0-9.]+)(.*)/g"
                                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                        <input type="text" inputmode="decimal" id="position_y_base"
                                            placeholder="latitude" name="position_y" required
                                            pattern="/^([-+,0-9.]+)(.*)/g"
                                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                    </div>
                                </div>
                                <div class=" mt-3 mx-auto">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="image">Icon sur
                                        la map</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none  "
                                        aria-describedby="image_help" id="imageBase" type="file" name="image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary btn-sm text-blue-500" type="submit">Enregistrer</button>
                                <button name="add-base" class="btn btn-secondary close-modal-button btn-sm text-stone-500"
                                    type="button" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div>
        <div id="mission-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-start   w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-6xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Traitement de l'appel
                        </h3>
                        <button type="button"
                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="mission-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <div class="block mb-2 text-gray-900">
                            <span class=" font-medium">Données de l'appel </span>
                            <ul class="text-sm data-mission p-2 border max-w-md">
                                <li class="flex justify-between items-center">
                                    <span class=" font-medium">Nom de la victime</span>
                                    <span id="name-patient"></span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class=" font-medium">Age de la victime</span>
                                    <span id="age-patient"></span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class=" font-medium">Adresse </span>
                                    <span id="adresse-incident"></span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class=" font-medium">Numéro de téléphone </span>
                                    <span id="phone-patient"></span>
                                </li>
                            </ul>
                        </div>
                        <form id="acceptMission" class="space-y-4" action="#">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-1">
                                    <label for="mission_base_id" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        base</label>
                                    <select id="mission_base_id" name="mission_base_id" required
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                        <option>Selectionner une base</option>
                                        @foreach ($baseUser as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom_base }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="mission_hopital_id" class="block mb-2 text-sm font-medium text-gray-900 ">
                                        Hopital</label>
                                    <select id="mission_hopital_id" name="mission_hopital_id" required
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                        <option>Selectionner un hopital</option>
                                        @foreach ($hopitals as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom_hopital }}
                                                ({{ $item->capacite_hopital }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-1">
                                    <label for="mission_unite_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Mes unités</label>
                                    <select id="mission_unite_id" name="mission_unite_id" required
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                        <option>Selectionner une unité pour la mission</option>
                                        @foreach ($uniteUser as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="mission_personnel_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Personnel</label>
                                    <select id="mission_personnel_id" name="mission_personnel_id" required
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                        <option>Selectionner un Personnel</option>
                                        @foreach ($personnel as $item)
                                            <option value="{{ $item->id }}">{{ $item->titre_personnel }}
                                                ({{ $item->quantite_personnel }})
                                                Niv {{ $item->niveau }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Engager</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal toggle -->
        {{-- <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Toggle modal
        </button> --}}

        <!-- Main modal -->

    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <script>
        // Initialisation de la map
        function getRandomArbitrary(min, max) {
            return Math.random() * (max - min) + min;
        }
        // var pointA = getRandomArbitrary(3.833119, 3.844119);
        // var map = L.map('map').setView([pointA, 11.501346], 13);
        const mutedInput = document.getElementById('mutedInput');
        mutedInput.addEventListener('change', (e) => {
            const audio = document.getElementById('audio')
            if (e.target.checked) {
                audio.play()
            } else {
                audio.pause();
                audio.currentTime = 0;
            }
        })

        const volumeInput = document.getElementById('volumeInput');
        volumeInput.addEventListener('change', (e) => {
            const audio = document.getElementById('audio')
            audio.volume = e.target.value / 100;
        })

        function getRandomIntInclusive(min, max) {
            const minCeiled = Math.ceil(min);
            const maxFloored = Math.floor(max);
            return Math.floor(Math.random() * (maxFloored - minCeiled + 1) +
                minCeiled); // The maximum is inclusive and the minimum is inclusive
        }
        // Page osm
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        // L.icon permet de créer un icon 
        // var map = L.map('map').setView([51.505, -0.09], 13);

        // Initialisation de la carte et du marqueur

        var map = L.map('map').setView([51.505, -0.09], 15);
        osm.addTo(map);
        let markeurs = [];
        var marker;
        const addHopitalButtonHandler = document.getElementById('add-hopital-map');
        const addBaseButtonHandler = document.getElementById('add-base-map');
        const removeHopitalButtonHandler = document.getElementById('remove-hopital-map');
        let baseCurrent = true;

        function routage(lat, lng, latF, lngF, marqueur, startIcon, endIcon, callback) {
            if (typeof callback !== 'function') {
                throw new Error('routage function requires a callback function as the last argument');
            }
            const r = L.Routing.control({
                waypoints: [
                    L.latLng(lat, lng),
                    L.latLng(latF, lngF),
                ],
                createMarker: function(i, waypoint) {
                    return L.marker(waypoint.latLng, {
                        icon: i === 0 ? startIcon : endIcon
                    });
                },
            }).on('routesfound', function(e) {
                const route = e.routes[0];
                const totalSteps = route.coordinates.length;

                let currentStep = 0; // 
                function animateRoute() {
                    if (currentStep < totalSteps) {
                        marqueur.setLatLng(route.coordinates[currentStep]);
                        currentStep++;

                        setTimeout(animateRoute, 300); // Adjust animation speed as needed
                    } else {
                        // Destination reached!
                        callback(true, r); // Call the callback function with true
                    }
                }
                animateRoute();
                // e.routes[0].coordinates.forEach((element, index) => {
                //     setTimeout(() => {
                //         marqueur.setLatLng([element.lat, element.lng])
                //         if (index == e.routes[0].coordinates.length - 1) {
                //             callback(true, r)
                //         }
                //     }, 300 * index)
                // });

            }).addTo(map)

        }
        $(document).ready(async function() {
            // audioElement.play(); 
            $("#acceptMission").on("submit", async (e) => {
                e.preventDefault()
                const baseId = $('#mission_base_id').val();
                const HopitaliId = $('#mission_hopital_id').val();
                // $('#mission_base_id').val();
                const hopitalData = await fetch("/api/hopital/" + HopitaliId);
                let hopital = await hopitalData.json()
                hopital = hopital.response;
                const baseData = await fetch("/api/base/" + HopitaliId);
                let base = await baseData.json()
                base = base.response;
                var startIcon = L.icon({
                    iconUrl: "{{ asset('/assets/images/base.svg') }}",
                    iconSize: [38, 95],
                    iconAnchor: [22, 94],
                    popupAnchor: [-3, -76]
                });
                var endIcon = L.icon({
                    iconUrl: hopital.icon_hopital,
                    iconSize: [38, 95],
                    iconAnchor: [22, 94],
                    popupAnchor: [-3, -76]
                });
                var uniteIcon = L.icon({
                    iconUrl: "{{ asset('/assets/images/ambulance-svgrepo-com.png') }}",
                    iconSize: [50, 50],
                    iconAnchor: [50, 50],
                    popupAnchor: [-3, -76]
                });
                var marker = L.marker([base.position_x, base.position_y], {
                    icon: uniteIcon
                }).addTo(map)
                let routeingAisCompleted = false;
                let routeingBisCompleted = false;
                let routeingCisCompleted = false;
                // const RoutingA = L.Routing.control({
                //     waypoints: [
                //         L.latLng(base.position_x, base.position_y),
                //         L.latLng(51.505, -0.09),
                //     ],
                //     createMarker: function(i, waypoint) {
                //         return L.marker(waypoint.latLng, {
                //             icon: i === 0 ? startIcon : endIcon
                //         });
                //     },
                // }).on('routesfound', function(e) {

                //     e.routes[0].coordinates.forEach((element, index) => {
                //         setTimeout(() => {
                //             marker.setLatLng([element.lat, element.lng])
                //             if (index == 48) {
                //                 routeingAisCompleted = true
                //             }
                //         }, 300 * index)


                //     });

                // }).addTo(map)
                const myCallback = function(isDestinationReached, routing) {
                    if (isDestinationReached) {
                        routing.remove()
                        setTimeout(() => {
                            routage(51.505, -0.09, hopital.position_x, hopital
                                .position_y, marker,
                                startIcon, endIcon, myCallback1)
                        }, 1000);
                    }
                };
                const myCallback1 = function(isDestinationReached, routing) {
                    if (isDestinationReached) {
                        routing.remove()
                        setTimeout(() => {
                            routage(hopital.position_x, hopital.position_y, base
                                .position_x, base.position_y, marker,
                                startIcon, endIcon, myCallback2)
                        }, 1000);
                    }
                };
                const myCallback2 = function(isDestinationReached, routing) {
                    if (isDestinationReached) {
                        routing.remove()
                    }
                };

                routage(base.position_x, base.position_y, 51.505, -0.09, marker,
                    startIcon, endIcon, myCallback)

                //     startIcon, endIcon))

                // if (routeingAisCompleted) {
                //     RoutingA.remove();

                //     const RoutingB = L.Routing.control({
                //         waypoints: [
                //             L.latLng(51.505, -0.09),
                //             L.latLng(hopital.position_x, hopital
                //                 .position_y),
                //         ],
                //         createMarker: function(i, waypoint) {
                //             return L.marker(waypoint.latLng, {
                //                 icon: i === 0 ? startIcon : endIcon
                //             });
                //         },
                //     }).on('routesfound', function(e) {
                //         e.routes[0].coordinates.forEach((element, index) => {
                //             setTimeout(() => {
                //                 marker.setLatLng([element.lat,
                //                     element.lng
                //                 ])
                //             }, 300 * index)
                //         });
                //         routeingBisCompleted = true;

                //     }).addTo(map)

                //     if (routeingBisCompleted) {
                //         RoutingB.remove()

                //         const RoutingC = L.Routing.control({
                //             waypoints: [
                //                 L.latLng(hopital.position_x, hopital
                //                     .position_y),
                //                 L.latLng(base.position_x, base.position_y),

                //             ],
                //             createMarker: function(i, waypoint) {
                //                 return L.marker(waypoint.latLng, {
                //                     icon: i === 0 ? startIcon : endIcon
                //                 });
                //             },
                //         }).on('routesfound', function(e) {
                //             e.routes[0].coordinates.forEach((element,
                //                 index) => {
                //                 setTimeout(() => {
                //                     marker.setLatLng([element
                //                         .lat,
                //                         element.lng
                //                     ])
                //                 }, 300 * index)
                //             });
                //             routeingCisCompleted = true;

                //         }).addTo(map)
                //         if (routeingCisCompleted) {
                //             RoutingC.remove()
                //         }
                //     }
                // }



            })

            function loadMission() {
                const wesPromiseMission = fetch("/api/missions");
                wesPromiseMission.then((response) => {
                    return response.json();
                }).then(function(data) {
                    let tabMission = [];
                    let = countDown = data.countDown;

                    $.each(data.response, function(index, element) {

                        // var myIcon = L.icon({
                        //     iconUrl: window.location.origin +
                        //         "/assets/images/quest.png",
                        //     iconSize: [30, 30], // taille de l'icône en pixels
                        //     iconAnchor: [22, 94], // point d'ancrage de l'icône
                        //     popupAnchor: [-3, -76] // point d'ancrage du popup
                        // });
                        // let markerData = L.marker([element.position_x, element
                        //     .position_y
                        // ], {
                        //     icon: myIcon
                        // });
                        // markerData.id = "mission" + element.id;

                        const cardMission = document.getElementById('card-mission');
                        cardMission.hidden = false;
                        const namePatient = document.getElementById('name-patient');
                        namePatient.innerHTML = `${data.patient}`;
                        const age = document.getElementById('age-patient');
                        age.innerHTML = 40;
                        const adresse = document.getElementById('adresse-incident');
                        adresse.innerHTML = "nice, veuille ville";
                        const phonePatient = document.getElementById('phone-patient');
                        phonePatient.innerHTML = "+30 857452556";
                        const missionDescription = document.getElementById(
                            'mission-description');
                        missionDescription.innerHTML = element.nom_mission;
                        const alertMission = document.getElementById('alert-mission');

                        alertMission.innerHTML += `
                       `

                    });

                    const audio = document.getElementById('audio');
                    audio.play()
                    if (mutedInput.checked) {
                        mutedInput.checked = false;
                    }
                })

            }

            function loadData() {
                const wesPromise = fetch("/api/hopitaux");
                wesPromise.then((response) => {
                    return response.json();
                }).then(function(data) {
                    $.each(data.response, function(index, element) {
                        var myIcon = L.icon({
                            iconUrl: window.location.origin + "/" + element
                                .icon_hopital,
                            iconSize: [38, 95], // taille de l'icône en pixels
                            iconAnchor: [22, 94], // point d'ancrage de l'icône
                            popupAnchor: [-3, -76] // point d'ancrage du popup
                        });
                        let markerData = L.marker([element.position_x, element.position_y], {
                            icon: myIcon
                        }).addTo(map);
                    });
                })
                const wesPromise2 = fetch("/api/base");
                wesPromise2.then((response) => {
                    return response.json();
                }).then(function(data) {

                    $.each(data.response, function(index, element) {
                        var myIcon = L.icon({
                            iconUrl: window.location.origin + "/" + element
                                .icon_hopital,
                            iconSize: [38, 95], // taille de l'icône en pixels
                            iconAnchor: [22, 94], // point d'ancrage de l'icône
                            popupAnchor: [-3, -76] // point d'ancrage du popup
                        });
                        let markerData = L.marker([element.position_x, element.position_y], {
                            icon: myIcon
                        }).addTo(map);
                    });
                })


            }
            loadData();
            loadMission();
            // $('.add-mission-to-map').on('click', (e) => {
            //     alert(1)
            // })
            $('#alert-mission').on('submit', (e) => {
                e.preventDefault();
                var token = "{{ csrf_token() }}";
                $.ajax({
                    url: `/api/add-mission`, // Replace with the target API URL
                    type: 'POST',
                    data: {
                        "mission_id": $('#mission_id').val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': token
                    },

                    dataType: 'json',

                    success: function(response) {
                        if (response.message) {
                            $("#card-mission").fadeOut("slow", function() {
                                const audio = document.getElementById('audio')
                                if (mutedInput.checked) {
                                    audio.play()
                                } else {
                                    audio.pause();
                                    audio.currentTime = 0;
                                }
                                setTimeout(() => {
                                    $("#card-mission").remove()
                                }, 1000);
                                setTimeout(() => {
                                    if (mutedInput.checked) {
                                        audio.play()
                                    } else {
                                        audio.pause();
                                        audio.currentTime = 0;
                                    }
                                    loadMission();
                                }, getRandomIntInclusive(5000, 10000))
                            });
                        }
                        // Process the response data
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error posting data:', textStatus, errorThrown);
                        // Handle errors
                    }
                });
            })

            $('.getMissionMap').on('click', (e) => {
            })
            addHopitalButtonHandler.addEventListener('click', () => {
                marker = L.marker([51.5, -0.09]).addTo(map);
                const posX = document.getElementById('position_x');
                const posY = document.getElementById('position_y');
                posX.value = -0.09;
                posY.value = 51.5;
                marker.on('dragend', function(event) {
                    var newLatLng = event.target.getLatLng();
                    posY.value = newLatLng.lng;
                    posX.value = newLatLng.lat;
                });
                // markeurs.push(markeurs)
                marker.dragging.enable();

            })

            addBaseButtonHandler.addEventListener('click', () => {
                if (baseCurrent) {
                    marker = L.marker([51.5, -0.09]).addTo(map);
                    const posX = document.getElementById('position_x_base');
                    const posY = document.getElementById('position_y_base');
                    posX.value = -0.09;
                    posY.value = 51.5;
                    marker.on('dragend', function(event) {
                        var newLatLng = event.target.getLatLng();
                        posY.value = newLatLng.lng;
                        posX.value = newLatLng.lat;
                    });
                    // markeurs.push(markeurs)
                    marker.dragging.enable();
                    baseCurrent = false
                } else {
                    removeHopitalButtonHandler.click()
                    baseCurrent = true
                }


            })

            removeHopitalButtonHandler.addEventListener('click', () => {
                if (marker) {
                    marker.remove();
                }
            })
        })


        // Active le déplacement du marqueur
    </script>
@endsection
