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
            <h2 class="my-8 text-4xl ">{{ $setting->nom_app }} Mentions légales</h2>
            <p class="p-8">
                Le présent site web est la propriété de [Votre nom ou dénomination sociale], société par actions
                simplifiée au capital de [Montant], immatriculée au Registre du Commerce et des Sociétés de [Ville] sous
                le numéro [Numéro RCS], dont le siège social est situé [Adresse].
            </p>
            <p class="p-8">
                Directeur de la publication : [Votre nom]
                Hébergeur : [Nom de l'hébergeur], dont le siège social est situé [Adresse de l'hébergeur].

                Propriété intellectuelle : L'ensemble des éléments constituant le site (textes, images, logos, etc.)
                sont protégés par les lois de la propriété intellectuelle. Toute reproduction, représentation,
                modification, publication, adaptation totale ou partielle de l'un quelconque de ces éléments est
                strictement interdite sans l'autorisation écrite préalable de [Votre nom ou dénomination sociale].

                Données personnelles : Les données personnelles collectées sur ce site sont traitées conformément à
                notre politique de confidentialité.

                Liens hypertextes : Le site peut contenir des liens hypertextes vers d'autres sites web. Nous déclinons
                toute responsabilité quant au contenu de ces sites.

                Loi applicable : Les présentes mentions légales sont régies par le droit français. En cas de litige, les
                tribunaux de [Ville] seront seuls compétents.

                Exemple de CGU

                [Nom de votre site] – Conditions générales d'utilisation

                Les présentes Conditions Générales d'Utilisation (CGU) régissent l'accès et l'utilisation du site [Nom
                de votre site], édité par [Votre nom ou dénomination sociale].

                Objet : Le présent site a pour objet de [Indiquez l'objet de votre site].

                Accès au site : L'accès au site est libre et gratuit à tout utilisateur disposant d'un accès à internet.

                Responsabilité : [Votre nom ou dénomination sociale] ne saurait être tenu responsable de tout dommage
                direct ou indirect résultant de l'utilisation du site.

                Propriété intellectuelle : L'ensemble du contenu du site est protégé par les droits de propriété
                intellectuelle. Toute reproduction, représentation, modification, publication, adaptation totale ou
                partielle de l'un quelconque de ces éléments est strictement interdite sans l'autorisation écrite
                préalable de [Votre nom ou dénomination sociale].

                Données personnelles : Les données personnelles collectées sur ce site sont traitées conformément à
                notre politique de confidentialité.

                Liens hypertextes : Le site peut contenir des liens hypertextes vers d'autres sites web. Nous déclinons
                toute responsabilité quant au contenu de ces sites.

                Durée et résiliation : Les présentes CGU sont conclues pour une durée indéterminée. Elles peuvent être
                modifiées à tout moment par [Votre nom ou dénomination sociale].

                Loi applicable : Les présentes CGU sont régies par le droit français. En cas de litige, les tribunaux de
                [Ville] seront seuls compétents.
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
