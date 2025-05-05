<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-utilities.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-utilities.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-utilities.rtl.min.css') }}">
    <meta name="description" content="{{ $setting->title_header_home_page }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <title>{{ $setting->nom_app }} - Gérez votre propre service médical dans votre ville!</title>
</head>
<style>
    ul {
        list-style: none;
    }

    .pattern {
        position: absolute;
        bottom: 0;
        width: 100%;
        background-image: url(./assets/icons/wave.svg);
        background-repeat: repeat-x;
        background-position: bottom;
        background-size: 1000px 180px;
        height: 0;
        padding: 0;
        padding-bottom: 140px;
    }

    .pattern.bottom {
        bottom: -10px;
        transform: rotate(180deg);
    }

    @media (max-width: 991.98px) {
        .pattern {
            background-size: 700px 203px;
        }
    }

    /* .btn-commencer {
        color: #e02c37;
        transition: all 0.5s;
        font-weight: 500;
    }

    .btn-commencer:hover {
        background-color: white;
        color: #e02c37;
        font-weight: 500;
        transition: all 0.3s;
    } */
</style>

<body>
    <header class="fixed-top header ">
        <ul style="align-items: center;"
            class="fw-semibold items-center  text-white container-xl py-2 m-auto  flex justify-between justify-content-between">
            <li class="col-6">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/Urgence.png') }}" width="200px" class="rounded-full"
                        alt="UrgenceSamu logo" />
                </a>
            </li>

            <li class=" col-6 gap-1 sm:gap-2 flex justify-end items-center">
                <a href="{{ url('/connexion') }}" style="background-color: #1976D2;"
                    class="w-fit block font-medium sm:px-4 bg-gradient-to-tr bg-blue-500 from-blue-400 border-none rounded-md text-white shadow hover:from-cyan-400 max-sm:text-xs  btn  btn-sm">Se
                    connecter</a>
                <a href="{{ url('/inscription') }}"
                    class="  block  font-medium sm:px-4  w-fit max-sm:text-xs rounded-md hover:text-blue-500">S'inscrire</a>
            </li>
        </ul>
    </header>
    <main>
        <section class="min-h-screen py-20 px-8 container-xl text-justify mx-auto">
            <h2 class="my-8 text-2xl font-bold ">FAQ</h2>

            <div id="accordion-collapse" data-accordion="collapse">
                <h2 id="accordion-collapse-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full p-4 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200  hover:bg-gray-100 gap-3"
                        data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                        aria-controls="accordion-collapse-body-1">
                        <span>Qu'est-ce qu'un simulateur de SAMU?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-4 border border-b-0 border-gray-200 ">
                        <p class="mb-2 text-gray-500 ">
                            Un simulateur de SAMU est un outil en ligne qui permet de s'entraîner à gérer des appels
                            d'urgence comme le ferait un régulateur médical. Il offre des scénarios réalistes pour vous
                            aider à développer vos compétences.</p>
                    </div>
                </div>
                <h2 id="accordion-collapse-heading-2">
                    <button type="button"
                        class="flex items-center justify-between w-full p-4 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200  hover:bg-gray-100 gap-3"
                        data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                        aria-controls="accordion-collapse-body-2">
                        <span>Comment utiliser le simulateur ?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
                    <div class="p-4 border border-b-0 border-gray-200 ">
                        <p class="mb-2 text-gray-500 ">L'utilisation est simple : il suffit de créer
                            un compte et de choisir un scénario. Vous serez ensuite guidé étape par étape dans la
                            gestion de l'appel.</p>
                    </div>
                </div>
                <h2 id="accordion-collapse-heading-3">
                    <button type="button"
                        class="flex items-center justify-between w-full p-4 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200  hover:bg-gray-100 gap-3"
                        data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
                        aria-controls="accordion-collapse-body-3">
                        <span>Est-ce que le simulateur est gratuit ?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
                    <div class="p-4 border border-t-0 border-gray-200 ">

                    </div>
                </div>
                <h2 id="accordion-collapse-heading-4">
                    <button type="button"
                        class="flex items-center justify-between w-full p-4 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200  hover:bg-gray-100 gap-3"
                        data-accordion-target="#accordion-collapse-body-4" aria-expanded="false"
                        aria-controls="accordion-collapse-body-4">
                        <span>Quelles sont les différentes fonctionnalités du simulateur ?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-4" class="hidden" aria-labelledby="accordion-collapse-heading-4">
                    <div class="p-4 border border-t-0 border-gray-200 ">
                        <ul>
                            <li>
                                <h3 class="text-black text-xl font-semibold ">Simuler des missions</h3>
                                <p class="p-2  text-sm text-stone-500">
                                    Affectez des unités spécialisées aux missions en fonction de leurs compétences et de
                                    la
                                    situation et portez secours aux victimes.
                                </p>
                            </li>
                            <li>
                                <h3 class="text-black text-xl font-semibold ">Gérer vos ressources</h3>
                                <p class="p-2  text-sm text-stone-500">
                                    Vous pouvez acheter de nouvelles unités, des équipements, des améliorations pour vos
                                    bases.
                                </p>
                            </li>
                            <li>
                                <h3 class="text-black text-xl font-semibold ">Jouez en coopération avec
                                    vos
                                    amis.
                                </h3>
                                <p class="p-2  text-sm text-stone-500">
                                    Créez votre alliance, invitez vos amis et coopérez ensemble pour réussir chaque
                                    mission.
                                </p>
                            </li>
                            <li>
                                <h3 class="text-black text-xl font-semibold ">Une puissante
                                    intelligence
                                    artificielle</h3>
                                <p class="p-2  text-sm text-stone-500">
                                    Chaque mission réserve son lot de surprises : un patient dont l'état se dégrade, un
                                    besoin
                                    urgent de SMUR sur place... Plongez dans l&apos;univers
                                    d&apos;{{ $setting->nom_app }}.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </section>
    </main>
    <footer class="mt-10">
        <div class="bg-[#1f1f1f]">
            <div class="container-xl p-5 ">
                <div class="p-4">
                    <ul class="flex flex-row justify-center text-white flex-wrap gap-2 p-0">
                        <li class="text-center">
                            <a href="{{ url('/conditions-utilisations') }}"
                                class="hover:text-blue-500 font-thin">Conditions
                                d&apos;utilisation générales</a>
                        </li>
                        <li>-</li>
                        <li class="text-center">
                            <a href="{{ url('/mentions-legales') }}">Mentions legales et
                                CGV</a>
                        </li>
                        <li>-</li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                    </ul>
                    <P class="pt-2 text-white text-center">
                        © 2024 {{ $setting->nom_app }}
                    </P>

                </div>
            </div>
        </div>
    </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

