@extends('admin.master', ['activePage' => '/'])
@section('title', __('Tableau de board'))
@section('content')

    <div class="grid grid-cols-3 gap-4 p-4">
        <div class="wrapper bg-gray-900 ">
            <div class="layout-fixed bg-gray-950 p-4 main-sidebar ">
                <h4 class="text-white">Paramètres du chat </h4>
            </div>
            <div class="p-4 flex gap-4 flex-col ">
                <div class="flex items-center justify-between">
                    <label for="chat-speed">Vitesse du chat</label>
                    <input type="range">
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium ">Desactiver les notifications liés au chat</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="mutedInput" class="sr-only peer">
                        <div
                            class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium "> Mode sombre</span>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="mutedInput" class="sr-only peer">
                        <div
                            class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div>
            <div class="wrapper ">
                <div class="layout-fixed bg-green-900 p-4 main-sidebar ">
                    <h4 class="text-white">Joueur en ligne</h4>
                </div>
                <div class="body-message bg-white" style="  margin: auto;">
                    <div class="chat-messages space-y-3 " id="MessageSent">
                    </div>
                </div>
            </div>
            <div class="wrapper ">
                <div class="layout-fixed bg-gray-900 p-4 main-sidebar ">
                    <h4 class="text-white">Joueur hors ligne</h4>
                </div>
                <div class="body-message bg-white" style="  margin: auto;">
                    <div class="chat-messages flex flex-col space-y-3 " id="MessageSent">
                    </div>
                </div>
                {{-- <div class="footer-messager  mt-4 bg-gray-900 p-4">
                    <form class="flex items-start flex-col" id="chat-form" method="post">
                        @csrf
                        <textarea type="text" name="content" required id="message-input" class="form-control" placeholder="Votre message"></textarea>
                        <button type="submit" class="btn btn-primary text-xs mt-1" id="chat-message-submit">
                            <span>Envoyer</span>
                        </button>
                    </form>
                </div> --}}
            </div>
        </div>
        <div class="wrapper border ">
            <div class="layout-fixed bg-gray-900 p-4 main-sidebar ">
                <img src="{{ asset('assets/images/message-icon.svg') }}">
                <h4 class="text-white flex items-center mb-2">Chat </h4>
            </div>
            <div id="messagesContainer" class="body-message  p-4 overflow-y-auto max-h-fit bg-white h-96">
                <div class="chat-messages space-y-3 " id="MessageSentContent">
                </div>
            </div>
            <div class="footer-messager  mt-4 bg-gray-900 p-4">
                <form class="flex flex-col" id="chat-form" method="post">
                    @csrf
                    <textarea type="text" name="content" required id="message-input" class="form-control" placeholder="Votre message"></textarea>
                    <button type="submit" class="btn btn-primary text-xs mt-1" id="chat-message-submit">
                        <span>Envoyer</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
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

            function refreshData() {

                const wesPromiseMission = fetch("/api/load-message");
                wesPromiseMission.then((response) => {
                    return response.json();
                }).then(function(data) {
                    $.each(data, (index, val) => {
                        $('#MessageSentContent').append('<div>' + val.text + '</div>');
                    })
                })

                window.Echo.channel('chat.1').listen('MessageSent', (e) => {
                    $('#MessageSentContent').append('<div>' + e.message.text + '</div>');
                })
                const messagesContainer = document.getElementById("messagesContainer");
                messagesContainer.scrollTop = messagesContainer
                .scrollHeight;

            }

            // // Appeler la fonction de rafraîchissement initialement
            refreshData();

            // // Appeler la fonction de rafraîchissement régulièrement (exemple toutes les 5 secondes)
            // setInterval(refreshData, 5000);
            $('#chat-form').on('submit', (e) => {
                e.preventDefault();
                // var txt = $("#message-input").val();
                // $.post("/admin/api/send-message", {text: txt},  function(data, status) {
                //     alert("Data: " + data + "\nStatus: " + status);
                // });
                var token = "{{ csrf_token() }}";
                $.ajax({
                    url: `/api/send-message`, // Replace with the target API URL
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: {
                        "text": $('#message-input').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        // Process the response data
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error posting data:', textStatus, errorThrown);
                        // Handle errors
                    }
                });
            })
        })
    </script>
@endsection
