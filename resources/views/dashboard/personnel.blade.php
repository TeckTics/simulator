@extends('dashboard.master', ['activePage' => 'element'])
@section('title', __('Unité "' . $personnel->titre_personnel . '" '))
@section('content')
    <div class="" class="relative overflow-hidden">

        <div class="relative z-10 text-white relative p-2">
            @if (session('status') && session('color'))
                <div class="flex expend-modal z-30 shadow-xl absolute top-0 -translate-x-1/2 left-1/2 items-center p-4 mb-4 text-sm text-white rounded-lg bg-{{ session('color') }}-500"
                    role="alert">
                    <div class="relative">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ session('status') }}
                        </div>
                        <button type="button"
                            class="absolute flex items-center close-modal-button justify-center p-1 bg-{{ session('color') }}-50 rounded-full hover:bg-{{ session('color') }}-100 backdrop-filter size-8 top-0 -right-12">
                            <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-4" alt=""
                                srcset="">
                            <span class="hidden">Close</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="text-sm"><a class="text-sm text-[#151b28]" href="{{ url('/dashboard/elements') }}">Mes équipements et éléments</a>
                >
                <a class="text-sm text-[#151b28]" href="#">"{{ $personnel->titre_personnel }}"</a>
            </div>
            <h3 class="mt-4 text-xl text-[#151b28] font-bold text-center">"{{ $personnel->titre_personnel }}"</h3>
            <div class="mt-2 flex justify-start gap-4">
                <div
                    class="w-full col-span-2 h-fit text-sm relative max-w-96 bg-white rounded-2xl shadow ">
                    <img class="px-8 py-2 rounded-t-lg" src="{{ asset($personnel->image) }}" alt="product image" />
                    <div class="px-4 py-2">
                        <h5 style="font-family: cursive;"
                            class="text-sm  text-center uppercase font-bold text-stone-800 tracking-tight ">
                            {{ $personnel->titre_personnel }}</h5>
                        <div class="flex w-full flex-col border-t ">
                            <div class="flex gap-2 justify-between border-b py-2 items-center">
                                <span class="text-primary font-bold text-sm">Nom:</span>
                                <div class="flex items-center gap-1">
                                    <span
                                        class="text-secondary font-medium text-sm">{{ $personnel->titre_personnel }}</span>
                                    <button class="show-event" name="popup-edit-name"
                                        title="Personnaliser le nom de votre unité">
                                        {{-- <svg width="24px" height="24px" viewBox="0 -0.5 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M17.7 5.12758L19.266 6.37458C19.4172 6.51691 19.5025 6.71571 19.5013 6.92339C19.5002 7.13106 19.4128 7.32892 19.26 7.46958L18.07 8.89358L14.021 13.7226C13.9501 13.8037 13.8558 13.8607 13.751 13.8856L11.651 14.3616C11.3755 14.3754 11.1356 14.1751 11.1 13.9016V11.7436C11.1071 11.6395 11.149 11.5409 11.219 11.4636L15.193 6.97058L16.557 5.34158C16.8268 4.98786 17.3204 4.89545 17.7 5.12758Z"
                                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M12.033 7.61865C12.4472 7.61865 12.783 7.28287 12.783 6.86865C12.783 6.45444 12.4472 6.11865 12.033 6.11865V7.61865ZM9.23301 6.86865V6.11865L9.23121 6.11865L9.23301 6.86865ZM5.50001 10.6187H6.25001L6.25001 10.617L5.50001 10.6187ZM5.50001 16.2437L6.25001 16.2453V16.2437H5.50001ZM9.23301 19.9937L9.23121 20.7437H9.23301V19.9937ZM14.833 19.9937V20.7437L14.8348 20.7437L14.833 19.9937ZM18.566 16.2437H17.816L17.816 16.2453L18.566 16.2437ZM19.316 12.4937C19.316 12.0794 18.9802 11.7437 18.566 11.7437C18.1518 11.7437 17.816 12.0794 17.816 12.4937H19.316ZM15.8863 6.68446C15.7282 6.30159 15.2897 6.11934 14.9068 6.2774C14.5239 6.43546 14.3417 6.87397 14.4998 7.25684L15.8863 6.68446ZM18.2319 9.62197C18.6363 9.53257 18.8917 9.13222 18.8023 8.72777C18.7129 8.32332 18.3126 8.06792 17.9081 8.15733L18.2319 9.62197ZM8.30001 16.4317C7.8858 16.4317 7.55001 16.7674 7.55001 17.1817C7.55001 17.5959 7.8858 17.9317 8.30001 17.9317V16.4317ZM15.767 17.9317C16.1812 17.9317 16.517 17.5959 16.517 17.1817C16.517 16.7674 16.1812 16.4317 15.767 16.4317V17.9317ZM12.033 6.11865H9.23301V7.61865H12.033V6.11865ZM9.23121 6.11865C6.75081 6.12461 4.7447 8.13986 4.75001 10.6203L6.25001 10.617C6.24647 8.96492 7.58269 7.62262 9.23481 7.61865L9.23121 6.11865ZM4.75001 10.6187V16.2437H6.25001V10.6187H4.75001ZM4.75001 16.242C4.7447 18.7224 6.75081 20.7377 9.23121 20.7437L9.23481 19.2437C7.58269 19.2397 6.24647 17.8974 6.25001 16.2453L4.75001 16.242ZM9.23301 20.7437H14.833V19.2437H9.23301V20.7437ZM14.8348 20.7437C17.3152 20.7377 19.3213 18.7224 19.316 16.242L17.816 16.2453C17.8195 17.8974 16.4833 19.2397 14.8312 19.2437L14.8348 20.7437ZM19.316 16.2437V12.4937H17.816V16.2437H19.316ZM14.4998 7.25684C14.6947 7.72897 15.0923 8.39815 15.6866 8.91521C16.2944 9.44412 17.1679 9.85718 18.2319 9.62197L17.9081 8.15733C17.4431 8.26012 17.0391 8.10369 16.6712 7.7836C16.2897 7.45165 16.0134 6.99233 15.8863 6.68446L14.4998 7.25684ZM8.30001 17.9317H15.767V16.4317H8.30001V17.9317Z"
                                                    fill="#000000"></path>
                                            </g>
                                        </svg> --}}
                                    </button>
                                </div>
                            </div>
                            <div class="border-b py-2">
                                <span class="text-primary font-bold text-sm">Description:</span>
                                <p class="text-secondary p-1 text-sm">{{ $personnel->description_personnel }}</p>
                            </div>
                            <div class="flex gap-2 justify-between border-b py-2 items-center">
                                <span class="text-primary font-bold text-sm">Nombre:</span>
                                <span
                                    class="text-secondary font-medium text-sm">{{ $personnel->quantite_personnel }}</span>
                            </div>
                            <div class="flex gap-2 justify-between border-b py-2 items-center">
                                <span class="text-primary font-bold text-sm">Niveau:</span>
                                <span class="text-secondary font-medium text-sm">{{ $personnel->niveau }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="w-full   text-sm relative bg-white rounded-2xl shadow ">
                    <h3 class="text-stone-950 px-4 py-2 text-xl font-bold">Formations</h3>
                    <div class="px-4 py-2 flex flex-wrap gap-4 flex-row">
                        @foreach ($formations as $key => $formation)
                            <div
                                class="w-fit pb-4 text-center border-4 border-[#151b28] overflow-hidden bg-purple-800 from-violet-500 bg-gradient-to-tr text-sm relative rounded-2xl shadow-xl ">
                                <form action="{{ route('add.personnel-formation') }}" method="POST">
                                    @csrf
                                    <img width="200" height="200" class="rounded-xl shadow"
                                        src="{{ asset($formation->image_formation) }}" alt="product image" />
                                    <h4 class="text-center my-2 font-bold  uppercase">{{ $formation->libelle_formation }}
                                    </h4>
                                    <input type="text" hidden value="{{ $personnel->id }}" name="personnel_user_id"
                                        id="personnel_user_id">
                                    <input type="text" hidden value="{{ $formation->formations_id }}"
                                        name="formation_id" id="formation_id">
                                    @isset($formations[$key + 1])
                                        <input type="text" value="{{ $formations[$key + 1]->formations_id }}" hidden
                                            name="next_formation" id="next_formation">
                                    @endisset
                                    <input type="text" hidden value="{{ $formation->recompense_formation }}"
                                        name="recompense_formation" id="recompense_formation">
                                    <input type="time" hidden value="{{ $formation->temps_formation }}"
                                        name="temps_formation" id="temps_formation">
                                    <input type="number" hidden value="{{ $formation->prix_formation }}"
                                        name="prix_formation" id="prix_formation">
                                    @if (!$formation->personnel_formations_id)
                                        <button type="submit"
                                            class="bg-blue-500 w-fit flex gap-2 items-center mx-auto font-medium hover:bg-blue-600 p-2 text-sm px-4 rounded-sm text-white">Acheter
                                            <div class="flex items-center justify-center gap-1">
                                                <span style=" font-family: cursive;"
                                                    class=" font-bold text-white">{{ $formation->prix_formation }}</span>
                                                <img width="32" height="32"
                                                    src="{{ url('assets/images/icons8-money-48.png') }}" alt=""
                                                    srcset="">
                                            </div>
                                        </button>
                                    @else
                                        @if (date_create($dateNow) < date_create($formation->date_fin_formation))
                                            <div id="timer" class="w-32 mx-auto font-bold text-center p-1">
                                                <span id="countdown" class=""></span>
                                            </div>
                                            <script>
                                                window.eventData = {
                                                    startDate: "{{ $dateNow }}",
                                                    endDate: "{{ date_format(date_create($formation->date_fin_formation), 'Y-m-d H:i:s') }}"
                                                };
                                                $(document).ready(function() {
                                                    var timer = Math.abs(Date.parse("{{ $dateNow }}") - Date.parse(
                                                        "{{ date_format(date_create($formation->date_fin_formation), 'Y-m-d H:i:s') }}"));

                                                    if (timer > 0) {
                                                        var timeinterval = setInterval(() => {

                                                            var minutesSpan = document.getElementById('countdown');

                                                            timer = timer - 1000;
                                                            var minutes = Math.floor((timer / 1000 / 60) % 60);
                                                            var seconds = Math.floor((timer / 1000) % 60);
                                                            if (minutesSpan) {
                                                                minutesSpan.innerHTML =
                                                                    `La formation se termine dans ${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
                                                            }
                                                            if (t.total <= 0) {
                                                                minutesSpan.innerHTML = `
                                                                     <button type="button" disabled
                                                                    class="bg-stone-500 w-fit flex gap-2 items-center mx-auto font-medium  p-2 text-sm px-4 rounded-sm text-white">
                                                                    Terminer
                                                                </button>
                                                                `
                                                                clearInterval(timeinterval);
                                                            }

                                                        }, 1000);

                                                    }
                                                    // function getTimeRemaining(time) {

                                                    //     var seconds = Math.floor((time / 1000) %  60);
                                                    //     var minutes = Math.floor((time / 1000 / 60) % 60);
                                                    //     var hours = Math.floor((time / 1000 / 60 / 60) % 24);
                                                    //     var days = Math.floor(time / (1000 * 60 * 60 * 24));
                                                    //     return {
                                                    //         'total': time,
                                                    //         'days': days,
                                                    //         'hours': hours,
                                                    //         'minutes': minutes,
                                                    //         'seconds': seconds

                                                    //     };
                                                    // }

                                                    // function initializeClock(id, endtime) {
                                                    //     var clock = document.getElementById(id);
                                                    //     var daysSpan = document.querySelector('.days');
                                                    //     var hoursSpan = document.querySelector('.hours');
                                                    //     var minutesSpan = document.querySelector('.minutes');
                                                    //     var secondsSpan = document.querySelector('.seconds');

                                                    //     function updateClock() {


                                                    //         setInterval(() => {
                                                    //             var t = getTimeRemaining(timer - 1000);
                                                    //             if (daysSpan && hoursSpan && minutesSpan && secondsSpan) {
                                                    //                 daysSpan.innerHTML = t.days;
                                                    //                 hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                                                    //                 minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                                                    //                 secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
                                                    //             }
                                                    //             if (t.total <= 0) {
                                                    //                 clearInterval(timeinterval);
                                                    //             }
                                                    //         }, 1000);

                                                    //     }

                                                    // updateClock();
                                                    // var timeinterval = setInterval(updateClock, 1000);



                                                    // initializeClock('countdown', window.eventData.endDate);

                                                });
                                            </script>
                                        @else
                                            <button type="button" disabled
                                                class="bg-stone-500 w-fit flex gap-2 items-center mx-auto font-medium  p-2 text-sm px-4 rounded-sm text-white">
                                                Terminer
                                            </button>
                                        @endif
                                    @endif
                                </form>
                                @if ($key != 0)
                                    @isset($formations[$key - 1])
                                        @if (!$formations[$key - 1]->personnel_formations_id ||  date_create($dateNow) < date_create($formations[$key - 1]->date_fin_formation))
                                            <div
                                                class="w-full absolute flex justify-center items-center h-full bg-black/60 top-0 left-0 ">
                                                <img width="64" height="64"
                                                    src="{{ url('assets/images/locked-svgrepo-com.png') }}" alt=""
                                                    srcset="">
                                            </div>
                                        @endif
                                    @endisset
                                @endif


                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
            {{-- 
            <div id="popup-edit-name" hidden
                class=" overflow-y-auto expend-modal overflow-x-hidden absolute top-0 right-0 flex justify-center left-0 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md m-auto max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute close-modal-button top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <form method="POST" action="{{ route('update.unite-user') }}" class="p-4 md:p-5 text-center">
                            @csrf
                            <h2>Personnaliser le nom de votre unité</h2>
                            <div class="col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                </label>
                                <input type="number" name="id" id="id" value="{{$unite->id}}" hidden required="">
                                <input type="text" name="nom" id="nom"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                    placeholder="Nom " required="">
                            </div>
                            <div class="flex gap-2 mt-4 justify-center">
                                <button type="submit"
                                    class="py-2 px-3 close-modal-button bg-violet-500 text-sm font-medium text-gray-50 focus:outline-none rounded-lg border border-gray-200 hover:bg-violet-500 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Valider</button>
                                <button type="button"
                                    class="py-2 px-3 close-modal-button text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-violet-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                                    Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

@endsection
