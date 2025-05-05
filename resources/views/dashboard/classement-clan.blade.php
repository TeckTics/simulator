@extends('dashboard.master', ['activePage' => 'classement'])
@section('title', __('Classement'))
@section('content')
    <section class="p-4 ">
        <h3 class="mt-4 text-2xl text-[#151b28]  font-bold">Classement des alliances</h3>
        <div class="mt-4">
            <button class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white"> Classement par
                interventions</button>
            <button class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white"> Classement par Popularité</button>
            <button class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white"> Classement par Expérience</button>
            <form class="mt-2">
                @csrf
                <select name="" class="text-[#151b28] text-sm" id="">
                    <option value="">Général</option>
                    <option value="">Cette année</option>
                    <option value="">Ce mois</option>
                    <option value="">Mois précédent</option>
                    <option value="">7 derniers jours</option>
                    <option value="">30 derniers jours</option>
                    <option value="">Hier</option>
                </select>
                <button type="submit" class="text-sm px-3 py-2 bg-[#1a2539] hover:bg-[#151b28] text-white">Filtrer</button>
            </form>
        </div>
        <div class="mt-4 overflow-hidden border rounded-lg">
            <div class="relative overflow-x-auto">
                <div class="relative overflow-x-auto">
                    <table class="w-full  group text-left text-gray-600 rtl:text-right ">
                        <thead class="text-xs text-white bg-[#151b28] uppercase  ">
                            <tr>
                                <th scope="col" class=" flex items-center justify-center gap-2 font-bold py-3">
                                    Place
                                    <button class="hover:bg-white/10 rounded-md  p-1">
                                        <img width="15" height="15" src="{{ asset('/assets/icons/arrow-down.png') }}"
                                            alt="icon">
                                    </button>
                                </th>
                                <th scope="col" class=" font-bold py-3">
                                    Alliance
                                </th>
                                <th scope="col" class="  font-bold py-3">
                                    Nb Interventions
                                </th>
                                <th scope="col" class=" font-bold py-3">
                                    Réussite
                                </th>
                                <th scope="col" class="  font-bold py-3">
                                    Véhicules envoyés
                                </th>
                                <th scope="col" class="  flex items-center justify-center gap-2 font-bold py-3">
                                    Popularité
                                    <button class="hover:bg-white/10 rounded-md  p-1">
                                        <img width="15" height="15" src="{{ asset('/assets/icons/arrow-down.png') }}"
                                            alt="icon">
                                    </button>
                                </th>
                                <th scope="col" class="  font-bold  py-3">
                                    Expérience
                                    <button class="hover:bg-white/10 rounded-md  p-1">
                                        <img width="15" height="15" src="{{ asset('/assets/icons/arrow-down.png') }}"
                                            alt="icon">
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($clans as $key => $clan)
                                <tr class=" border-y text-white even:bg-[#151b28] odd:bg-[#1a2539] bg-gray-50 ">
                                    <th scope="row" class="px-6  text-xl text-white font-bold  font-medium">
                                        {{ $key + 1 }}
                                    </th>
                                    <td class="px-6 py-2">
                                        {{ $clan->nom_clan }}
                                    </td>
                                    <td class="px-6 py-2 ">
                                        {{ $clan->niveau }}
                                    </td>
                                    <td class="px-6 py-2">
                                        {{ $clan->experience }}
                                    </td>
                                    <td class="px-6 py-2 ">
                                        0
                                    </td>
                                    <td class="px-6 py-2 ">
                                        0
                                    </td>
                                    <td class="px-6 py-2  text-green-500">
                                        {{ $clan->experience }} xp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
