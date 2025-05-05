@extends('admin.master', ['activePage' => 'mission'])
@section('title', __('Missions'))
@section('content')
    <div class="container-fluid ">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Missions</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                                                                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        @if (session('status') && session('color'))
            <div class="alert alert-{{ session('color') }} max-w-96 text-sm ">
                {{ session('status') }}
            </div>
        @endif

        <button class="btn btn-primary my-4" data-toggle="modal" data-target="#addMissionModal">Ajouter une mission</button>

        <!-- Content Row -->
        <!-- Content Row -->
        <div class="flex gap-2">
            @foreach ($missions as $mission)
                <div
                    class="card relative min-w-96  bg-black cursor-pointer bg-gradient-to-tr from-stone-950 hover:shadow-2xl shadow-md transition-all mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="absolute z-10 top-0 gap-4 left-0 px-2 w-full py-2 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 h3 font-weight-bold text-white ">{{ $mission->nom_mission }}</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle p-2 shadow-md bg-white rounded-full px-2.5 size-10" href="#"
                                role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item text-primary"
                                    href="{{ url('/admin/dashboard/mission/' . $mission->id) }}">
                                    Details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a  href="{{ url('admin/api/delete-mission/' . $mission->id) }}" class="dropdown-item text-danger">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute z-10 bottom-0 gap-4 left-0 px-2 w-full py-2 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 h6 text-white "><span class="font-weight-bold ">Durée:</span> {{ $mission->duree }}
                        </h6>
                        <h6 class="m-0 h6 text-white ">
                            @if ($mission->published == 1)
                                <span class="size-4 bg-green-500 rounded-full"></span>
                            @else
                                non publié <span class="size-4 bg-stone-500 rounded-full"></span>
                            @endif
                        </h6>
                    </div>
                    <div class="w-full bg-black max-w-96 h-52 overflow-hidden ">
                        <img class="w-full opacity-40" src="{{ asset($mission->image) }}" alt="" srcset="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="addMissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('add.mission') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une Mission</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="nom_mission"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Intitulé
                            de la mission</label>
                        <input type="text" id="nom_mission" name="nom_mission" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description_mission"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description de la
                            mission</label>
                        <textarea id="description_mission" name="description_mission" rows="4" required
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décriver la mission"></textarea>
                    </div>
                    <div class="mb-1">
                        <label for="recompense"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Récompense</label>
                        <input type="number" id="recompense" name="recompense" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="type_unite_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                            d'unité pour cette mission</label>
                        <select type="date" id="type_unite_id" name="type_unite_id"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection le type d'unité --</option>
                            @foreach ($typeUnites as $typeUnite)
                                <option value="{{ $typeUnite->id }}">{{ $typeUnite->nom_type_unite }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="personnel_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personnel requis pour cette mission</label>
                        <select type="date" id="personnel_id" name="personnel_id"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection un personnel --</option>
                            @foreach ($personnels as $personnel)
                                <option value="{{ $personnel->id }}">{{ $personnel->titre_personnel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="published"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publié</label>
                        <select type="date" id="published" name="published"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection le type d'événement --</option>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="duree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Durée
                            de
                            la mission (en minutes)</label>
                        <input type="time" id="duree" name="duree" required
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
                    <button class="btn btn-primary btn-sm text-blue-500" type="submit">Enregistrer</button>
                    <button class="btn btn-secondary btn-sm text-stone-500" type="button"
                        data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
