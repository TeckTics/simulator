@extends('dashboard.master', ['activePage' => 'statistique'])
@section('title', __('Classement'))
@section('content')
    <div>
        <div class="p-4 bg-stone-50 from-purple-100 bg-gradient-to-t">
            <h2 class="text-3xl font-bold ">Mes Statistiques</h2>

            <p>
                Mes statistiques sur
            </p>
            <div class="flex gap-2 mt-2">
                <button class="p-1 px-2 font-semibold rounded-md hover:bg-black/30 bg-black/20">le
                    mois</button>
                <button class="p-1 px-2 font-semibold rounded-md hover:bg-black/30 bg-black/20">la
                    semaine</button>
            </div>
            <div class="mt-4">
                <table class="w-full text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Statistiques sur mes missions
                            </th>
                            <th scope="col" class="px-6 py-3">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Missions en cours
                            </th>
                            <td class="px-6 py-4 text-blue-500">
                                3
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Nombre de missions éffectuées
                            </th>
                            <td class="px-6 py-4">
                                0
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Nombre de missions ratées
                            </th>
                            <td class="px-6 py-4 text-red-500">
                                10
                            </td>
                        </tr>

                    </tbody>
                </table>
                <table class="w-full mt-1 text-sm text-left text-gray-500 border rtl:text-right dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Unités
                            </th>
                            <td class="px-6 py-4 text-blue-500">
                                Nombre de personnels affectés
                            </td>
                            <td class="px-6 py-4 text-blue-500">
                                Nombre d'interventions
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                CT500
                            </th>
                            <td class="px-6 py-4 text-blue-500">
                                10
                            </td>
                            <td class="px-6 py-4 text-blue-500">
                                2
                            </td>

                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                CT500
                            </th>
                            <td class="px-6 py-4 text-blue-500">
                                10
                            </td>
                            <td class="px-6 py-4 text-blue-500">
                                2
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                CT500
                            </th>
                            <td class="px-6 py-4 text-blue-500">
                                10
                            </td>
                            <td class="px-6 py-4 text-blue-500">
                                2
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
