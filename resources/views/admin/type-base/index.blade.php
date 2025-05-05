@extends('admin.master', ['activePage' => 'type-base'])
@section('title', __('Base'))
@section('content')
    <div class="container-fluid ">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bases et types de base</h1>
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
                                    Bases</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $basesCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Types de base</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $typesBaseCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->


        </div>
        <button class="btn btn-primary my-4" data-toggle="modal" data-target="#addTypeBaseModal">Ajouter un type de
            base</button>

        <!-- Content Row -->

        <!-- Content Row -->
        <div class="row gap-4">

            <!-- Content Column -->

            <div class="card col-lg-4 px-1  shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List des Bases des Joueurs</h6>
                    <!-- <button class="btn btn-primary mt-4">Afficher le classement </button> -->
                </div>
                <div class="card-body">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        Nom Base
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">

                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bases as $base)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            Apple MacBook Pro 17"
                                        </th>
                                        <td class="px-6 py-4">
                                            Silver
                                        </td>
                                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                            Laptop
                                        </td>
                                        <td class="px-6 py-4">
                                            $2999
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="card col-lg-7 px-1  shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Base</h6>
                    <!-- <button class="btn btn-primary mt-4">Afficher le classement </button> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive text-sm">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Label</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Publié</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($typesBase as $base)
                                    <tr title="joueur bloqué">
                                        <td>{{ $base->label }}</td>
                                        <td style="overflow: hidden;">
                                            <img width="50" height="50" src="{{ asset($base->image) }}"
                                                alt="" srcset="">
                                        </td>
                                        <td>
                                            {{ $base->description }}
                                        </td>
                                        <td>{{ $base->published }}</td>
                                        <td>
                                            <div style="display: flex; gap: 4px">
                                                <button class="btn btn-warning btn-sm">Modifier</button>
                                                <button class="btn btn-danger btn-sm">Retirer</button>
                                                <button class="btn btn-info btn-sm">Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="addTypeBaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('add.typebase') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un Type de base</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="label"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Label</label>
                        <input type="text" id="label" name="label" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description du type</label>
                        <textarea id="description" name="description" rows="4" required
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décrire le type"></textarea>
                    </div>

                    <div class="mb-1">
                        <label for="published"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publié</label>
                        <select type="date" id="published" name="published"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- --</option>
                            <option value="0">Oui</option>
                            <option value="1">Non</option>
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
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
@endsection
