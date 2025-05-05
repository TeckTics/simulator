<!DOCTYPE html>
<html lang="fr">

<head>
    {{-- @php
        $favicon = \App\Models\Setting::find(1)->favicon;
    @endphp --}}
    <meta charset="utf-8">
    {{-- <link href="{{ $favicon ? url('images/upload/' . $favicon) : asset('/images/logo.png') }}" rel="icon"
        type="image/png"> --}}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') | UrgenceSAMU</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
</head>
<style>
    /* *{
     font-family: cursive;
    } */
</style>

<body class="relative ">
    <div class="absolute w-full h-full top-0 left-0 bg-cover opacity-20 bg-no-repeat grayscale z-0"
        style="background-image: url({{ asset('assets/icons/background-home.png') }})"></div>
    <div class="grid p-8 relative z-10 bg-[#1a2539] grid-cols-3">
        <form id="alert-mission" method="POST" style="min-height: 150px; margin-bottom: 10px">
            @csrf
            <div id="card-mission" style="display: flex;"
                class="alert rounded-xl bg-stone-500 from-stone-700 bg-gradient-to-tr w-fit flex-col gap-4 flex items-center justify-between p-2 text-sm">
                <div class="flex rounded-xl shadow-inner p-4 items-center gap-8 flex-row">
                    <img width="45" height="45" alt="regulateur"
                        src="{{ asset('/assets/images/regulateur.svg') }}" />
                    <div class="text-white ">
                        <span class="font-bold ">Régulation SAMU:</span> <br>
                        <p>Bonjour, je suis Olivier de la régulation SAMU, nous avons une mission sur votre secteur:</p>
                        <span class="font-bold ">Message: </span>
                        <p id="mission-description"></p>
                    </div>
                </div>
                <div class="flex gap-1 justify-start">
                    <input hidden id="mission_id" name="mission_id" />
                    <input hidden id="mission_position_x" />
                    <input hidden id="mission_position_y" name="mission_id" />
                    <button title="Envoyer une unité sur la mission" type="button" id="accept-btn"
                        name="show-modal-send-unite"
                        style="font-family: cursive; text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                        class="p-2 show-modal text-white transition-all border-white border-2 flex flex-row gap-2  text-sm justify-center from-blue-700 bg-gradient-to-t rounded-lg w-fit hover:bg-blue-600 bg-blue-500 font-semibold ">
                        <img width="25" height="25" src="{{ asset('/assets/images/phone.svg') }}"
                            alt="Phone" />
                        <span class="hidden">Envoyer unité</span>
                    </button>
                    <button title="Mettre la mission dans la file d'attente" type="button" name="waiter"
                        id="waiter-btn" style="font-family: cursive; text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                        class="p-2 show-modal text-white transition-all add-mission-to-map  border-white border-2 flex flex-row gap-2 justify-center  text-sm  from-green-700 bg-gradient-to-t rounded-lg w-fit hover:bg-green-600 bg-green-500 font-semibold ">
                        <img width="25" height="25" src="{{ asset('/assets/images/arrow-down.svg') }}"
                            alt="Phone" />
                        <span class="hidden">Mettre la mission dans la file d'attente</span>
                    </button>
                    <button title="Refuser la mission" type="button" name="reject" id="reject-btn"
                        style="font-family: cursive; text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                        class="p-2 reject-mission text-white transition-all border-white border-2 flex flex-row gap-2 justify-center text-sm from-red-700 bg-gradient-to-t rounded-lg w-fit hover:bg-red-600 bg-red-500 font-semibold ">
                        <img width="25" height="25" src="{{ asset('/assets/images/hang-up.svg') }}"
                            alt="Phone" />
                        <span class="hidden">Refuser la mission</span>
                    </button>
                </div>
            </div>
        </form>
        <div class="cols-span-2 px-4">
            Participants
            <div id="users" class="flex gap-4 ">

            </div>
        </div>
    </div>
    <div id="map"
        class="w-full shadow-2xl border-white shadow-black relative z-40  overflow-hidden border-4 rounded-xl"
        style="height: 500px"></div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script>
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        var map = L.map('map').setView([51.505, -0.09], 15);
        osm.addTo(map);
    </script> --}}
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        var module = {};
    </script>
    <script type="module">
        import Echo from '{{ asset('js/demo/echo.js') }}'

        import {
            Pusher
        } from '{{ asset('js/demo/pusher.js') }}'
        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: "pusher",
            key: "gmtlglaksbchlik19thp",
            wsHost: window.location.hostname,
            wsPort: 9000,
            forceTLS: false,
            disableStats: true,
            enabledTransports: ["ws"],
        });


        $(document).ready(function() {
            const peer = new SimplePeer({
                initiator: true,
                trickle: false
            });

            peer.on('signal', (data) => {
                socket.emit('signal', data);
            });

            peer.on('stream', (stream) => {
                // Afficher le flux audio
                const audio = document.createElement('audio');
                audio.srcObject = stream;
                audio.autoplay = true;
                document.body.appendChild(audio);
            });

            function refreshData() {
                const wesPromiseMission = fetch("/api/load-presence-user");
                wesPromiseMission.then((response) => {
                    return response.json();
                }).then(function(data) {
                    $.each(data, (index, val) => {
                        $('#users').append(
                            '<div id="user-' + val.id +
                            '" class="p-4  border-2 bg-white size-20 rounded-2xl flex justify-center items-center"> ' +
                            val.pseudo + ' </div>');
                    })
                })
                window.Echo.channel('user-status.1').listen('PresenceUser', (e) => {
                    // true => 1
                    // false => 0
                    if (e.user.online) {
                        $('#users').append(
                            '<div id="user-' + e.user.id +
                            '" class="p-4 border-2 bg-white size-20 rounded-2xl flex justify-center items-center">' +
                            e.user.pseudo + '</div>');
                    } else {
                        if (document.getElementById('user-' + e.user.id)) {
                            document.getElementById('user-' + e.user.id).remove()
                            $('#user-' + e.user.id).remove();
                        }
                    }
                })


            }

            // // Appeler la fonction de rafraîchissement initialement
            refreshData();


        })
    </script>
</body>

</html>
