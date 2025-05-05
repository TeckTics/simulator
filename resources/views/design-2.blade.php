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
    {{-- <meta name="description" content="{{ $setting->title_header_home_page }}" /> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <title>Design2</title>
</head>
<style>
    ul {
        list-style: none;
    }

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

    /* .pattern {
        position: absolute;
        bottom: 0;
        width: 100%;
        background-image: url(./assets/icons/wave.svg);
        background-repeat: repeat-x;
        background-position: bottom;
        background-size: 1000px 180px;
        height: 0;
        z-index: -2;
        padding: 0;
        padding-bottom: 140px;
    } */

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
    <main class="">

        <section style="   justify-content: center; padding-top: 100px; position: relative;"
            class="section-header bg-black  items-center sm:min-h-screen relative overflow-hidden pb-9 pt-20  d-flex pb-lg-12">
            <div style="background-image: url('{{ asset('assets/images/Intervention_SAMU_jour.png') }}')"
                class="absolute w-full h-full bg-center top-0 max-sm:opacity-60 left-0 bg-cover opacity-40 ">
            </div>
            <div
                class="bg-gradient-to-t absolute bottom-0 left-0 w-full h-full via-neutral-500/50 from-neutral-900/80  to-transparent">
            </div>
            <div style="position: relative; z-index: 2;" class="container-xl  text-2xl  p-4 text-center">
                <h1 class="align-middle max-w-2xl font-bold md:text-4xl text-white mx-auto">Devenez un héros du
                    quotidien</h1>
                <h1 class="align-middle max-w-2xl font-bold  md:text-4xl text-white mx-auto mb-2">découvrez le
                    premier
                    jeu de
                    simulation dédié à la
                    régulation médicale du SAMU!
                </h1>
                <p
                    class="sm:text-[16px] mt-4 sm:text-center text-justify text-sm max-w-2xl mx-auto  font-normal rounded-sm px-4 text-white ">
                    Avec <span class=" font-bold">UrgenceSAMU</span>, sauver des vies en tant qu’assistant de régulation
                    médicale du SAMU:

                </p>
                <ul
                    class="sm:text-[16px] mt-1 sm:text-center text-justify text-sm max-w-2xl mx-auto  font-normal rounded-sm px-4 text-white ">
                    <li class="flex  items-start sm:items-center gap-1 justify-center"> <img width="25"
                            height="25" src="{{ asset('assets/images/1f4de.png') }}" alt=""
                            srcset="">Répondez aux appels : Analysez et priorisez les interventions.</li>
                    <li class="flex  items-start sm:items-center gap-1 justify-center"> <img width="25"
                            height="25" src="{{ asset('assets/images/1f691.png') }}" alt="" srcset="">
                        Envoyez les équipes adaptées : Appliquez les protocoles d'intervention.</li>
                    <li class="flex  items-start sm:items-center gap-1 justify-center"> <img width="25"
                            height="25" src="{{ asset('assets/images/1f579-fe0f.png') }}" alt=""
                            srcset="">Gérez le terrain : Supervisez les équipes en temps réel.</li>
                    <li class="flex  items-start sm:items-center gap-1 justify-center"> <img width="25"
                            height="25" src="{{ asset('assets/images/1f4aa.png') }}" alt=""
                            srcset="">Coordonnez les renforts : Mobilisez les ressources clés.</li>

                    <li class="flex  items-start sm:items-center gap-1 justify-center"> <img width="25"
                            height="25" src="{{ asset('assets/images/26a1.png') }}" alt="" srcset="">
                        Sauvez des vies avec des décisions rapides !</li>
                </ul>
                <a href="{{ url('/inscription') }}" class=" ">
                    <button style="background-color: #1976D2;"
                        class="w-fit block font-medium sm:px-4 p-2 bg-gradient-to-tr bg-blue-500 mt-4 mx-auto from-blue-400 border-none rounded-md text-white shadow hover:from-cyan-400 max-sm:text-xs  btn  btn-sm">Inscrivez-vous
                        et jouez maintenant !</button>
                </a>
                {{-- <div
                    class="text-white flex  mt-1 items-center max-w-2xl px-4 mx-auto justify-between sm:gap-1 sm:justify-center flex-wrap sm:text-[16px] text-sm text-md font-normal">
                    <img src="{{ asset('assets/images/1f691.png') }}" width="20px" /> <span>Nouveau joueur ?
                    </span> <span>Inscrivez-vous dès</span> <span> maintenant ! </span><img
                        src="{{ asset('assets/images/1f691.png') }}" width="20px" />
                    <span>Rejoignez la communauté</span> <span>en
                        quelques clics: connectez vous pour </span> <span class="flex  items-center">plonger dans l'aventure
                        ! <img
                        src="{{ asset('assets/images/1f603.png') }}" width="20px" /></span>
                    

                </div> --}}

            </div>
            {{-- <div style="position: relative; z-index: 2;" class="container-xl grid grid-cols-2 items-center  p-4 text-left">
                <div>
                    <h1 class="align-middle max-w-2xl font-bold md:text-5xl text-white mx-auto">Devenez un héros du
                        quotidien</h1>
                    <h1 class="align-middle max-w-2xl font-bold  md:text-5xl text-white mx-auto mb-2">découvrez le
                        premier
                        jeu de
                        simulation dédié à la
                        régulation médicale du SAMU!
                    </h1>
                    <div>
                        <p
                            class="sm:text-[16px] mt-4 sm:text-left text-justify text-sm max-w-2xl mx-auto  font-normal rounded-sm text-white ">
                            Avec <span class=" font-bold">UrgenceSAMU</span>, sauver des vies en tant qu’assistant de
                            régulation
                            médicale du SAMU:

                        </p>
                        <ul
                            class="sm:text-[16px] pl-0 mt-1 sm:text-center text-justify text-sm max-w-2xl mx-auto  font-normal rounded-sm text-white ">
                            <li class="flex  items-start my-3 sm:items-center gap-1 justify-start"> <img width="25"
                                    height="25" src="{{ asset('assets/images/1f4de.png') }}" alt=""
                                    srcset="">Répondez aux appels : Analysez et priorisez les interventions.</li>
                            <li class="flex  items-start my-3 sm:items-center gap-1 justify-start"> <img width="25"
                                    height="25" src="{{ asset('assets/images/1f691.png') }}" alt=""
                                    srcset="">
                                Envoyez les équipes adaptées : Appliquez les protocoles d'intervention.</li>
                            <li class="flex  items-start my-3 sm:items-center gap-1 justify-start"> <img
                                    width="25" height="25" src="{{ asset('assets/images/1f579-fe0f.png') }}"
                                    alt="" srcset="">Gérez le terrain : Supervisez les équipes en temps
                                réel.</li>
                            <li class="flex  items-start my-3 sm:items-center gap-1 justify-start"> <img
                                    width="25" height="25" src="{{ asset('assets/images/1f4aa.png') }}"
                                    alt="" srcset="">Coordonnez les renforts : Mobilisez les ressources
                                clés.</li>

                            <li class="flex  items-start my-3 sm:items-center gap-1 justify-start"> <img
                                    width="25" height="25" src="{{ asset('assets/images/26a1.png') }}"
                                    alt="" srcset="">
                                Sauvez des vies avec des décisions rapides !</li>
                            <li>
                                <a href="{{ url('/inscription') }}" class=" ">
                                    <button style="background-color: #1976D2;"
                                        class="w-fit block font-medium sm:px-4 p-2 bg-gradient-to-tr bg-blue-500 mt-4  from-blue-400 border-none rounded-md text-white shadow hover:from-cyan-400 max-sm:text-xs  btn  btn-sm">Inscrivez-vous
                                        et jouez maintenant !</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <img src="{{ asset('assets/images/Urgence.png') }}"  class="rounded-full float-right relative object-cover"
                        alt="UrgenceSamu logo" />
                </div>
            </div> --}}


        </section>
        <div class="bg-neutral-900 min-h-screen py-8 flex justify-center items-center">
            <section class="container-xl  px-5 m-auto  row" style="min-height: 40vh; ">
                <p class="text-2xl font-bold text-center text-white my-8">Découvrez UrgenceSAMU <br>
                    Un
                    concept totalement unique inspiré de la réalité</p>
                <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 mt-4 gap-4">
                    <div
                        class=" rounded-md p-4  items-center bg-gradient-to-tr bg-blue-700 hover:bg-blue-600 from-blue-500 shadow-xl hover:-translate-y-2 transition-transform  hover:shadow-2xl">
                        <div class="flex justify-center gap-4 flex-col h-full">
                            <h3 class="text-white text-xl font-semibold text-center">Simuler des missions</h3>
                            <p class="p-2 text-center text-sm text-white">
                                Affectez des unités spécialisées aux missions en fonction de leurs compétences et de la
                                situation et portez secours aux victimes.
                            </p>
                        </div>
                    </div>
                    <div
                        class=" rounded-md p-4 bg-gradient-to-tr bg-blue-700 hover:bg-blue-600 from-blue-500 items-center shadow-xl hover:-translate-y-2 transition-transform  hover:shadow-2xl">
                        <div class="flex justify-center gap-4 flex-col h-full">
                            <h3 class="text-white text-xl font-semibold text-center">Gérer vos ressources</h3>
                            <p class="p-2 text-center text-sm text-white">
                                Vous pouvez acheter de nouvelles unités, des équipements, des améliorations pour vos
                                bases.
                            </p>
                        </div>
                    </div>
                    <div
                        class=" rounded-md p-4 bg-gradient-to-tr bg-blue-700 hover:bg-blue-600 from-blue-500 items-center shadow-xl hover:-translate-y-2 transition-transform  hover:shadow-2xl">
                        <div class="flex justify-center gap-4 flex-col h-full">
                            <h3 class="text-white text-xl font-semibold text-center">Jouez en coopération avec vos
                                amis.
                            </h3>
                            <p class="p-2 text-center text-sm text-white">
                                Créez votre alliance, invitez vos amis et coopérez ensemble pour réussir chaque mission.
                            </p>
                        </div>
                    </div>
                    <div
                        class=" rounded-md p-4 bg-gradient-to-tr bg-blue-700 hover:bg-blue-600 from-blue-500 items-center shadow-xl hover:-translate-y-2 transition-transform  hover:shadow-2xl">
                        <div class="flex justify-center gap-4 flex-col h-full">
                            <h3 class="text-white text-xl font-semibold text-center">Une puissante intelligence
                                artificielle</h3>
                            <p class="p-2 text-center text-sm text-white">
                                Chaque mission réserve son lot de surprises : un patient dont l'état se dégrade, un
                                besoin
                                urgent de SAMU sur place... Plongez dans l&apos;univers d&apos;UrgenceSAMU.
                            </p>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        {{-- <section>
            <div class="container-xl p-5 sm:flex-row flex flex-col  m-auto  ">
                <div class="col  p-4 flex " style="justify-content: center; align-items: center;">
                    <div>
                        <p style="line-height: 2rem; font-size: 14px">
                            Les professionnels de santé exigent des outils de formation performants et réalistes. Notre
                            plateforme
                            répond à vos attentes en vous offrant des simulations médicales de haute qualité, conçues en
                            collaboration avec des experts du domaine.
                            <br>
                            Complétez votre formation avec notre boutique en ligne, spécialisée dans les équipements de
                            réanimation
                            les plus récents et les plus performants.
                        </p>
                        <button class="col text-xs btn-sm mt-4 btn btn-primary">Commencer à jouer</button>
                    </div>
                </div>

                <div class="col max-w-96 max-h-96 w-full h-full" id="animation-container">
                    <!-- <img width="300" height="300" src="./assets/images/Animation - 1723983177531.gif" alt="" srcset=""> -->
                </div>
            </div>
        </section> --}}
    </main>
    <footer>
        <div class="bg-neutral-950">
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
                        © 2024 UrgenceSAMU
                    </P>

                </div>
            </div>
        </div>
        <!-- <div   style="height: 5vh; background-color: #0288d1;">

        </div> -->
        <!-- Illustration by <a href="https://icons8.com/illustrations/author/zD2oqC8lLBBA">Icons 8</a> from <a
            href="https://icons8.com/illustrations">Ouch!</a> -->
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
                header.classList.add('bg-black/70')
            } else {
                header.classList.remove('bg-black/70')
                header.classList.remove("shadow-md");
            }

            if (currentScroll > 100) {
                header.classList.add("sticky");
                title.classList.add('text-violet-700')

                title.classList.remove('text-white')
            } else {
                header.classList.remove("sticky");
                title.classList.add('text-white')

                title.classList.remove('text-violet-700')

            }
        }
    })
</script>


</html>
