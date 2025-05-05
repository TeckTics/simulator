@extends('admin.master', ['activePage' => 'joueur'])
@section('title', __('Joueurs'))
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="text-xs">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a> \ <a
                href="{{ url('/admin/dashboard/joueurs') }}">Joueurs</a> \ <a href="#"
                class="text-primary font-semibold">Joueur({{ $user->pseudo }})</a>
        </div>
        <h1 class="h3 my-4 text-gray-800">Détails sur {{ $user->pseudo }}</h1>

        <div class="row gap-6">
            <div class="card col-xl-5 col-md-12 shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informationns sur le joueur</h6>
                    {{-- <a href="{{ url('/admin/dashboard/joueurs-classement') }}" class="btn btn-primary mt-4">Afficher le
                        classement</a href=""> --}}
                </div>
                <div class="card-body">
                    <div class="size-16 bg-stone-100"
                        style="background-image: url('{{ $user->profile !== '' ? asset('assets/icons/user.svg') : $user->profile }}') ">

                    </div>
                    <h2 class="my-2 font-bold">{{ $user->pseudo }} ({{ $user->nom }} {{ $user->prenom }})</h2>
                    <h2>{{ $user->email }}</h2>
                    <div>Niveau: {{ $user->niveau }}
                    </div>
                    <div>
                        Experience: {{ $user->experience }}xp</div>
                    <div> 
                        Argent: {{ $user->argent }}
                    </div>
                    <div>
                        Performance: {{ $user->perfomance }}</div>
                
                </div>
            </div>
            <div class="card col-xl-6 col-md-12  mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste de Joueurs</h6>
                    <a href="{{ url('/admin/dashboard/joueurs-classement') }}" class="btn btn-primary mt-4">Afficher le
                        classement</a href="">
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                    </div>
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
