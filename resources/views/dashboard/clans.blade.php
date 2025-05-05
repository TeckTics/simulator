@extends('dashboard.master', ['activePage' => 'clans'])
@section('title', __('Alliances SAMU'))
@section('content')
    <div class="relative p-2">

        @if (session('status') && session('color'))
            <div class="flex expend-modal absolute top-0 -translate-x-1/2 left-1/2 items-center p-4 mb-4 text-sm text-{{ session('color') }}-800 rounded-lg bg-{{ session('color') }}-50 dark:bg-gray-800 dark:text-{{ session('color') }}-300"
                role="alert">
                <div class="relative flex items-center gap-4">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
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
        <div class="bg-[#151b28] overflow-hidden border-2 border-[#151b28] shadow-xl rounded-xl">
            @if ($clan)
                <div class="">
                    <div class="gap-4 justify-between pr-4 border-b-2 border-white items-center flex flex-row">
                        <div class="gap-4 items-center flex flex-row">
                            <div class=" p-2 h-full py-3 bg-white">
                                <img src="{{ asset($clan->banner) }}" width="30" height="30" alt="">
                            </div>
                            <div class=" ">
                                {{ $clan->nom_clan }}
                                <div class="flex items-center gap-1">
                                    @switch($clan->niveau)
                                        @case(1)
                                            <img title="niveau {{ $clan->niveau }}"
                                                src="{{ asset('assets/images/image1_0 (15).png') }}" width="30" height="30"
                                                alt="">
                                        @break

                                        @case(2)
                                            <img title="niveau {{ $clan->niveau }}"
                                                src="{{ asset('assets/images/image1_0 (15).png') }}" width="30" height="30"
                                                alt="">
                                        @break

                                        @case(3)
                                            <img title="niveau {{ $clan->niveau }}"
                                                src="{{ asset('assets/images/image0_0 (15).png') }}" width="30" height="30"
                                                alt="">
                                        @break

                                        @case(4)
                                            <img title="niveau {{ $clan->niveau }}"
                                                src="{{ asset('assets/images/image0_0 (15).png') }}" width="30" height="30"
                                                alt="">
                                        @break

                                        @case(5)
                                            <img title="niveau {{ $clan->niveau }}"
                                                src="{{ asset('assets/images/image0_0 (14).png') }}" width="30" height="30"
                                                alt="">
                                        @break

                                        @default
                                            <img title="niveau {{ $clan->niveau }}"
                                                src="{{ asset('assets/images/image1_0 (15).png') }}" width="30" height="30"
                                                alt="">
                                    @endswitch
                                    <span class="text-xs">Alliance de niveau {{ $clan->niveau }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ url('/dashboard/alliance/' . $clan->id) }}">
                                    <button style=" text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                                        class="p-2 px-4 border-white border-2 text-white transition-all from-orange-700 bg-gradient-to-t rounded-lg w-fit hover:bg-orange-600 bg-orange-500 font-semibold ">
                                        Mon alliance
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="px-4 pt-3">
                    <button name="modal-clan" style=" text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                        class="p-2 px-4 show-event border-white border-2 text-white transition-all from-orange-700 bg-gradient-to-t rounded-lg w-fit hover:bg-orange-600 bg-orange-500 font-semibold ">
                        Créer une alliance
                    </button>
                </div>
            @endif

            <form action="{{ route('search.clan') }}" method="POST"
                class="flex px-4 pb-3 flex-row gap-4 mt-2 items-center">
                @csrf
                <input type="search" id="clan_search" name="clan_search" required placeholder="Nom de alliance"
                    class="block w-4/5 p-2.5 text-stone-800 border font-medium border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                <button style=" text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                    class="p-2  text-white transition-all from-stone-700 bg-gradient-to-t text-sm border-white border-2 rounded-lg w-1/5 hover:bg-stone-600 bg-stone-500 font-semibold ">
                    Rechercher
                </button>
            </form>
            <div class="px-4 py-3 bg-[#1a2539]">
                <span class="font-semibold">Recherche avancée</span>
                <button name="modal-clan" style=" text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                    class="p-2 px-4 show-event text-white transition-all border-white border-2 text-sm mx-4 from-lime-700 bg-gradient-to-t rounded-lg w-fit hover:bg-lime-600 bg-lime-500 font-semibold ">
                    Afficher
                </button>
            </div>
        </div>
        <div id="modal-clan" hidden
            class="expend-modal w-full fixed h-full bg-black/50 top-0 left-0 flex justify-center items-center">
            <form style="" class="modal-content shadow-xl bg-white max-w-xl border-white border-2"
                enctype="multipart/form-data" method="POST" action="{{ route('add.clan') }}">
                @csrf
                <input hidden type="number" name="prix" value="{{ $prix }}">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-orange-500 font-bold " id="exampleModalLabel">
                        Créer une alliance</h5>
                    <button name="modal-clan" class="close close-modal-button text-black" type="button"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="nom_clan" class="block mb-2 text-sm font-medium text-stone-800 ">Selectionner votre
                        écusson</label>
                    <div class="flex flex-row gap-4 mb-4 justify-center flex-wrap">
                        <button type="button" name="assets/images/clan1.png"
                            class="border-white check-spc border-4 rounded-xl cursor-pointer  p-2 bg-stone-100 bg-gradient-to-tr"
                            name="assets/images/clan1.png">
                            <img src="{{ asset('assets/images/clan1.png') }}" width="50" height="50"
                                alt="">
                        </button>
                        <button type="button" name="assets/images/clan2.png"
                            class="border-white check-spc border-4 rounded-xl cursor-pointer p-2  bg-stone-100 bg-gradient-to-tr"
                            name="assets/images/clan2.png">
                            <img src="{{ asset('assets/images/clan2.png') }}" width="50" height="50"
                                alt="">
                        </button>
                        <button type="button" name="assets/images/clan3.png"
                            class="border-white check-spc border-4 rounded-xl cursor-pointer p-2  bg-stone-100 bg-gradient-to-tr"
                            name="assets/images/clan3.png">
                            <img src="{{ asset('assets/images/clan3.png') }}" width="50" height="50"
                                alt="">
                        </button>
                        <button type="button" name="assets/images/clan4.png"
                            class="border-white check-spc border-4 rounded-xl cursor-pointer p-2  bg-stone-100 bg-gradient-to-tr"
                            name="assets/images/clan4.png">
                            <img src="{{ asset('assets/images/clan4.png') }}" width="50" height="50"
                                alt="">
                        </button>
                    </div>
                    <input type="text" id="banner_clan" hidden name="banner"
                        class="block w-full p-2 text-stone-800 border border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                    <div class="mb-1">
                        <label for="nom_clan" class="block mb-2 text-sm font-medium text-stone-800 ">Donner
                            un nom à votre Alliance</label>
                        <input type="text" id="nom_clan" name="nom_clan" required
                            class="block w-full p-2 text-stone-800 border border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                    </div>
                    <div class="mb-1">
                        <label for="description_clan" class="block mb-2 text-sm font-medium text-stone-800 ">Donner une
                            description
                        </label>
                        <textarea id="description_clan" name="description_clan" rows="4" required
                            class="block resize-none p-2.5 w-full text-sm text-stone-800 bg-stone-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="Décrire l'événement"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-32">
                    <button
                        class="btn bg-blue-600 flex justify-center my-2 items-center hover:bg-blue-500 mx-auto from-blue-300 bg-gradient-to-tr  text-white font-bold py-2 "
                        type="submit">Créer {{ $prix }} <img width="24" height="24"
                            src="{{ url('assets/images/icons8-money-48.png') }}" alt="" srcset=""></button>
                </div>
            </form>
        </div>
    </div>
    <div class="my-4 flex max-w-5xl mx-auto flex-col gap-2 px-5" style="">
        <h3 class="text-white uppercase text-center my-2">Alliances SAMU</h3>
        @if ($search != null)
            <div class="flex mb-8 items-center">
                <p> Reésultat pour "{{ $search }}" ({{ count($clans) }})</p>
                <a href="{{ url('/dashboard/alliances') }}">
                    <button style=" text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                        class="p-2 px-4 text-white transition-all border-white border-2 text-sm mx-4 from-lime-700 bg-gradient-to-t rounded-lg w-fit hover:bg-lime-600 bg-lime-500 font-semibold ">
                        Voir les alliances
                    </button>
                </a>
            </div>
        @empty($clans)
            <h4> Aucun resultat pour cette recherche </h4>
        @endempty
        @else
        @empty($clans)
            <h4> Il n’y a pas encore d’alliances disponible, créez maintenant la votre </h4>
        @endempty
        @endif

    @foreach ($clans as $item)
        <a href="{{ url('/dashboard/alliance/' . $item->id) }}"
            class=" hover:no-underline overflow-hidden bg-[#1a2539] cursor-pointer text-center  rounded-l-xl hover:bg-[#151b28] border-2 border-[#151b28] w-full text-white">
            <div class="gap-4 justify-between pr-4 items-center flex flex-row">
                <div class="gap-4 items-center flex flex-row">
                    <div class=" p-2 h-full py-3 bg-white">
                        <img src="{{ asset($item->banner) }}" width="30" height="30" alt="">
                    </div>
                    <div class=" ">
                        {{ $item->nom_clan }}
                        <div class="flex items-center gap-1">
                            @switch($item->niveau)
                                @case(1)
                                    <img title="niveau {{ $item->niveau }}"
                                        src="{{ asset('assets/images/image1_0 (15).png') }}" width="30" height="30"
                                        alt="">
                                @break

                                @case(2)
                                    <img title="niveau {{ $item->niveau }}"
                                        src="{{ asset('assets/images/image1_0 (15).png') }}" width="30" height="30"
                                        alt="">
                                @break

                                @case(3)
                                    <img title="niveau {{ $item->niveau }}"
                                        src="{{ asset('assets/images/image0_0 (15).png') }}" width="30" height="30"
                                        alt="">
                                @break

                                @case(4)
                                    <img title="niveau {{ $item->niveau }}"
                                        src="{{ asset('assets/images/image0_0 (15).png') }}" width="30" height="30"
                                        alt="">
                                @break

                                @case(5)
                                    <img title="niveau {{ $item->niveau }}"
                                        src="{{ asset('assets/images/image0_0 (14).png') }}" width="30" height="30"
                                        alt="">
                                @break

                                @default
                                    <img title="niveau {{ $item->niveau }}"
                                        src="{{ asset('assets/images/image1_0 (15).png') }}" width="30" height="30"
                                        alt="">
                            @endswitch
                            <span class="text-xs">Alliance de niveau {{ $item->niveau }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-white text-[#151b28] p-2 shadow-inner rounded-md">
                        {{ $item->count_user }}/{{ $item->max }}</div>
                </div>
            </div>
        </a>
    @endforeach

    </div>

@endsection
