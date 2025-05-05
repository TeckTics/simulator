@extends('admin.master', ['activePage' => 'evenement'])
@section('title', __('Evenements'))
@section('content')
    <div class="container-fluid relative">
        <div class="text-xs">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a> \ <a
                href="{{ url('/admin/dashboard/evenements') }}">Evénements</a> \ <a href="#"
                class="text-primary font-semibold">Evénement ({{ $event->nom_event }})</a>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">{{ $event->nom_event }}</h1>
        </div>
        @if (session('status'))
            <div class="alert alert-success max-w-96 text-sm ">
                {{ session('status') }}
            </div>
        @endif

        <div class="row gap-4">
            <div class="card col-lg-4 px-1  mb-4">
                <div class="card-body">
                    <div class="text-sm justify-between h-96 overflow-hidden w-full items-center py-2 flex border-b">
                        <img src="{{ asset($event->image) }}" class="w-full h-full" alt="" srcset="">
                    </div>
                    <div class="text-sm justify-between items-center py-2 flex border-b">
                        <span class="font-bold">Titre de l'événement</span>
                        <span>{{ $event->nom_event }}</span>
                    </div>
                    <div class="text-sm justify-between items-center py-2 flex border-b">
                        <span class="font-bold">Description</span>
                        <p class="text-right"> {{ $event->description_event }}</p>
                    </div>
                    <div class="text-sm justify-between items-center py-2 flex border-b">
                        <span class="font-bold">Type</span>
                        <span>{{ $event->type_event }}</span>
                    </div>
                    <div class="text-sm justify-between items-center py-2 flex border-b">
                        <span class="font-bold">Publié</span>
                        <span>{{ $event->published == 1 ? 'oui' : 'non' }}</span>
                    </div>
                    <div class="text-sm justify-between items-center py-2 flex border-b">
                        <span class="font-bold">Recompense</span>
                        <div class="flex gap-1 items-center">
                            <span>{{ $event->recompense }}</span>
                            <img width="24" height="24" src="{{ url('assets/images/icons8-money-48.png') }}"
                                alt="" srcset="">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" data-toggle="modal" data-target="#editEventModal"
                            class="text-sm text-warning hover:text-white btn btn-warning">Modifier</button>
                        <a href="{{ url('admin/api/delete-evenement/' . $event->id) }}"
                            class="btn btn-danger btn-sm">Supprimer</a>
                    </div>
                </div>
            </div>
            <div class="card col-lg-5 px-1  mb-4">
                <div class="card-header">
                    Participants
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($participants as $participant)
                            <li class=" p-2  rounded-3xl  px-3 text-sm bg-gray-50">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full"
                                            src="{{ asset($participant->profile ?? 'assets/icons/user.svg') }}"
                                            alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $participant->pseudo }}
                                        </p>
                                        {{-- <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@flowbite.com
                                        </p> --}}
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $participant->experience }} <span class="text-sm">Exp</span>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        <a href="{{ url('/admin/dashboard/joueur/' . $participant->id) }}"
                                            class="btn btn-primary text-sm btn-fill">Voir le profil</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('edit.event') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editer un événement</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <input type="number" hidden id="id" name="id" value="{{ $event->id }}">
                        <label for="nom_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de
                            l'événement</label>
                        <input type="text" id="nom_event" name="nom_event" value="{{ $event->nom_event }}"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description_event"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description de
                            l'événement</label>
                        <textarea id="description_event" name="description_event" rows="4"
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décrire l'événement">{{ $event->description_event }}</textarea>
                    </div>
                    <div class="mb-1">
                        <label for="recompense"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recompense du ou des
                            gagnants (En pièce)</label>
                        <input type="number" id="recompense" placeholder="0" name="recompense"
                            value="{{ $event->recompense }}"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="date_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                            de fin</label>
                        <input type="date" id="date_fin" placeholder="0" name="date_fin"
                            value="{{ $event->date_fin }}"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="type_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                            d'événement</label>
                        <select type="date" id="type_event" name="type_event"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection le type d'événement --</option>
                            <option selected="{{ $event->type_event == 'solo' ? true : false }}" value="solo">Solo
                            </option>
                            <option selected="{{ $event->type_event == 'multi' ? true : false }}" value="multi">
                                Multijoueur</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="published"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publié</label>
                        <select type="date" id="published" name="published"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection le type d'événement --</option>
                            <option selected="{{ $event->published == 1 ? true : false }}" value="1">Oui</option>
                            <option selected="{{ $event->published == 0 ? true : false }}" value="0">Non</option>
                        </select>
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
                    <button class="btn btn-primary btn-sm text-blue-500" type="submit">Enregistrer</button>
                    <button class="btn btn-secondary btn-sm text-stone-500" type="button"
                        data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
