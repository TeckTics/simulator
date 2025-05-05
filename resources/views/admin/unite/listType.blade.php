@extends('admin.master', ['activePage' => 'unite'])
@section('title', __('Formations'))
@section('content')
    <div class="container-fluid ">
        <div class="my-4">
            <a href="{{ url('admin/dashboard/unites') }}"
                class=" text-primary  border-t-2 text-sm p-2 bg-gray-200 rounded-t-md ">unités</a>
            <a href="#" class="text-white text-sm bg-primary border-t-2 p-2 rounded-t-md ">types
                d'unité</a>
        </div>
        <div>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Types d'unité ({{ $typeUniteCount }})</h1>
            </div>
            <button data-toggle="modal" data-target="#addUniteModal" class="text-sm btn btn-primary">Nouveau type</button>
            <div class="row p-2 gap-2">
                @foreach ($typeUnites as $typeUnite)
                    <div id="{{$typeUnite->id}}"
                        class="max-w-96 w-full  p-6 bg-white  border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="pb-4">
                            <img src="{{ asset($typeUnite->image) }}" width="24" height="24" alt=""
                                srcset="">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ $typeUnite->nom_type_unite }}</h5>
                            <p class="mb-3 font-normal h-40 overflow-hidden bg-gray-50 p-2 text-gray-500 dark:text-gray-400">
                                {{ $typeUnite->description_type_unite }}</p>
                            <a href="{{ url('admin/api/delete-type-unite/' . $typeUnite->id) }}"
                                class="btn btn-danger btn-sm">
                                <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffffff"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="#ffffff"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="#ffffff" />
                                </svg>
                            </a>
                            <button name="expend-type-unite-card-{{ $typeUnite->id }}" class="btn btn-warning show-type-unite-card btn-sm"><svg
                                    class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffffff"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="#ffffff"
                                        d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                        clip-rule="#ffffff" />
                                    <path fill-rule="#ffffff"
                                        d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                        clip-rule="#ffffff" />
                                </svg>
                            </button>
                        </div>
                        <form enctype="multipart/form-data" hidden id="expend-type-unite-card-{{ $typeUnite->id }}"
                            class="border-t expend-type-unite-card" method="POST" action="{{ route('edit.typeUnite') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editer</h5>
                                <button class="close-type-unite-card" type="button" >
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="number" hidden id="id" name="id" value="{{ $typeUnite->id }}">
                                <div class="mb-1">
                                    <label for="nom_type_unite"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                                    <input type="text" id="nom_type_unite" name="nom_type_unite"
                                        value="{{ $typeUnite->nom_type_unite }}"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="mb-1">
                                    <label for="description_type_unite"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description_type_unite" name="description_type_unite"
                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $typeUnite->description_type_unite }}</textarea>
                                </div>
                                <div class=" mt-3 mx-auto">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="image">Icone</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="image_help" id="image" type="file" name="image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-warning btn-sm text-yellow-500" type="submit">Modifier</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
            <!-- Content Row -->

        </div>
    </div>
    <div class="modal fade" id="addUniteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" enctype="multipart/form-data" method="POST" action="{{ route('add.typeUnite') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau Type d'unité</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="nom_type_unite"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" id="nom_type_unite" name="nom_type_unite" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-1">
                        <label for="description_type_unite"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description_type_unite" name="description_type_unite" required
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <div class=" mt-3 mx-auto">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="image">Icone</label>
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
