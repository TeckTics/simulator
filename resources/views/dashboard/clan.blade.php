@extends('dashboard.master', ['activePage' => 'clans'])
@section('title', __('Alliances SAMU'))
@section('content')
    <div class="relative">
        @if (session('status') && session('color'))
            <div class="flex expend-modal absolute  top-0 -translate-x-1/2 left-1/2 items-center p-4 mb-4 text-sm text-{{ session('color') }}-800 rounded-lg bg-{{ session('color') }}-50 dark:bg-gray-800 dark:text-{{ session('color') }}-300"
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
        <div class="px-4 text-[#1a2539]">
            <a href="{{ url('/dashboard/alliances') }}" class="text-white hover:text-blue-500 font-semibold">Retour</a>
        </div>
        <div class="p-4 gap-4 grid grid-cols-4 ">
            <div class="col-span-1">
                <div class=" h-fit bg-[#151b28] text-white rounded-xl ">
                    <div class="p-4 ">
                        <img src="{{ asset($clanUser->banner) }}" width="150" class="mx-auto" height="150"
                            alt="" srcset="">
                    </div>
                    <div class=" py-4">
                        <h3 style=" text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.315);"
                            class="text-2xl text-blue-500 font-bold text-center">{{ $clanUser->nom_clan }}</h3>
                        <p class="text-center my-4">{{ $clanUser->description_clan }}</p>
                        <div class="flex justify-center flex-col items-center">
                            @switch($clanUser->niveau)
                                @case(1)
                                    <img title="niveau {{ $clanUser->niveau }}"
                                        src="{{ asset('assets/images/image1_0 (15).png') }}" width="50" height="50"
                                        alt="">
                                @break

                                @case(2)
                                    <img title="niveau {{ $clanUser->niveau }}"
                                        src="{{ asset('assets/images/image1_0 (15).png') }}" width="50" height="50"
                                        alt="">
                                @break

                                @case(3)
                                    <img title="niveau {{ $clanUser->niveau }}"
                                        src="{{ asset('assets/images/image0_0 (15).png') }}" width="50" height="50"
                                        alt="">
                                @break

                                @case(4)
                                    <img title="niveau {{ $clanUser->niveau }}"
                                        src="{{ asset('assets/images/image0_0 (15).png') }}" width="50" height="50"
                                        alt="">
                                @break

                                @case(5)
                                    <img title="niveau {{ $clanUser->niveau }}"
                                        src="{{ asset('assets/images/image0_0 (14).png') }}" width="50" height="50"
                                        alt="">
                                @break

                                @default
                                    <img title="niveau {{ $clanUser->niveau }}"
                                        src="{{ asset('assets/images/image1_0 (15).png') }}" width="50" height="50"
                                        alt="">
                            @endswitch
                            <span>Alliance de niveau {{ $clanUser->niveau }}</span>
                        </div>
                        <div>
                            <ul>
                                <li class="flex justify-between px-4 bg-[#1a2539] p-2">
                                    <span>Experience</span><span>{{ $clanUser->experience }}</span>
                                </li>
                                <li class="flex justify-between px-4 bg-[#151b28]    p-2">
                                    <span>Nom de place</span><span>{{ $clanUser->max }}</span>
                                </li>
                                <li class="flex justify-between px-4 bg-[#1a2539] p-2">
                                    <span>Experience</span><span>{{ $clanUser->experience }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- <div class="bg-white  w-full text-3xl font-semibold text-center my-auto rounded-xl py-4 text-black border-4">
                
            </div> --}}

                </div>

                @if ($clanUser->chef_id == Auth::guard('appuser')->user()->id)
                    <form action="{{ url('/dashboard/api/delete-clan') }}" method="get">
                        @csrf
                        <button
                            class="btn bg-red-700 flex justify-center my-2 items-center hover:bg-red-500  from-red-500 bg-gradient-to-tr  text-white font-bold py-2 "
                            type="submit">Détruire l'alliance </button>
                    </form>
                @else
                    <button
                        class="btn bg-red-600 flex justify-center my-2 items-center hover:bg-red-500  from-red-300 bg-gradient-to-tr  text-white font-bold py-2 "
                        type="submit">Quitter l'alliance </button>
                @endif
            </div>
            <div class="col-span-3">
                <h3 class="my-2 text-center text-white ">Membres</h3>
                <div class="flex gap-4 justify-between">

                    @if ($clanUser->chef_id == Auth::guard('appuser')->user()->id)
                        @if ($clanUser->niveau == 4)
                            <button name="modal-update-clan"
                                class="btn bg-blue-600 flex show-event justify-center my-2 items-center hover:bg-blue-500  from-blue-300 bg-gradient-to-tr  text-white font-bold py-2 "
                                type="submit">Monter le niveau de l'alliance
                            </button>
                        @endif
                        <button name="modal-edit-clan"
                            class="btn bg-orange-600 flex show-event justify-center my-2 items-center hover:bg-orange-500  from-orange-500 bg-gradient-to-tr  text-white font-bold py-2 "
                            type="submit">Modifier l'alliance</button>
                    @endif
                    <div id="modal-update-clan" hidden
                        class="expend-modal w-full z-40 fixed h-full bg-black/50 top-0 left-0 flex justify-center items-center">
                        <form style=""
                            class="modal-content shadow-xl bg-white max-w-xl border-white border-2"
                            enctype="multipart/form-data" method="POST" action="{{ route('add.clan') }}">
                            @csrf
                            <input hidden type="number" name="prix" value="{{ $prix }}">
                            <input hidden type="number" name="id" value="{{ $clanUser->id }}">
                            <div class="modal-header">
                                <h5 class="modal-title text-center text-orange-500 font-bold " id="exampleModalLabel">
                                    monter le niveau de votre alliance</h5>
                                <button name="modal-update-clan" class="close close-modal-button text-black"
                                    type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="p-4">
                                <h4>Avantages</h4>
                                <ul class="max-w-md mt-4 space-y-1 text-gray-700 list-disc list-inside ">
                                    <li>
                                        Obtenez 1000 points d'expérience
                                    </li>
                                    <li>
                                        Débloquer de nouveaux écussons
                                    </li>
                                    <li>
                                        La limite de membres passe à 12
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer px-32">
                                <button
                                    class="btn bg-blue-600 flex justify-center my-2 items-center hover:bg-blue-500 mx-auto from-blue-300 bg-gradient-to-tr  text-white font-bold py-2 "
                                    type="submit">Améliorer {{ $prix }} <img width="24" height="24"
                                        src="{{ url('assets/images/icons8-money-48.png') }}" alt=""
                                        srcset=""></button>
                            </div>
                        </form>
                    </div>
                    <div id="modal-edit-clan" hidden
                        class="expend-modal w-full fixed h-full z-40 bg-black/50 top-0 left-0 flex justify-center items-center">
                        <form style=""
                            class="modal-content shadow-xl bg-white max-w-xl border-white border-2"
                            enctype="multipart/form-data" method="POST" action="{{ route('update.clan') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title text-center text-orange-500 font-bold " id="exampleModalLabel">
                                    Modifier l'alliance</h5>
                                <button name="modal-edit-clan" class="close close-modal-button text-black" type="button"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="nom_clan" class="block mb-2 text-sm font-medium text-stone-800 ">Selectionner
                                    votre
                                    écusson</label>
                                <div class="flex flex-row gap-4 mb-4 justify-center flex-wrap">
                                    <button type="button" name="assets/images/clan1.png" @class([
                                        ' check-spc border-4 rounded-xl cursor-pointer  p-2 bg-stone-100 bg-gradient-to-tr',
                                        'border-purple-400' => $clanUser->banner === 'assets/images/clan1.png',
                                        'border-white' => $clanUser->banner !== 'assets/images/clan1.png',
                                    ])
                                        name="assets/images/clan1.png">
                                        <img src="{{ asset('assets/images/clan1.png') }}" width="50" height="50"
                                            alt="">
                                    </button>
                                    <button type="button" name="assets/images/clan2.png" @class([
                                        ' check-spc border-4 rounded-xl cursor-pointer  p-2 bg-stone-100 bg-gradient-to-tr',
                                        'border-purple-400' => $clanUser->banner === 'assets/images/clan2.png',
                                        'border-white' => $clanUser->banner !== 'assets/images/clan2.png',
                                    ])
                                        name="assets/images/clan2.png">
                                        <img src="{{ asset('assets/images/clan2.png') }}" width="50" height="50"
                                            alt="">
                                    </button>
                                    <button type="button" name="assets/images/clan3.png" @class([
                                        ' check-spc border-4 rounded-xl cursor-pointer  p-2 bg-stone-100 bg-gradient-to-tr',
                                        'border-purple-400' => $clanUser->banner === 'assets/images/clan3.png',
                                        'border-white' => $clanUser->banner !== 'assets/images/clan3.png',
                                    ])
                                        name="assets/images/clan3.png">
                                        <img src="{{ asset('assets/images/clan3.png') }}" width="50" height="50"
                                            alt="">
                                    </button>
                                    <button type="button" name="assets/images/clan4.png" @class([
                                        ' check-spc border-4 rounded-xl cursor-pointer  p-2 bg-stone-100 bg-gradient-to-tr',
                                        'border-purple-400' => $clanUser->banner === 'assets/images/clan4.png',
                                        'border-white' => $clanUser->banner !== 'assets/images/clan4.png',
                                    ])
                                        name="assets/images/clan4.png">
                                        <img src="{{ asset('assets/images/clan4.png') }}" width="50" height="50"
                                            alt="">
                                    </button>
                                </div>
                                <input type="text" id="banner_clan" value="{{ $clanUser->banner }}" hidden
                                    name="banner">
                                <input type="number" id="id" value="{{ $clanUser->id }}" hidden name="id">
                                <div class="mb-1">
                                    <label for="nom_clan" class="block mb-2 text-sm font-medium text-stone-800 ">Donner
                                        un nom à votre Alliance</label>
                                    <input type="text" id="nom_clan" name="nom_clan"
                                        value="{{ $clanUser->nom_clan }}"
                                        class="block w-full p-2 text-stone-800 border border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                                </div>
                                <div class="mb-1">
                                    <label for="description_clan"
                                        class="block mb-2 text-sm font-medium text-stone-800 ">Donner une
                                        description
                                    </label>
                                    <textarea id="description_clan" name="description_clan" rows="4"
                                        class="block resize-none p-2.5 w-full text-sm text-stone-800 bg-stone-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                                        placeholder="Décrire l'événement">{{ $clanUser->description_clan }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer px-32">
                                <button
                                    class="btn bg-blue-600 flex justify-center my-2 items-center hover:bg-blue-500 mx-auto from-blue-300 bg-gradient-to-tr  text-white font-bold py-2 "
                                    type="submit">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
                <span style="" class="font-bold pt-4 text-xl text-white">{{ count($clanUsers) }} /
                    {{ $clanUser->max }}</span>
                <div class="overflow-hidden mt-2 rounded-lg">
                    <div class="relative overflow-x-auto" style="">
                        <div class="relative flex flex-col gap-2 overflow-x-auto">
                            @foreach ($clanUsers as $key => $user)
                                <a  href="{{ url('/dashboard/echange/' . $user->id)}}"
                                    class="flex show-event gap-4 btn justify-between border-[#151b28] border-2 bg-white p-2 items-center">
                                    <div>
                                        <div class="flex gap-4 items-center">
                                            @switch($user->id)
                                                @case(1)
                                                    <div
                                                        class="w-10 h-10 bg-yellow-500 text-white rounded-md flex justify-center items-center bg-gradient-to-t from-orange-500  border">
                                                        {{ $key + 1 }}
                                                    </div>
                                                @break

                                                @case(2)
                                                    <div
                                                        class="w-10 h-10  bg-gray-500 rounded-md flex justify-center text-white items-center bg-gradient-to-t from-gray-500 border">
                                                        {{ $key + 1 }}
                                                    </div>
                                                @break

                                                <div
                                                    class="w-10 h-10 bg-stone-500 rounded-md flex justify-center items-center bg-gradient-to-t from-white border">
                                                    {{ $key + 1 }}
                                                </div>

                                                @default
                                            @endswitch
                                            <span class="text-xl text-[#1a2539] font-medium">{{ $user->pseudo }}</span>
                                            @if ($clanUser->chef_id == $user->id)
                                               ( <span class="text-[#1a2539]">Chef d'alliance @if ($clanUser->chef_id == Auth::guard('appuser')->user()->id)
                                                    @endif </span>)
                                            @endif
                                        </div>

                                    </div>
                                    <div class="flex items-center gap-2 p-2 bg-[#1a2539] text-white font-medium rounded-md shadow-inner">
                                        <span>{{ $user->experience }}</span> <img width="24" height="24"
                                            src="{{ asset('assets/images/icons8-performance-48.png') }}" alt=""
                                            srcset="">
                                    </div>

                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
