@extends('admin.master', ['activePage' => 'evenement'])
@section('title', __('Evenements'))
@section('content')
    <div class="container-fluid ">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Evenements</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i                                                                     class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>
        @if (session('status') && session('color'))
            <div class="alert alert-{{ session('color') }} max-w-96 text-sm ">
                {{ session('status') }}
            </div>
        @endif

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Evenements en cours</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventsNow }}</div>
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
                                    Evenements solo</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventsSolo }}</div>
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
                                    Evenements Multijoueur</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventsMulti }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Evenements non publiés</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventsNoPublished }}</div>
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
                                    Evenements publiés</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventsPublished }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->


        </div>
        <button class="btn btn-primary my-4 text-blue-500" type="button" data-toggle="modal"
            data-target="#addEventModal">Ajouter un événement</button>

        <!-- Content Row -->


        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Evenements en cours</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($eventNow as $event)
                            <h4 class="small font-weight-bold">{{ $event->nom_event }} (Fin dans
                                {{ intval(date_diff(date_create($dateNow), date_create($event->date_fin))->format('%R%a')) }}
                                Jours)
                                <span class="float-right">Joueurs
                                    participant {{ $event->count_user}}</span>
                            </h4>
                            <div class="progress my-4">
                                <div class="progress-bar" role="progressbar"
                                    style="border-radius:50px; width:  {{ intval(date_diff(date_create($dateNow), date_create($event->date_fin))->format('%R%a')) }}%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="card col-lg-12 px-1  shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Historique des evenements</h6>
                    <!-- <button class="btn btn-primary mt-4">Afficher le classement </button> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive text-sm">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="uppercase">
                                    <th>Evenement</th>
                                    <th class="uppercase">publié</th>
                                    <th>TYPE</th>
                                    <th style="text-transform: uppercase;">LANCé LE </th>
                                    <th style="text-transform: uppercase;">Fin LE</th>
                                    <th>RECOMPENSE</th>
                                    {{-- <th>NOMBRE DE PARTICIPANT</th> --}}
                                    <th>ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->nom_event }}</td>
                                        <td>
                                            @if ($event->published == 1)
                                                Publié
                                            @else
                                                non publié
                                            @endif
                                        </td>
                                        <td>{{ $event->type_event }}</td>
                                        <td>{{ $event->date_fin }}</td>
                                        <td>{{ $event->created_at }}</td>
                                        <td>{{ $event->recompense }}</td>
                                        {{-- <td>{{ $event->count_user }}</td> --}}
                                        <td>
                                            <div class="flex gap-4">
                                                {{-- <button class="btn btn-warning btn-sm edit">Modifier</button> --}}
                                                <a href="{{ url('admin/api/delete-evenement/' . $event->id) }}"
                                                    class="btn btn-danger btn-sm">Supprimer</a>
                                                <a class="btn btn-info btn-sm" href="{{ url('admin/dashboard/evenement/' . $event->id) }}" >Details</a>
                                                <!-- <button class="btn btn-danger btn-sm">C</button> -->
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
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('add.event') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un événement</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="nom_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de
                            l'événement</label>
                        <input type="text" id="nom_event" name="nom_event" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description_event"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description de
                            l'événement</label>
                        <textarea id="description_event" name="description_event" rows="4" required
                            class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Décrire l'événement"></textarea>
                    </div>
                    <div class="mb-1">
                        <label for="recompense"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recompense du ou des
                            gagnants (En pièce)</label>
                        <input type="number" id="recompense" placeholder="0" name="recompense" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="date_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                            de fin</label>
                        <input type="date" id="date_fin" placeholder="0" name="date_fin" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="type_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                            d'événement</label>
                        <select type="date" id="type_event" name="type_event"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection le type d'événement --</option>
                            <option value="solo">Solo</option>
                            <option value="multi">Multijoueur</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="published"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publié</label>
                        <select type="date" id="published" name="published"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>-- Selection le type d'événement --</option>
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
@endsection
