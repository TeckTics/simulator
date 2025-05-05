@extends('admin.master', ['activePage' => 'evenement'])
@section('title', __('Evenements'))
@section('content')
    <div class="container-fluid relative">
        <div class="text-xs">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a> \ <a
                href="{{ url('/admin/dashboard/missions') }}">Missions</a> \ <a href="#"
                class="text-primary font-semibold">Mission ({{ $mission->nom_mission }})</a>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">{{ $mission->nom_mission }}</h1>
        </div>
        @if (session('status'))
            <div class="alert alert-success max-w-96 text-sm ">
                {{ session('status') }}
            </div>
        @endif

        <div class="row gap-4">
            <div class="card col-lg-3 mb-4 overflow-hidden" style="padding: 0;">
                <div class="card-body p-0">
                    <div
                        class="text-sm justify-between h-96 overflow-hidden w-full items-center pt-2 bg-dark flex border-b">
                        <img src="{{ asset($mission->image) }}" class="w-full h-full" alt="" srcset="">
                    </div>
                    <div class="p-4">
                        <div class="text-sm justify-between items-center py-2 flex border-b">
                            <span class="font-bold">Intitulé de la mission</span>
                            <span>{{ $mission->nom_mission }}</span>
                        </div>
                        <div class="text-sm justify-between items-center py-2 flex border-b">
                            <span class="font-bold">Description</span>
                            <p class="text-right"> {{ $mission->description_mission }}</p>
                        </div>
                        <div class="text-sm justify-between items-center py-2 flex border-b">
                            <span class="font-bold">Type de unité adapté à la mission</span>
                            <a href="{{ url('/admin/dashboard/type-unite#' . $mission->type_unites_id) }}">
                                <div class="flex justify-center gap-2 items-center">
                                    <span>{{ $mission->nom_type_unite }}</span>
                                    <img width="32" class="p-2 bg-stone-100 rounded-md"
                                        src="{{ asset($mission->type_unites_image) }}" alt="" srcset="">
                                </div>
                            </a>
                        </div>

                        <div class="text-sm justify-between items-center py-2 flex border-b">
                            <span class="font-bold">Publié</span>
                            <span>{{ $mission->published == 1 ? 'oui' : 'non' }}</span>
                        </div>
                        <div class="text-sm justify-between items-center py-2 flex border-b">
                            <span class="font-bold">Recompense</span>
                            <div class="flex gap-1 items-center">
                                <span>{{ $mission->recompense }}</span>
                                <img width="24" height="24" src="{{ url('assets/images/icons8-money-48.png') }}"
                                    alt="" srcset="">
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" data-toggle="modal" data-target="#editEventModal"
                                class="text-sm text-warning hover:text-white btn btn-warning">Modifier</button>
                            <a href="{{ url('admin/api/delete-evenement/' . $mission->id) }}"
                                class="btn btn-danger btn-sm">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('edit.mission') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="number" id="id" name="id" hidden value="{{ $mission->id }}">
                    <div class="mb-1">
                        <label for="nom_mission"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Intitulé
                            de la mission</label>
                        <input type="text" id="nom_mission" name="nom_mission" value="{{ $mission->nom_mission }}"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description_mission"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description de la
                            mission</label>
                        <textarea id="description_mission" name="description_mission" rows="4"
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décriver la mission">{{ $mission->description_mission }}</textarea>
                    </div>
                    <div class="mb-1">
                        <label for="recompense"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Récompense</label>
                        <input type="number" id="recompense" name="recompense" value="{{ $mission->recompense }}"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="type_unite_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                            d'unité pour cette mission</label>
                        <select id="type_unite_id" name="type_unite_id" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="{{ $mission->type_unite_id }}">-- Selection le type d'unité --</option>
                            @foreach ($typeUnites as $typeUnite)
                                <option value="{{ $typeUnite->id }}">{{ $typeUnite->nom_type_unite }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="published"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publié</label>
                        <select type="date" id="published" name="published"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="{{$mission->published }}">-- Selection le type d'événement --</option>
                            <option selected="{{ $mission->published == 1 ? true : false }}" value="1">Oui</option>
                            <option selected="{{ $mission->published == 0 ? true : false }}" value="0">Non</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="duree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Durée
                            de
                            la mission (en minutes)</label>
                        <input type="time" id="duree" name="duree" value="{{ $mission->duree }}"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class=" mt-3 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image">Miniature</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="image_help" id="image" type="file" name="image">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning  btn-sm text-yellow-500" type="submit">Modifier</button>
                    <button class="btn btn-secondary btn-sm text-stone-500" type="button"
                        data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
