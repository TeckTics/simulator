@extends('admin.master', ['activePage' => 'hopital'])
@section('title', __('Hopitaux'))
@section('content')
<div class="container-fluid ">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hôpitaux</h1>
    </div>
    <button class="btn btn-primary my-4">Ajouter une hôpital</button>
    <div class="row">
        <div class="card col-lg-12 px-1  shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Historique des evenements</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NOM</th>
                                <th>CAPACITE MAX</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr title="joueur bloqué">
                                <td>Evenements 1</td>
                                <td style="overflow: hidden;">100 personnes</td>
                               
                           
                                <td style="display: flex; gap: 4px">
                                    <button class="btn btn-primary btn-sm">Representer sur la carte</button>
                                    <button class="btn btn-warning btn-sm">Modifier</button>
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                    <button class="btn btn-info btn-sm">Details</button>
                                    <!-- <button class="btn btn-danger btn-sm">C</button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection