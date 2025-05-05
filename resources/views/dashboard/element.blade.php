@extends('dashboard.master', ['activePage' => 'element'])
@section('title', __('Equipements et éléments'))
@section('content')
    <div class="container">
        <div class="" class="relative overflow-hidden">
            <div class="relative z-10 p-2">
                <h3 class="mt-4 text-xl text-[#151b28]  font-bold">Mes unités</h3>
                <div class="mt-2 grid grid-cols-8 gap-4">
                    @foreach ($unites as $unite)
                        <a href="{{ url('/dashboard/elements/unite/' . $unite->id) }}" class="hover:no-underline">
                            <div
                                class="w-full col-span-2 border-4  border-[#151b28] relative  h-fit text-sm relative  w-96 bg-white rounded-2xl shadow ">
                                <img class=" py-2 w-full rounded-2xl" width="300" height="300"
                                    src="{{ asset($unite->image) }}" alt="product image" />

                                <div class="px-2 py-2 bg-[#151b28] text-white">
                                    <h5 style="font-family: cursive;"
                                        class="text-sm  text-center  font-bold text-white tracking-tight ">
                                        {{ $unite->nom }}</h5>
                                    <div class="flex w-full justify-between  gap-2 items-center ">
                                        <div class="flex gap-2 items-center">
                                            <img class="rounded-md absolute top-1 left-1 border p-1 size-6 bg-white"
                                                title="{{ $unite->nom_type_unite }}" src="{{ asset($unite->icon) }}"
                                                class="w-full" width="24" alt="" />
                                            {{-- <span class="text-white text-xs">{{ $unite->nom_type_unite }}</span> --}}
                                        </div>
                                        {{-- <div title="Quantité"
                                            class="rounded-md border bg-gradient-to-tr bg-blue-500 from-blue-700 p-2 size-6 shadow-md  text-white flex justify-center items-center font-bold ">
                                            {{ $unite->quantity }}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="" class="relative overflow-hidden">
            <div class="relative z-10 p-2">
                <h3 class="mt-4 text-xl text-[#151b28]  font-bold">Mon personnel</h3>
                <div class="mt-2 grid grid-cols-5 gap-4">
                    @foreach ($personnels as $personnel)
                        <a href="{{ url('/dashboard/elements/personnel/' . $personnel->id) }}" class="hover:no-underline">
                            <div
                                class="w-full col-span-2 border-4 bg-[#151b28]  border-[#151b28] violet-500 relative  h-fit text-sm relative  w-96  rounded-2xl shadow ">
                                <img class=" h-full w-full    rounded-2xl" width="300" height="300"
                                    src="{{ asset($personnel->image) }}" alt="product image" />

                                <div class="px-2 py-2   text-white">
                                    <h5 style="font-family: cursive;"
                                        class="text-sm  text-center  font-bold text-white tracking-tight ">
                                        {{ $personnel->titre_personnel }}</h5>
                                </div>
                                <div data-popover-target="popover-quantite"
                                    class="bg-white w-fit h-fit absolute size-5 px-3 font-bold text-xl shadow-2xl shadow-black p-2 rounded-2xl text-stone-700 top-2 left-2 ">
                                    {{ $personnel->quantite_personnel }}</div>
                                <div data-popover-target="popover-niveau" title="Niveau {{ $personnel->niveau }}"
                                    class="bg-orange-600 bg-gradient-to-tr from-yellow-500 w-fit h-fit absolute size-5 px-3 font-bold text-lg shadow-2xl shadow-black p-2 rounded-2xl text-stone-100 top-2 right-2 ">
                                    Niv {{ $personnel->niveau }}</div>
                                <div data-popover id="popover-quantite" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 ">
                                    <div class="px-3 py-2 bg-gray-100 border-b text-center border-gray-200 rounded-t-lg">
                                        <h3 class="font-semibold text-gray-900 ">Vous possedez
                                            {{ $personnel->quantite_personnel }} personnels
                                            {{ $personnel->titre_personnel }}(s)</h3>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                                <div data-popover id="popover-niveau" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 ">
                                    <div class="px-3 py-2 bg-gray-100 border-b text-center border-gray-200 rounded-t-lg">
                                        <h3 class="font-semibold text-gray-900 "> {{ $personnel->titre_personnel }} de
                                            niveau {{ $personnel->niveau }}</h3>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
