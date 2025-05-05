@extends('dashboard.master', ['activePage' => 'clans'])
@section('title', __('Alliances SAMU'))
@section('content')
    <div class="relative pb-20 pt-10">
        <a href="/dashboard/alliance/{{ $myClan->clan_id }}">
            <button style="font-family: cursive; text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.756);"
                class="p-2 px-4 text-white transition-all border-white border-2 text-sm mx-4  w-fit font-semibold ">
                Retour
            </button>
        </a>
       
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
        <div>
            <div id="modal-edit-clan" class="expend-modal w-full  h-full top-0 left-0 flex justify-center items-center">
                <form style="font-family: cursive;" class="modal-content shadow-xl bg-white max-w-xl border-white border-2"
                    method="POST" action="{{ route('init.demande') }}">
                    @csrf
                    <input type="number" name="user_id" hidden value="{{ $user->id }}" id="">
                    <div class="modal-header">
                        <h5 class="modal-title text-center text-blue-500 font-bold " id="exampleModalLabel">
                            Echange d'unité</h5>
                        {{-- <button name="modal-edit-clan" class="close close-modal-button text-black" type="button"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <span class="text-blue-500"> {{ $user->pseudo }}</span>
                        <div class="flex shadow-inner p-2 bg-purple-100 flex-row gap-4 justify-start flex-wrap">
                            @foreach ($unites as $unite)
                                <div class="flex flex-col justify-center items-start">
                                    <button type="button" name="{{ $unite->id }}"
                                        class="border-white check-spc border-4 rounded-xl cursor-pointer p-2  bg-stone-200 bg-gradient-to-tr"
                                        name="{{ $unite->id }}">
                                        <img src="{{ asset($unite->image) }}" width="150" height="150" alt="">
                                    </button>
                                    <div class="w-full mt-1 h-4 rounded-xl overflow-hidden bg-gray-50">
                                        <div style="width: {{ $unite->sante }}%"
                                            class="h-full text-xs bg-green-500  px-2 text-white">Santé {{ $unite->sante }}%
                                        </div>
                                    </div>
                                    {{ $unite->nom }}
                                </div>
                            @endforeach
                        </div>
                        <input type="text" id="banner_clan" hidden name="unite_user_id"
                            class="block w-full p-2 text-stone-800 border border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                        <img src="{{ asset('/assets/icons/echange.svg') }}" class="mx-auto" width="50" height="50"
                            alt="">

                        <div class="flex shadow-inner p-2 bg-orange-100 flex-row gap-4   justify-start flex-wrap">
                            @foreach ($myUnites as $unite)
                                <div class="flex flex-col justify-center items-center">
                                    <button type="button" name="{{ $unite->id }}"
                                        class="border-white check-spc-2 border-4 rounded-xl cursor-pointer p-2  bg-stone-200 bg-gradient-to-tr"
                                        name="{{ $unite->id }}">
                                        <img src="{{ asset($unite->image) }}" width="150" height="150" alt="">
                                    </button>
                                    <div class="w-full mt-1 h-4 rounded-xl overflow-hidden bg-gray-50">
                                        <div style="width: {{ $unite->sante }}%"
                                            class="h-full text-xs bg-green-500  px-2 text-white">Santé {{ $unite->sante }}%
                                        </div>
                                    </div>
                                    {{ $unite->nom }}
                                </div>
                            @endforeach
                        </div>
                        <input type="text" id="check-input" hidden name="sender_uniter_id"
                            class="block w-full p-2 text-stone-800 border border-gray-300 rounded-lg bg-stone-50 text-xs focus:ring-blue-500 focus:border-blue-500 ">
                        {{-- <h6 for="nom_clan" class="block mb-2 text-sm font-medium text-stone-800 text-center">ou
                        </h6> --}}
                        {{-- <input placeholder="Argent" type="number"  name="sender_argent" id="argent_exchange"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "> --}}
                    </div>
                    <div class="modal-footer px-32">
                        <button
                            class="btn bg-blue-600 flex justify-center my-2 items-center hover:bg-blue-500 mx-auto from-blue-300 bg-gradient-to-tr  text-white font-bold py-2 "
                            type="submit">Demander</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
