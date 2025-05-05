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
            <h2 class="my-8 text-2xl font-bold">Mentions légales</h2>
            <p class="p-8">
                Les présentes Conditions Générales d'Utilisation (CGU) ont pour objet de définir les modalités d'accès
                et d'utilisation du site de simulation de SAMU (ci-après désigné le "{{ $setting->nom_app }}"). En vous
                connectant et en
                utilisant le Site, vous acceptez sans réserve l'ensemble des dispositions des présentes CGU.
            </p>
            <h3 class="font-bold uppercase">Article 1 – Définitions</h3>
            <p class="p-8">
                {{ $setting->nom_app }} : désigne le site web de simulation de SAMU accessible à l'adresse [nom
                définis]
                Utilisateur : désigne toute personne physique ou morale qui se connecte et utilise le Site.
                Contenu : désigne l'ensemble des éléments constituant le Site, notamment les textes, images, vidéos,
                logiciels, bases de données, etc.
                SAMU : désigne le Service d'Aide Médicale Urgente.
            </p>
            <h3 class="font-bold uppercase">Article 2 – Objet</h3>
            <p class="p-8">
                Le Site a pour objet de proposer une plateforme de simulation permettant aux utilisateurs de s'entraîner
                à la régulation médicale et à la gestion des appels d'urgence. Le Site ne saurait en aucun cas se
                substituer à une formation professionnelle réelle.
            </p>
            <h3 class="font-bold uppercase">Article 3 – Conditions d'accès et d'utilisation</h3>
            <p class="p-8">
                L'accès au Site est libre et gratuit pour tout Utilisateur disposant d'un accès à internet.
                L'Utilisateur s'engage à utiliser le Site de manière conforme aux lois et réglementations en vigueur et
                aux présentes CGU.
                <br>
                L'Utilisateur est responsable de la protection de ses identifiants de connexion. Tout usage frauduleux
                de ces identifiants engagera la responsabilité de l'Utilisateur.
            </p>
            <h3 class="font-bold uppercase">Article 4 – Responsabilité</h3>
            <p class="p-8">
                Le contenu du Site est fourni à titre informatif et ne saurait engager la responsabilité de l'éditeur du
                Site. Les informations fournies sur le Site ne constituent en aucun cas des conseils médicaux.
            </p>
            <p class="p-8">
                L'Utilisateur est seul responsable de l'utilisation qu'il fait du Site et de ses contenus. L'éditeur du
                Site ne pourra être tenu responsable de tout dommage direct ou indirect résultant de l'utilisation du
                Site.
            </p>
            <h3 class="font-bold uppercase">Article 5 – Propriété intellectuelle</h3>
            <p class="p-8">
                L'ensemble des éléments constituant le Site, notamment les marques, logos, textes, images, vidéos, sont
                la propriété exclusive de l'éditeur du Site ou de ses partenaires et sont protégés par les lois de la
                propriété intellectuelle.
                <br>
                Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments
                du Site, quel que soit le moyen ou le procédé utilisé, est strictement interdite, sauf autorisation
                écrite préalable de l'éditeur du Site.
            </p>
            <h3 class="font-bold uppercase">Article 6 – Données personnelles</h3>
            <p class="p-8">
                Les données personnelles collectées sur le Site sont traitées conformément à la réglementation en
                vigueur en matière de protection des données personnelles. Pour plus d'informations, veuillez consulter
                la politique de confidentialité du Site.
            </p>
            <h3 class="font-bold uppercase">Article 7 – Modification des CGU</h3>
            <p class="p-8">
                L'éditeur du Site se réserve le droit de modifier les présentes CGU à tout moment. Les nouvelles CGU
                seront applicables dès leur mise en ligne. Il est donc recommandé à l'Utilisateur de consulter
                régulièrement les CGU.
            </p>
            <h3 class="font-bold uppercase">Article 8 – Droit applicable et attribution de juridiction</h3>

            <p class="p-8">
                Les présentes CGU sont soumises au droit français. Tout litige relatif à l'interprétation ou à
                l'exécution des présentes CGU sera soumis à la compétence exclusive des tribunaux compétents de [Ville].
            </p>


            <h3 class="font-bold uppercase">Article 9 – Contact</h3>
            <p class="p-8">
                Pour toute question relative aux présentes CGU, vous pouvez contacter l'éditeur du Site à l'adresse
                suivante : [Adresse email de contact].
            </p>
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
