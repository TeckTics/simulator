@extends('dashboard.master', ['activePage' => 'profile'])
@section('title', __('Profile'))
@section('content')
    <div class="relative pb-20 pt-10 ">
        <a href="/dashboard/profile">
            <button 
                class="p-2 px-4 hover:bg-[#1a2539] hover:text-white text-[#1a2539] transition-all border-[#1a2539] border-2 text-sm mx-4  w-fit font-semibold ">
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
        <div >
            <div class="flex flex max-w-xl mx-auto  flex-col gap-4 mt-6 container mx-auto">
                <h2 class="text-[#1a2539] text-center font-bold text-2xl">Vos demandes d'echange d'unité</h2>
                <div class="h-96 overflow-y-auto p-4 flex flex-col gap-4">
                    @foreach ($demandeUniteSender as $key => $item)
                        <div class="rounded-xl border-2 bg-[#1a2539] p-4 hover:bg-[#151b28] border-white shadow ">
                            <p class="pb-2 ">
                               <span class="text-white font-medium">N° {{ $key + 1 }}</span> <span class="text-white"> Demande unité de {{ $item->nom }} à </span> <span
                                    class="text-blue-500 font-bold">{{ $item->pseudo }}</span>
                            </p>
                            <div>
                                <a href="{{ url('/dashboard/api/delete-demande/' . $item->id) }}">
                                    <button 
                                        class="p-2 px-4  text-white transition-all border-white border-2 text-xs   bg-gradient-to-t rounded-lg w-fit  from-rose-700 hover:bg-red-600 bg-red-500 font-semibold ">
                                        Retirer
                                    </button>
                                </a>
                                <button name="modal-view-exchange-{{ $item->id }}"
                                    
                                    class="p-2 px-4 show-event text-white transition-all border-white border-2 text-xs   bg-gradient-to-t rounded-lg w-fit from-blue-700 hover:bg-cyan-600 bg-cyan-500 font-semibold ">
                                    Voir
                                </button>
                            </div>
                            <div id="modal-view-exchange-{{ $item->id }}" hidden
                                class="expend-modal fixed  z-50 w-full  h-full bg-black/20 top-0 left-0 flex justify-center items-center">
                                <x-card-echange :pseudo="$item->pseudo" :id="$item->id" :uniteId="$item->unite_user_id"
                                    :uniteSenderId="$item->sender_uniter_id"></x-card-echange>
                            </div>
                        </div>
                    @endforeach
                    {{ $demandeUniteSender->links() }}
                </div>
            </div>
         
        </div>
    </div>
@endsection
