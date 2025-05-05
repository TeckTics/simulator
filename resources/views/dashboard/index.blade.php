<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UrgenceSAMU</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script> --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    ::-webkit-scrollbar {
        width: 4px;
        height: 3px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* <uniquifier>: Use a unique and descriptive class name */
    /* <weight>: Use a value from 100 to 900 */

    .inter-<uniquifier> {
        font-family: "Inter", serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }

    .plus-jakarta-sans-<uniquifier> {
        font-family: "Plus Jakarta Sans", serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }

    * {
        font-family: "Inter"
    }

    .panel-size {
        max-width: 64rem;
        border-radius: 1rem;
        background-color: #14264b;
        max-height: 70vh;
        overflow-x: hidden;
        height: 100%;
        overflow-y: auto;
        width: 100%;
        position: relative;
    }

    @media not all and (min-width: 640px) {
        .panel-size {
            max-height: 90vh;
            overflow-y: auto;
            color: #fff1ccbf;
        }
    }

    @keyframes pulsate {
        0% {
            /* transform: scale(1); */
            fill: #fff1cce2;
        }

        50% {
            /* transform: scale(1.2); */
            fill: #ffcc00;
        }

        70% {
            /* transform: scale(1); */
            fill: #fcffcce2;
        }

        100% {
            /* transform: scale(1); */
            fill: #fff1cce2;
        }
    }
    </style>

<body>
    <header class=" fixed z-40 w-full top-0 left-0  bg-[#151b28] py-3.5 shadow flex justify-between px-8 items-center">
        <button id="playButton" class="hidden">Play Audio</button>
        <div class="relative flex items-center gap-4">
            <img src="{{ asset('assets/images/Urgence.png') }}" width="100px" class="rounded-full"
                alt="UrgenceSamu logo" />
            <button type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                aria-controls="drawer-example">
                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="#fff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>
            </button>
            <!-- drawer component -->
            <div id="drawer-example"
                class="fixed top-0 left-0 z-30 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-[#151b28] w-80 "
                tabindex="-1" aria-labelledby="drawer-label">
                <h5 id="drawer-label" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">Menu
                </h5>
                <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                    name="stat-panel"
                    class="text-gray-400 bg-transparent  rounded-lg text-sm absolute top-2.5 end-2.5 inline-flex items-center justify-center hover:bg-gray-600 hover:text-white">
                    <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                        srcset="">
                    <span class="hidden">Close</span>
                </button>
                @include('dashboard.layout.layout-menu-mobile')
            </div>
            <div class="block text-center lg:hidden">
                <button class="fixed p-3 bg-white rounded-full right-5 bottom-5 " type="button"
                    data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                    data-drawer-placement="right" aria-controls="drawer-right-example">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.5"
                                d="M12 23C18.0751 23 23 18.0751 23 12C23 5.92487 18.0751 1 12 1C5.92487 1 1 5.92487 1 12C1 13.7596 1.41318 15.4228 2.14781 16.8977C2.34303 17.2897 2.40801 17.7377 2.29483 18.1607L1.63966 20.6093C1.35525 21.6723 2.32772 22.6447 3.39068 22.3603L5.83932 21.7052C6.26233 21.592 6.71033 21.657 7.10228 21.8522C8.5772 22.5868 10.2404 23 12 23Z"
                                fill="#1C274C"></path>
                            <path
                                d="M10.9 12.0004C10.9 12.6079 11.3925 13.1004 12 13.1004C12.6075 13.1004 13.1 12.6079 13.1 12.0004C13.1 11.3929 12.6075 10.9004 12 10.9004C11.3925 10.9004 10.9 11.3929 10.9 12.0004Z"
                                fill="#1C274C"></path>
                            <path
                                d="M6.5 12.0004C6.5 12.6079 6.99249 13.1004 7.6 13.1004C8.20751 13.1004 8.7 12.6079 8.7 12.0004C8.7 11.3929 8.20751 10.9004 7.6 10.9004C6.99249 10.9004 6.5 11.3929 6.5 12.0004Z"
                                fill="#1C274C"></path>
                            <path
                                d="M15.3 12.0004C15.3 12.6079 15.7925 13.1004 16.4 13.1004C17.0075 13.1004 17.5 12.6079 17.5 12.0004C17.5 11.3929 17.0075 10.9004 16.4 10.9004C15.7925 10.9004 15.3 11.3929 15.3 12.0004Z"
                                fill="#1C274C"></path>
                        </g>
                    </svg>
                </button>
            </div>
            <!-- drawer component -->
            <div id="drawer-right-example"
                class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full  w-80 bg-gray-800"
                tabindex="-1" aria-labelledby="drawer-right-label">
                <h5 id="drawer-right-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">Chat
                </h5>
                <div class=" relative w-full p-2 overflow-hidden  justify-center items-center  md:inset-0 ">

                    <div class="relative  rounded-sm ">
                        <div class="p-4 md:p-5 ">
                            <h3 class=" font-semibold text-center text-white uppercase ">
                                Chattez avec l'alliance <span id="title-chat"></span>
                            </h3>
                        </div>
                        <div class="  rounded-sm">
                            <div id="messagesContainer2" style="max-height: 500px"
                                class="body-message  p-2 overflow-y-auto rounded-md  bg-[#1a2539] text-white ">
                                <div class="chat-messages  text-[#1a2539] gap-2 min-h-screen flex flex-col "
                                    id="MessageSentContent2">

                                </div>
                            </div>
                            <div id="messagesContainer2-alliance" style="max-height: 500px"
                                class="body-message  p-2 overflow-y-auto rounded-md  bg-[#1a2539] text-white ">
                                <div class="chat-messages  text-[#1a2539] gap-2 min-h-screen flex flex-col "
                                    id="MessageSentContent2-alliance">

                                </div>
                            </div>
                            <div class="footer-messager  mt-4">
                                <form class="flex flex-col" id="chat-form2" method="post">
                                    @csrf
                                    <textarea type="text" name="content" required id="message-input2" class="form-control rounded-md text-xs"
                                        placeholder="Votre message"></textarea>
                                    {{-- 
                                    <button id="chat-message-submit" type="submit"
                                        class="btn  p-2  text-white transition-all items-center border-white border-2 flex flex-row gap-2  text-sm justify-center from-blue-700 bg-gradient-to-t rounded-lg w-full mt-2 hover:bg-blue-600 bg-blue-500 font-semibold ">
                                        <span>Envoyer</span></button> --}}
                                    <button name="base-list" id="button-chat2"
                                        class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-white hover:bg-[#15244c]  hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white  text-center text-sm transition-all cursor-pointer">
                                        <span>Envoyer</span>
                                    </button>
                                </form>
                                <form class="flex flex-col" id="chat-form-alliance2" method="post">
                                    @csrf
                                    <textarea type="text" name="content" required id="message-input-alliance2"
                                        class="form-control rounded-md text-xs" placeholder="Votre message"></textarea>
                                    {{-- 
                                    <button id="chat-message-submit" type="submit"
                                        class="btn  p-2  text-white transition-all items-center border-white border-2 flex flex-row gap-2  text-sm justify-center from-blue-700 bg-gradient-to-t rounded-lg w-full mt-2 hover:bg-blue-600 bg-blue-500 font-semibold ">
                                        <span>Envoyer</span></button> --}}
                                    <button name="base-list" id="button-chat-alliance2"
                                        class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-white hover:bg-[#15244c]  hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white  text-center text-sm transition-all cursor-pointer">
                                        <span>Envoyer</span>
                                    </button>
                                </form>
                                <button name="base-list" id="view-chat-alliance2"
                                    class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-orange-500 hover:bg-white  hover:fill-blue-500 flex items-center h-full text-white font-bold hover:text-orange-500  text-center text-sm transition-all cursor-pointer">
                                    <span>Chatter avec alliance</span><span id="clan-name-chat"></span>
                                </button>
                                <button name="base-list" id="view-chat-generale2"
                                    class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-[#15244c] hover:bg-white  hover:fill-blue-500 flex items-center h-full text-white font-bold hover:text-[#15244c]  text-center text-sm transition-all cursor-pointer">
                                    <span>Chat Générale</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
                    name="stat-panel"
                    class="text-gray-400 bg-transparent  rounded-lg text-sm absolute top-2.5 end-2.5 inline-flex items-center justify-center hover:bg-gray-600 hover:text-white">
                    <img src="{{ asset('assets/images/icons8-close-48.png') }}" class="size-8" alt=""
                        srcset="">
                    <span class="hidden">Close</span>
                </button>

            </div>
        </div>
        <div id="info-user" class="relative items-center hidden gap-2 md:flex">
            <div>
                <span class="text-white" id="date-now"></span>
            </div>
            {{-- <div id="view-clan-name"
                class="flex items-center border-r-4 border-r-black bg-white text-[#151b28] p-2 px-3 gap-4  ">
                <img title="Alliance de niveau 5" src="{{ asset('assets/images/image1_0 (15).png') }}" width="25px"
                    height="25px" alt="">
                <span class="text-[#151b28] font-bold" id="user-clan-name"></span>
            </div> --}}
            <div class="flex items-center bg-[#051129b3] p-2 px-3 gap-4  ">
                <svg width="25px" height="25px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                    fill="#fff  ">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill="#fff"
                            d="M256 29.816l-231 154v106.368l231-154 231 154V183.816zm0 128.043L105 259.783v90.283l151-101.925 151 101.925v-90.283zm0 112l-87 58.725v67.6l87-58 87 58v-67.6zm0 89.957l-87 58v64.368l87-58 87 58v-64.368z">
                        </path>
                    </g>
                </svg>
                <span class="text-white" id="user-experience"></span>
            </div>
            <div class="flex items-center bg-[#051129b3] p-2 px-3 gap-4  ">
                <img width="24" height="24" src="{{ asset('assets/images/icons8-money-48.png') }}"
                    alt="" />
                <span class="font-bold text-yellow-500" id="user-argent"></span>
            </div>
            <div id="remove-money-animate" class="absolute text-2xl font-bold text-yellow-500 right-3 top-10">
            </div>
        </div>
    </header>
    <div class="grid grid-cols-12 min-h-screen bg-cover relative bg-[#262b34]">
        <div class="absolute z-0 w-full h-full bg-cover opacity-60 "
            style="background-image: url('{{ asset('assets/images/SAMU_intervention_scene.png') }}')"></div>
        {{-- <div
            class="col-span-2 relative  pt-20 hidden 2xl:flex justify-evenly gap-4 items-center flex-col overflow-hidden pb-10 bg-[#262b34] h-full">
            @include('dashboard.layout.layout-menu-mobile')
        </div> --}}

        <div class="relative col-span-12 p-4 pt-20 overflow-x-hidden overflow-y-auto lg:col-span-10 2xl:col-span-10">

            <button id="show-panel-option" class="bg-[#151b28] sm:hidden block rounded-full mb-2 p-2">
                <svg fill="#fff" width="25px" height="25px" viewBox="-8.5 0 32 32" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>angle-down</title>
                        <path
                            d="M7.28 20.040c-0.24 0-0.44-0.080-0.6-0.24l-6.44-6.44c-0.32-0.32-0.32-0.84 0-1.2 0.32-0.32 0.84-0.32 1.2 0l5.84 5.84 5.84-5.84c0.32-0.32 0.84-0.32 1.2 0 0.32 0.32 0.32 0.84 0 1.2l-6.44 6.44c-0.16 0.16-0.4 0.24-0.6 0.24z">
                        </path>
                    </g>
                </svg>
            </button>

            <div id="panel-option" class="bg-[#151b28] flex-col ass hidden rounded-lg">
                <button name="base-form-create-layout" id="add-marker-base"
                    class="flex w-full gap-2 p-2 py-3 text-sm text-white border-b show-modal">
                    <span>Nouvelle base</span>
                    <div class="flex items-center "> <span class="font-bold text-yellow-500">150000</span>
                        <img width="24" height="24" src="{{ asset('assets/images/icons8-money-48.png') }}"
                            alt="" />
                    </div>
                </button>
                <button name="base-list-panel"
                    class="w-full gap-2 p-2 py-3 text-sm text-left text-white border-b show-modal botf">
                    <span>Afficher mes bases</span>
                </button>
                <button name="stat-panel"
                    class="w-full gap-2 p-2 py-3 text-sm text-left text-white border-b show-modal">
                    <span> mes statistiques</span>
                </button>

                <button name="garage-panel" class="w-full gap-2 p-2 py-3 text-sm text-left text-white show-modal ">
                    <span>Garage</span>
                </button>
            </div>
            <div class="hidden overflow-x-auto hiddenElementBase sm:block">
                <div class=" flex  flex-row justify-between gap-2 w-[500px] sm:w-full">
                    <div class="block w-full gap-2 sm:inline-flex">
                        <button name="base-form-create-layout" id="add-marker-base"
                            class=" gap-2 max-sm:text-xs p-4 show-modal fill-white bg-[#151b28] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white  text-left text-sm transition-all rounded-md cursor-pointer">
                            <span>Nouvelle base</span>
                            <div class="flex items-center "> <span class="font-bold text-yellow-500">150000</span>
                                <img width="24" height="24"
                                    src="{{ asset('assets/images/icons8-money-48.png') }}" alt="" />
                            </div>
                        </button>
                        <button name="base-list-panel"
                            class=" gap-2 show-modal p-4 fill-white bg-[#151b28] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white  text-left text-sm transition-all rounded-md cursor-pointer">
                            <span>Afficher mes bases</span>
                        </button>
                        <button name="stat-panel"
                            class=" gap-2 show-modal p-4 fill-white bg-[#151b28] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white  text-left text-sm transition-all rounded-md cursor-pointer">
                            <span> mes statistiques</span>
                        </button>
                    </div>
                    <div class="inline-flex gap-2 ">
                        <button name="garage-panel"
                            class=" gap-2 p-4 show-modal fill-white bg-white hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white  text-left text-sm transition-all rounded-md cursor-pointer">
                            <span>Garage</span>
                        </button>
                    </div>
                </div>
            </div>
            {{-- <audio id="audio" muted src="{{ asset('assets/son/p_33009051_98.mp3') }}" hidden></audio> --}}
            <div class="flex items-start gap-2">
                <x-mission-form-panel />
                {{-- <iframe id="first-base" frameborder="0" style="z-index: 1004" class="fixed top-0 left-0 hidden w-full h-full"
                    src="{{ url('/dashboard/api/first-base-form') }}"></iframe> --}}
                <div class="w-full">
                    <div class="w-full mt-3 mb-3 hiddenElementBase">
                        <p id="message-mission-information" class="col-span-full"> </p>
                        <div id="alert-mission">

                        </div>
                    </div>
                    @include('dashboard.layout.layout-game-part')
                </div>
            </div>
            <div id="mission-panel-content" class="grid gap-4 sm:grid-cols-2 grid-cols-1 mt-2">

            </div>
        </div>
        <div class=" col-span-2  2xl:col-span-2 lg:block hidden relative pt-20 bg-[#151b28] ">
            @include('dashboard.layout.layout-chat-panel')
        </div>
    </div>
    <div id="loading" class="bg-[#151b28] w-full fixed flex items-center justify-center z-50 h-full top-0 left-0">
        <img src="{{ asset('assets/images/Urgence.png') }}" width="400px" class="rounded-full animate-pulse"
            alt="UrgenceSamu logo" />
    </div>
    <div class="relative">
        <x-shop-panel />
        <x-alliance-panel :belongsToAlliance="$belongsToAlliance" />
        <x-classement-panel />
        <x-stats-panel />
        <x-equipement-panel />
        <x-personnel-panel />
        <x-base-form :isEditedForm="true" />
        <x-base-details />
        <x-base-list />
        <x-setting-panel />
        <x-profil-panel :user='$user' />

        <x-garage-panel />
    </div>
    @include('dashboard.layout.cookie-panel')
    <div id="daily-gain" class="fixed top-0 left-0 z-30 items-center justify-center w-full h-full bg-black/50">
        <div class="flex items-center justify-center w-full h-full">
            <form id="accept-daily-gain"
                class="relative w-full  bg-[#14264b] text-center p-5 text-white rounded-2xl  max-w-md">
                <h3 class="text-2xl font-bold text-center">Récompense journalière</h3>
                <button name="add-base" id="add-base-map"
                    class=" gap-2 max-sm:text-xs mx-auto mt-8 hover:ring-2 p-4 fill-white bg-[#151b28] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white  text-left text-sm transition-all rounded-md cursor-pointer">
                    <span>Prendre</span>
                    <div class="flex items-center "> <span class="font-bold text-yellow-500">500</span>
                        <img width="24" height="24" src="{{ asset('assets/images/icons8-money-48.png') }}"
                            alt="" />
                    </div>
                </button>

            </form>
        </div>
    </div>
    <div id="confirm-action-panel" style="z-index: 102"
        class="fixed top-0 left-0 items-center justify-center w-full h-full bg-black/50">
        <div class="flex items-center justify-center w-full h-full">
            <div class="relative w-full  bg-[#14264b] text-center p-5 text-white rounded-2xl  max-w-md">
                <h3 class="text-xl font-bold text-center" id="message-confirm-action-panel"></h3>
                <div class="flex flex-row items-center justify-center gap-2 mt-8">
                    <button id="accept-button-confirm-action-panel"
                        class=" gap-2 max-sm:text-xs  hover:ring-2 p-4 fill-white bg-[#151b28] hover:bg-[#15244c] w-fit hover:fill-blue-500 flex items-center h-full text-white/70 hover:text-white  text-left text-sm transition-all rounded-md cursor-pointer">
                        <span>Confirmer</span>
                    </button>
                    <button name="confirm-action-panel" id="declined-button-confirm-action-panel"
                        class="flex items-center h-full gap-2 p-4 text-sm text-left transition-all bg-red-500 rounded-sm cursor-pointer max-sm:text-xs hover:ring-2 fill-white hover:bg-red-00 w-fit hover:fill-blue-500 text-white/70 hover:text-white">
                        <span>Annuler</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="loader" class="fixed top-0 left-0 z-50 items-center justify-center hidden w-full h-full bg-black/50">
        <div class="flex items-center justify-center max-w-xl min-h-screen mx-auto">
            <svg fill="#ffffff" class="animate-spin" width="64px" height="64px" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <circle cx="12" cy="20" r="2"></circle>
                    <circle cx="12" cy="4" r="2"></circle>
                    <circle cx="6.343" cy="17.657" r="2"></circle>
                    <circle cx="17.657" cy="6.343" r="2"></circle>
                    <circle cx="4" cy="12" r="2.001"></circle>
                    <circle cx="20" cy="12" r="2"></circle>
                    <circle cx="6.343" cy="6.344" r="2"></circle>
                    <circle cx="17.657" cy="17.658" r="2"></circle>
                </g>
            </svg>
        </div>
    </div>

    <!-- Modale Bootstrap -->
    <div class="modal fade" id="exitConfirmModal" tabindex="-1" aria-labelledby="exitConfirmModalLabel"
        aria-hidden="true">
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let unsavedChanges = true; // Mettez à true si vous avez des modifications non enregistrées
                let confirmExit = false;

                // window.addEventListener("beforeunload", function(event) {
                //     if (unsavedChanges && !confirmExit) {
                //         event.preventDefault();
                //         event.returnValue = ""; // Affiche le message standard des navigateurs
                //         showModal();
                //         return ""; // Certains navigateurs nécessitent cette ligne
                //     }
                // });

                function showModal() {
                    let exitModal = new bootstrap.Modal(document.getElementById('exitConfirmModal'));
                    exitModal.show();
                }

                document.getElementById("confirmExit").addEventListener("click", function() {
                    confirmExit = true;
                    window.location.href = "<https://google.com>"; // Changez par la route souhaitée
                });
            });
        </script>
    </div>

    <div id="resumeModal" class="modal fade hidden fixed inset-0 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-lg shadow-xl text-center max-w-md w-full">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Continuer la mission ?</h2>
        <p class="mb-6 text-gray-600">Une mission est en cours. Voulez-vous reprendre à l'endroit où vous vous étiez arrêté ?</p>
        <div class="flex justify-center gap-4 mt-4">
          <button id="continueMissionBtn" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Continuer</button>
          <button id="restartMissionBtn" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Recommencer</button>
        </div>
      </div>
    </div>

    @include('components.confirm.destroy-base-confirm')
    @include('dashboard.layout.layout-toast')
    @include('dashboard.layout.footer')
</body>
@include('dashboard.layout.fonctions')
</html>
