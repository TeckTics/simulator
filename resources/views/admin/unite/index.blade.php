@extends('admin.master', ['activePage' => 'unite'])
@section('title', __('Formations'))
@section('content')
    <div class="container-fluid ">
        <div>
            <button class="text-white text-sm bg-primary border-t-2 p-2 rounded-t-md my-4">unités</button>
            <a href="{{ url('admin/dashboard/type-unite') }}"
                class="text-primary border-t-2 text-sm p-2 bg-gray-200 rounded-t-md my-4">types
                d'unité</a>
        </div>
        <div>

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Unités</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                                                                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>



            <!-- Content Row -->
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total unite</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $unitesCount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Unites disponible en boutique</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button data-toggle="modal" data-target="#addUniteModal" class="text-sm btn btn-primary">Ajouter une
                unité</button>
            <div class="row p-2 gap-2">
                @foreach ($unites as $unite)
                    <div
                        class="max-w-96 relative  col-lg-3 bg-white border-2 border-blue-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="py-2">
                            <div class="flex justify-center">
                                <img class="rounded-t-lg h-[150px] w-[auto]" src="{{ asset($unite->image) }}" class="w-full"
                                    alt="" />
                            </div>
                        </div>
                        <div>
                            <img class="rounded-md border p-2 absolute bottom-2 right-2 size-10 bg-black/30"
                                src="{{ asset($unite->icon) }}" class="w-full" width="24" alt="" />
                        </div>
                        
                        <div class="p-4 border-t">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $unite->nom_unite }}
                            </h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $unite->description_type_unite }}</p>
                            <h6
                                class="mb-3 font-normal text-gray-700 dark:text-gray-400 font-semibold flex items-center gap-2">
                                {{ $unite->prix_unite }} <img width="24" height="24"
                                    src="{{ url('assets/images/icons8-money-48.png') }}" alt="" srcset=""></h6>
                            <a href="#"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Details
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                            <a href="{{ url('admin/api/delete-unite/' . $unite->id) }}" class="btn btn-danger text-sm">
                                supprimer
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- Content Row -->

        </div>
    </div>
    <div class="modal fade" id="addUniteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('add.unite') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une unité</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="nom_unite"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" id="nom_unite" name="nom_unite" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="vitesse_unite"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vitesse de base
                            (km/h)</label>
                        <input type="number" id="vitesse_unite" name="vitesse_unite" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="capacite_unite"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de place
                            disponible</label>
                        <input type="number" id="capacite_unite" name="capacite_unite" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="prix_unite"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
                        <input type="number" id="prix_unite" name="prix_unite" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="taux_usure" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Taux
                            d'usure (en pourcentage)</label>
                        <input type="number" id="taux_usure" name="taux_usure" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="type_unite_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                            d'unité</label>
                        <select type="date" id="type_unite_id" name="type_unite_id" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection le type d'unité --</option>
                            @foreach ($typeUnites as $typeUnite)
                                <option value="{{ $typeUnite->id }}">{{ $typeUnite->nom_type_unite }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" mt-3 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image">Miniature</label>
                        <input required
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
