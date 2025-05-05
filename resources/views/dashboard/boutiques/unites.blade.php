@extends('dashboard.master', ['activePage' => 'boutique'])
@section('title', __('Boutique'))
@section('content')
    <div class="relative">
        @if (session('status') && session('color'))
            <div class="flex expend-modal absolute top-0 -translate-x-1/2 left-1/2 items-center p-4 mb-4 text-sm text-{{ session('color') }}-800 rounded-lg bg-{{ session('color') }}-50 dark:bg-gray-800 dark:text-{{ session('color') }}-300"
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
                    <button type="button" data-modal-hide="default-modal"
                        class="absolute flex items-center close-modal-button justify-center p-1 bg-{{ session('color') }}-50 rounded-full hover:bg-{{ session('color') }}-100 backdrop-filter size-8 top-0 -right-12">
                        <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-4" alt=""
                            srcset="">
                        <span class="hidden">Close</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="p-4">
            <h3 class="mt-4 text-xl">Les unités</h3>
        </div>
        <div class="grid w-full p-4 grid-cols-5 md:grid-cols-4 gap-5 text-center ">
            @foreach ($unites as $unite)
                <div
                    class="w-full flex flex-col justify-between relative max-w-sm bg-blue-200 bg-gradient-to-tr from-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div style="height: 200px" class="overflow-hidden">
                        <a href="#">
                            <img class=" rounded-t-lg" width="" src="{{ asset($unite->image) }}"
                                alt="product image" />
                        </a>
                    </div>
                    <div class="px-5 pb-5">
                        <a href="#">
                            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ $unite->nom_unite }}</h5>
                        </a>
                        {{--  --}}
                        <div class="">
                            <div class="flex justify-center my-2 items-center gap-1">
                                <span style=" font-family: cursive;"
                                    class="text-xl font-bold text-gray-900 dark:text-white">{{ $unite->prix_unite }}</span>
                                <img width="24" height="24" src="{{ url('assets/images/icons8-money-48.png') }}"
                                    alt="" srcset="">
                            </div>
                            <button name="expend-modal-unite-pay-{{ $unite->id }}"
                                class="bg-blue-500 w-fit m-auto hover:bg-blue-600 p-2 show-modal-unite-pay text-sm px-4 rounded-sm text-white">Acheter</button>
                            {{-- <button name="expend-modal-unite-pay-{{ $unite->id }}" type="button"
                                class="text-white bg-blue-700 btn  w-fit hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Acheter</button> --}}
                        </div>
                    </div>
                    <button name="info-unite-{{ $unite->id }}" class="absolute show-event -top-3 -right-3">
                        <img src="{{ asset('assets/images/icons8-info-48.png') }}" width="35" height="35"
                            alt="" srcset="">
                        <span class="hidden">info</span>
                    </button>
                    <form method="POST" action="{{ route('add.unite-user') }}"
                        id="expend-modal-unite-pay-{{ $unite->id }}" aria-hidden="true" hidden
                        class="fixed top-0 left-0 expend-modal z-50 items-center py-8 justify-center flex   w-full h-full  bg-black/30 ">
                        @csrf
                        <div class="relative">
                            <input type="number" hidden name="unite_id" value="{{ $unite->id }}">
                            <input type="number" hidden name="vitesse" value="{{ $unite->vitesse_unite }}">
                            <input type="text" hidden name="nom" value="{{ $unite->nom_unite }}">
                            <input type="number" hidden name="places_disponible" value="{{ $unite->capacite_unite }}">
                            <input type="number" hidden name="taux_usure" value="{{ $unite->taux_usure }}">
                            <input type="number" hidden name="prix" value="{{ $unite->prix_unite }}">
                            <div class="py-2 bg-white  rounded-lg min-w-96" style="max-width: 500px;">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $unite->nom_unite }}</h5>
                                <div class="flex my-3 items-center justify-center gap-1">
                                    <span style=" font-family: cursive;"
                                        class="text-5xl font-bold text-gray-900 dark:text-white">{{ $unite->prix_unite }}</span>
                                    <img width="32" height="32" src="{{ url('assets/images/icons8-money-48.png') }}"
                                        alt="" srcset="">
                                </div>
                                <div class="flex mt-1 justify-center">
                                    <button type="submit"
                                        class="bg-blue-500 w-fit m-auto hover:bg-blue-600 p-2 text-sm px-4 rounded-sm text-white">Valider
                                        l'achat</button>
                                </div>
                                <button type="button" data-modal-hide="default-modal"
                                    class="absolute flex items-center close-modal-button justify-center p-1 bg-white rounded-full shadow-md backdrop-filter size-8 -top-0 -right-12">
                                    <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-4"
                                        alt="" srcset="">
                                    <span class="hidden">Close</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div hidden id="info-unite-{{ $unite->id }}"
                        class="fixed top-0 left-0 expend-modal z-50 items-center py-8 justify-center flex   w-full h-full  bg-stone-800 ">
                        <div style=" font-family: cursive;"
                            class="max-w-96 relative bg-stone-950 w-full text-white p-4 min-h-40 border-4 border-orange-500 rounded-3xl ">
                            <img class=" rounded-t-lg" width="" src="{{ asset($unite->image) }}"
                                alt="product image" />
                            <h4 class="text-2xl">"{{ $unite->nom_unite }}"</h4>
                            <ul>
                                <li class="flex my-1 justify-between"> <span>Vitesse:</span>
                                    <div><span class="text-orange-500">{{ $unite->vitesse_unite }}</span><span
                                            class="tracking-tight">KM/H</span></div>
                                </li>
                                <li class="flex my-1 justify-between"> <span>Nombre de place:</span> <span
                                        class="text-orange-500">{{ $unite->capacite_unite }}</span></li>
                                <li class="flex my-1 justify-between"> <span>Taux d'usure:</span>
                                    @if ($unite->taux_usure < 50)
                                        <span class="font-medium text-green-500">{{ $unite->taux_usure }}%</span>
                                    @else
                                        <span class="font-medium text-red-500">{{ $unite->taux_usure }}%</span>
                                    @endif
                                </li>
                            </ul>
                            <hr class="my-2 border-dashed border-2  border-white">
                            <h3>Type</h3>
                            <div class="flex gap-2 items-center my-1">
                                <img class="rounded-md border p-1 size-8 bg-black/30" src="{{ asset($unite->icon) }}"
                                    class="w-full" width="24" alt="" />
                                <span class="text-white text-xs">{{ $unite->nom_type_unite }}</span>
                            </div>

                            <p class="text-left text-sm p-1">
                                {{ $unite->description_type_unite }}
                            </p>
                            <button type="button" data-modal-hide="default-modal"
                                class="absolute flex items-center close-modal-button justify-center p-1 bg-white rounded-full shadow-md backdrop-filter size-8 -top-0 -right-12">
                                <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-4"
                                    alt="" srcset="">
                                <span class="hidden">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        const buttonModalUnitePay = document.querySelectorAll('.show-modal-unite-pay');
        buttonModalUnitePay.forEach(element => {
            element.addEventListener('click', () => {
                let name = element.name;
                let expendEvent = document.getElementById(name);
                expendEvent.hidden = false;
                // alert(expendEvent.innerHTML)
            })
        });
    </script>
@endsection
