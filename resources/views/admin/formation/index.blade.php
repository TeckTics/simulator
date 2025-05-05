@extends('admin.master', ['activePage' => 'personnel'])
@section('title', __('Personnels'))
@section('content')
    <div class="container-fluid ">
        <div class="text-xs">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a> \ <a href="#">Personnels</a>
        </div>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Personnels</h1>
        </div>

        <button class="btn btn-primary my-4" data-toggle="modal" data-target="#addPersonelModal"> Nouveau personnel</button>

        <div class="card col-lg-12 px-1  shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste des personnels</h6>
                <!-- <button class="btn btn-primary mt-4">Afficher le classement </button> -->
            </div>
            <div class="card-body row">
                <div class="col-lg-3">
                    <!-- Dropdown Card Example -->
                    @foreach ($personnels as $item)
                        <div class="card  mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-secondary">{{ $item->titre_personnel }}</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item text-info" href="{{ url('/admin/dashboard/personnel/'. $item->id) }}">
                                            Details
                                        </a>
                                      
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="{{ url('/delete-personnel/'. $item->id)}}">
                                            Supprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('/admin/dashboard/personnel/'. $item->id) }}">
                                <div class="w-full h-52 overflow-hidden bg-gray-200">
                                    <img class="w-full" src="{{ asset($item->image) }}" alt="" srcset="">
                                </div>
                            </a>
                            <!-- Card Body -->
                            <div class="card-body text-sm">
                                <p class="py-1">
                                    {{ $item->description_personnel }}
                                </p>

                                <div class="flex items-center justify-between gap-1 border-stone-100  py-2 border-y">
                                    <span class="font-bold text-secondary">Prix</span>
                                    <div class="flex items-center">
                                        <span class="text-green-500">{{ $item->prix_personnel }}</span>
                                        <img width="25" height="25"
                                            src="{{ asset('assets/images/icons8-money-48.png') }}" alt=""
                                            srcset="">
                                    </div>
                                </div>

                                <div class="flex items-center gap-1 border-stone-100 justify-between  py-2 border-y">
                                    <span class="font-bold text-secondary">Disponible pour les joueurs</span>
                                    <span>
                                        @if ($item->published == 1)
                                            Oui
                                        @else
                                            Non
                                        @endif
                                    </span>
                                </div>
                                <div class="flex items-center gap-1 border-stone-100 justify-between  py-2 border-y">
                                    <form action="{{ route('edit.personnel') }}" method="POST">
                                        <input type="number" name="id" hidden value="{{ $item->id }}">
                                        @csrf
                                        @if ($item->published == 1)
                                            <button class="btn btn-sm btn-warning" name="publisherToShop" value="0">
                                                Retirer de la
                                                boutique</button>
                                        @else
                                            <button class="btn btn-sm btn-secondary" name="publisherToShop"
                                                value="1">Ajouter dans la
                                                boutique</button>
                                        @endif

                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addPersonelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('add.personnel') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un personnel</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="titre_personnel"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Libelle</label>
                        <input type="text" id="titre_personnel" name="titre_personnel" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description_personnel"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description_personnel" name="description_personnel" rows="4" required
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décrire l'événement"></textarea>
                    </div>

                    <div class="mb-1">
                        <label for="prix_personnel"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
                        <input type="number" id="prix_personnel" placeholder="0" name="prix_personnel" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    {{-- <hr class="mt-4"> --}}
                    {{-- <div class="mt-2 py-4">
                        <div class="flex gap-2 items-start ">
                            <label for="addFormation" id="labelAddFormation"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Initialiser le personnel avec une formation</label>
                            <input type="checkbox" id="addFormation" placeholder="0" name="addFormation"
                                class="block w-fit p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div id="formations" hidden>
                            <label for="type_event"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Formation</label>
                            <select type="date" id="type_event" name="type_event"
                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>-- Liste de formations --</option>
                                @foreach ($formations as $item)
                                    <option value="{{ $item->id }}">{{ $item->libelle_formation }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    {{-- <hr class="mb-2"> --}}
                    <div class="mb-1">
                        <label for="published"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publié</label>
                        <select type="date" id="published" name="published"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Publié dans la boutique --</option>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>

                    <div class=" mt-3 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image">Images</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="image_help" id="image" type="file" name="image">
                    </div>

                    <div class="mt-3 mx-auto">
                        <div id="infos"></div>
                        <button id="addInfo" class="btn btn-primary btn-sm mt-2">Ajouter une information +</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let infoCount = 0;
    
            function addInfoBlock(value = '') {
                infoCount++;
    
                const infoBlock = `
                    <div class="info-block border p-3 mb-2 bg-light" data-index="${infoCount}">
                        <div class="form-group">
                            <label for="information_${infoCount}">Information</label>
                            <input type="text" name="informations[]" class="form-control" id="information_${infoCount}" value="${value}" placeholder="Ex: Couleur: bleu" required>
                        </div>
                        <button class="btn btn-danger btn-sm mt-2 remove-info">Supprimer</button>
                    </div>
                `;
    
                $('#infos').append(infoBlock);
            }
    
            $('#addInfo').on('click', function (e) {
                e.preventDefault();
                addInfoBlock();
            });
    
            $(document).on('click', '.remove-info', function (e) {
                e.preventDefault();
                $(this).closest('.info-block').remove();
            });
    
        });
    </script>
    <script>
        const addFormation = document.getElementById('addFormation');
        addFormation.addEventListener('click', () => {
            if (addFormation.checked == true) {
                const formation = document.getElementById("formations");
                formation.hidden = false;
            } else {
                const formation = document.getElementById("formations");
                formation.hidden = true;
            }
        })
    </script>
@endsection
