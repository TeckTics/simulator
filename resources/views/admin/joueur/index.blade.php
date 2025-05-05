@extends('admin.master', ['activePage' => 'joueur'])
@section('title', __('Joueurs'))
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="text-xs">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a> \ <a
                href="{{ url('/admin/dashboard/joueurs') }}">Joueurs</a>
        </div>
        <h1 class="h3 my-3 text-gray-800">Joueurs</h1>
        <!-- DataTales Example -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nouveaux Joueurs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <span class="text-sm ">Cette semaine</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Joueurs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        {{-- <span class="text-sm ">Cette semaine</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Joueurs Bannis</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersBlockedCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-danger"></i>
                            </div>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#usersBannisModal"
                            class="btn btn-danger btn-sm ">Lister</a>
                        {{-- <span class="text-sm ">Cette semaine</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Joueurs en ligne</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersOnline }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                        </div>
                        {{-- <span class="text-sm ">Cette semaine</span> --}}
                        <a href="" class="btn btn-success btn-sm ">Lister</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste de Joueurs</h6>
                <a href="{{ url('/admin/dashboard/joueurs-classement') }}" class="btn btn-primary mt-4">Afficher le
                    classement</a href="">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 " id="dataTable" width="100%"
                        cellspacing="0">
                        <thead class="text-xs text-gray-700  border-b uppercase bg-gray-50 ">
                            <tr class="text-sm">
                                <th scope="col" class="p-4">Pseudo</th>
                                <th>Date d'inscription</th>
                                <th>Niveau</th>
                                <th>Experience</th>
                                <th>Argent</th>
                                <th>En ligne</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ($users as $user)
                                <tr class="bg-white border-b  hover:bg-gray-50 ">
                                    <td scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-10 h-10 rounded-full"
                                            src="{{ $user->profile !== '' ? asset('assets/icons/user.svg') : $user->profile }}"
                                            alt="Jese image">
                                        <div class="ps-3">
                                            <div
                                                class="text-base font-semibold {{ $user->isblocked == 0 ? '' : 'text-red-500' }}">
                                                {{ $user->pseudo }}</div>
                                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </td>
                                    <td> {{ $user->created_at }}</td>
                                    <td>{{ $user->niveau + 1 }}</td>
                                    <td>{{ $user->experience }}</td>
                                    <td>
                                        <div class="flex items-center text-green-500 font-bold">
                                            {{ $user->argent }}
                                            <img src="{{ asset('assets/images/icons8-money-48.png') }}" width="25"
                                                height="25" alt="" srcset="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            @if ($user->online == 1)
                                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> En ligne
                                            @else
                                                <div class="h-2.5 w-2.5 rounded-full bg-stone-500 me-2"></div> Hors ligne
                                            @endif
                                        </div>
                                    </td>
                                    <td class="flex flex-col gap-1 items-start justify-start">
                                        <form action="{{ route('banned.user') }}" method="post">
                                            @csrf
                                            @if ($user->isblocked == 1)
                                                <button value="{{ $user->id }}" name="id" type="submit"
                                                    class="btn btn-warning text-yellow-500 btn-sm">Bannir</button>
                                            @else
                                                <button value="{{ $user->id }}" name="id" type="submit"
                                                    class="btn btn-success text-green-500 btn-sm">Accepter</button>
                                            @endif
                                        </form>
                                        <a href="{{ url('/admin/dashboard/joueur/' . $user->id) }}"
                                            class="btn w-fit btn-info btn-sm">Voir le profil</a>
                                        <button class="btn w-fit btn-info btn-sm">Voir ces statistiques</button>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                        <td>
                                            <button class="btn btn-success btn-sm">Accepter</button>
                                            <button class="btn btn-info btn-sm">Voir ces statistiques</button>
                                        </td>
                                    </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="usersBannisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quitter le dashboard</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 " id="dataTable" width="100%"
                        cellspacing="0">
                        <thead class="text-xs border text-gray-700  border-b uppercase bg-gray-50 ">
                            <tr class="text-sm">
                                <th scope="col">Pseudo</th>
                                <th>Email</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach ($usersBanned as $user)
                                <tr class="bg-white border  hover:bg-gray-50 ">
                                    <td scope="row" class="text-gray-900   border whitespace-nowrap dark:text-white">
                                        <div class="flex gap-1 justify-center items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                            {{ $user->pseudo }}
                                        </div>
                                    </td>
                                    <td class="font-normal text-center border text-gray-500">{{ $user->email }}</td>

                                    <td>

                                        <button class=" w-fit text-info ">Voir le profil</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                paging: true,
                scrollY: 400,
                select: true,
            });
        });
    </script>
@endsection
