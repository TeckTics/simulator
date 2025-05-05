@extends('admin.master', ['activePage' => 'formation'])
@section('title', __('Formations'))
@section('content')
    <div class="container-fluid ">
        <div class="text-xs">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a> \ <a href="#">Formations</a>
        </div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Formations</h1>
        </div>
        <button class="btn btn-primary my-4" data-toggle="modal" data-target="#addFormationModal"> Nouvelle formation</button>

        <div class=" col-lg-12 px-1   mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formations</h6>
                <!-- <button class="btn btn-primary mt-4">Afficher le classement </button> -->
            </div>
            <div class="card-body overflow-hidden row">
                @forelse ($formations as $item)
                    <div class="col-lg-3">
                        <!-- Dropdown Card Example -->
                        <div class="card relative hover:shadow-2xl shadow-md transition-all mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="absolute top-0 gap-4 left-0 w-full py-2 d-flex flex-row align-items-center justify-content-end">
                                <h6 class="m-0 font-weight-bold text-white">{{ $item->libelle_formation }}</h6>
                                <div class="dropdown no-arrow z-10">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <button name="detailFormationModal-{{ $item->id }}"
                                            class="dropdown-item show-formation-detail text-info">
                                            Details
                                        </button>
                                        <button name="editFormationModal-{{ $item->id }}"
                                            class="dropdown-item  show-formation-edit text-warning">

                                            Modifier
                                        </button>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger"
                                            href="{{ url('/admin/api/delete-formation/' . $item->id) }}">
                                            Supprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="w-fit h-52 overflow-hidden bg-black">
                                <img class="w-fit opacity-20" src="{{ asset($item->image_formation) }}" alt=""
                                    srcset="">
                            </div>
                            <div class=" w-full h-full " id="detailFormationModal-{{ $item->id }}" hidden>
                                <div class=" bg-white" role="document">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Formation 1</h5>
                                        <button name="detailFormationModal-{{ $item->id }}" class=" close-modal-button"
                                            type="button">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-1 border-b">
                                            <h2 class="font-bold">Titre</h2>
                                            <p>{{ $item->libelle_formation }}</p>
                                        </div>
                                        <div class="mb-1 border-b">
                                            <h2 class="font-bold">Durée</h2>
                                            <p>{{ $item->temps_formation }}</p>
                                        </div>
                                        <div class="mb-1 border-b">
                                            <h2 class="font-bold">Prix</h2>
                                            <p>{{ $item->prix_formation }}</p>
                                        </div>
                                        <div class="mb-1">
                                            <h2 class="font-bold">Recompense</h2>
                                            <p>{{ $item->recompense_formation }} Exp</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="editFormationModal-{{ $item->id }}" class="w-full h-full " hidden>
                                <form class="modal-content" enctype="multipart/form-data" method="POST"
                                    action="{{ route('edit.formation') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit une formation</h5>
                                        <button class="close close-modal-button"
                                            name="editFormationModal-{{ $item->id }}" type="button">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="number" id="id" name="id" hidden
                                            value="{{ $item->id }}">
                                        <div class="mb-1">
                                            <label for="libelle_formation"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre
                                                de la formation</label>
                                            <input type="text" id="libelle_formation" name="libelle_formation"
                                                value="{{ $item->libelle_formation }}"
                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="mb-1">
                                            <label for="temps_formation"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Durée
                                                de la formation</label>
                                            <input type="time" id="temps_formation" value="{{ $item->temps_formation }}"
                                                name="temps_formation"
                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="mb-1">
                                            <label for="prix_formation"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
                                            <input type="number" id="prix_formation" placeholder="0" name="prix_formation"
                                                value="{{ $item->prix_formation }}"
                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="mb-1">
                                            <label for="recompense_formation"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recompense</label>
                                            <input type="number" id="recompense_formation" placeholder="0"
                                                name="recompense_formation" value="{{ $item->recompense_formation }}"
                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class=" mt-3 mx-auto">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                for="image_formation">Images</label>
                                            <input
                                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                aria-describedby="image_help" id="image_formation" type="file"
                                                name="image_formation">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary btn-sm text-blue-500"
                                            type="submit">Enregistrer</button>
                                        <button class="btn btn-secondary btn-sm text-stone-500" type="button"
                                            data-dismiss="modal">Fermer</button>
                                    </div>
                                </form>
                            </div>
                            {{-- <div
                                class="flex w-full bg-white absolute bottom-0 left-0 items-center justify-content-center justify-between gap-1 border-stone-100  py-2 border-y"> --}}
                            {{-- <span class="font-bold text-secondary">Prix</span> --}}
                            {{-- <div class="flex items-center">
                                    <span class="text-green-500 font-bold">1500</span>
                                    <img width="25" height="25" src="{{ asset('assets/images/icons8-money-48.png') }}"
                                        alt="" srcset="">
                                </div>
                            </div> --}}
                            <!-- Card Body -->
                            {{-- <div class="card-body text-sm">
                            <p class="py-1">
                                Dropdown menus can be placed in the card header in order to extend the functionality
                                of a basic card.
                            </p>
                            <div class="flex items-center justify-between gap-1 border-stone-100  py-2 border-y">
                                <span class="font-bold text-secondary">Prix</span>
                                <div class="flex items-center">
                                    <span class="text-green-500">5000</span>
                                    <img width="25" height="25" src="{{ asset('assets/images/icons8-money-48.png') }}"
                                        alt="" srcset="">
                                </div>
                            </div>
                            <div class="flex items-center gap-1 border-stone-100 justify-between  py-2 border-y">
                                <span class="font-bold text-secondary">Disponible pour les joueurs</span>
                                <span>Non</span>
                            </div>
                            <div class="flex items-center gap-1 border-stone-100 justify-between  py-2 border-y">
                                <button class="btn btn-sm btn-secondary">Ajouter dans la boutique</button>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                @empty

                    <div
                        class="col-lg-3 flex justify-center items-center text-center border h-52 bg-stone-100 shadow rounded-md animate-pulse">
                        <h4 class="h4">Aucune formation est enregistrée</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="modal fade" id="addFormationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST"
                action="{{ route('add.formation') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une formation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="libelle_formation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre de
                            la formation</label>
                        <input type="text" id="libelle_formation" name="libelle_formation" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    {{-- <div class="mb-1">
                        <label for="description_event"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description de la
                            formation</label>
                        <textarea id="description_event" name="description_event" rows="4" required
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décrire l'événement"></textarea>
                    </div> --}}
                    <div class="mb-1">
                        <label for="temps_formation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Durée de
                            la formation (en heure et minute)</label>
                        <input type="time" id="temps_formation" name="temps_formation" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="prix_formation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix de la
                            formation</label>
                        <input type="number" id="prix_formation" placeholder="0" name="prix_formation" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="recompense_formation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Experience aquis par le
                            joueur (Exp)</label>
                        <input type="number" id="recompense_formation" placeholder="0" name="recompense_formation"
                            required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class=" mt-3 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image_formation">Images</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="image_help" id="image_formation" type="file" name="image_formation">
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
    <div class="modal fade" id="editFormationModal" tabindex="-1" role="dialog" aria-labelledby="editPersonneModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('add.event') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit une formation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="nom_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre
                            de la formation</label>
                        <input type="text" id="nom_event" name="nom_event" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description_event"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description de la
                            formation</label>
                        <textarea id="description_event" name="description_event" rows="4" required
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décrire l'événement"></textarea>
                    </div>
                    <div class="mb-1">
                        <label for="nom_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Durée
                            de la formation</label>
                        <input type="time" id="nom_event" name="nom_event" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="recompense"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
                        <input type="number" id="recompense" placeholder="0" name="recompense" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div class="mb-1">
                        <label for="type_event"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attribuer a un
                            personnel</label>
                        <select type="date" id="type_event" name="type_event"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Publié dans la boutique --</option>
                            <option value="solo">Oui</option>
                            <option value="multi">Non</option>
                        </select>
                    </div>

                    <div class=" mt-3 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image">Images</label>
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

    <script>
        const addAptitudeButtonHandler = () => {
            const addAptitudeInput = document.getElementById("aptitudes_input");
            const addAptitudeInput = document.getElementById("aptitudes");
            addAptitudeButton..value =
        }

        const addAptitudeButton = document.getElementById("add_aptitudes_btn");
        addAptitudeButton.addEventListerner('click', addAptitudeButtonHandler())
    </script>
@endsection