<script>
    var animation = bodymovin.loadAnimation({

        container: document.getElementById('animation-container'),

        path: './assets/lottiesJson/1723983177531.json',

        renderer: 'svg',

        loop: true,

        autoplay: true,

        name: "Demo Animation",

    });
    const header = document.querySelector(".header");
    const title = document.querySelector('.title');
    const svgMenu = document.querySelector('.svg-menu');
    window.addEventListener("scroll", () => {
        const currentScroll = window.scrollY;
        if (header) {
            if (currentScroll > 100) {
                header.classList.add("shadow-md");
            } else {
                header.classList.remove("shadow-md");
            }

            if (currentScroll > 100) {
                header.classList.add("sticky");
                // header.classList.add("bg-white");
                // header.classList.remove("bg-background");
                // title.classList.add('text-violet-700')
                // title.classList.remove('text-white')
                // svgMenu.classList.add('stroke-violet-700')
                // svgMenu.classList.remove('stroke-white')
            } else {
                header.classList.remove("sticky");
                // header.classList.add("bg-background");
                // header.classList.remove("bg-white");
                // title.classList.add('text-white')
                // title.classList.remove('text-violet-700')
                // svgMenu.classList.add('stroke-white')
                // svgMenu.classList.remove('stroke-violet-700')
            }
        }
    })
</script>


</html>
