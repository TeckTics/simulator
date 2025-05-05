<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    {{-- <script src="https://www.google.com/recaptcha/api.js"></script> --}}
    {{-- <script src="https://www.google.com/recaptcha/api.js?render=6LepvmgqAAAAAFoF6YlKswfbC1OjRsfaBVhH38rJ"></script> --}}
    <title>S'authentifier - UrgenceSAMU</title>
    {{-- <style>
        /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
    </style> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js?render=6LeBkIIqAAAAAOXLMWogm2VFjL7tNGPQ57JWRs60'></script>
    {!! htmlScriptTagJsApi() !!}
</head>

<style>
    .leaflet-control-container .leaflet-routing-container-hide {
        display: none;
    }

    .rc-anchor-normal-footer {
        z-index: 1002;
    }

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
        font-family: "Plus Jakarta Sans"
    }
</style>

<body>
    <main>
        <div class=" min-h-screen bg-blue-50" style="background-color: #1b1b1b;">
            <div class="flex relative flex-col min-h-screen  h-full items-center justify-center "
                style="background-color: #327ca750;">
                <div id="map"
                    class="w-full top-0 left-0  absolute z-30 opacity-30 h-full shadow-black  z-10  overflow-hidden">
                </div>
            </div>
            <div class="fixed z-40 top-0 flex items-center justify-center w-full h-full p-3 md:p-0">
                <form id="form-connexion" action="{{ url('/connexion') }}" method="POST"
                    class="w-full p-10 m-auto relative  bg-[#14264b]  rounded-xl shadow-xl   "
                    style="max-width: 456px;  ">
                    @csrf
                    <div class="space-y-12">

                        <div class="pb-12 ">
                            <div class="text-center">
                                <img src="{{ asset('assets/images/Urgence.png') }}" width="200px"
                                    class="rounded-full mx-auto" alt="UrgenceSamu logo" />
                            </div>
                            <p class=" text-sm text-white text-center">Sauvez des vies en gérant vos unités de
                                secours
                                avec efficacité !</p>
                            <h2 class="text-3xl leading-7 my-4 text-white font-bold text-center">Connexion</h2>
                            <div class="grid grid-cols-1 gap-4 ">
                                @if (session('message'))
                                    <p class="text-sm text-red-500">
                                        {{ session('message') }}
                                    </p>
                                @endif

                                <div id="message">

                                </div>
                                <div id="message-error" class="text-red-500 text-sm"></div>
                                <div class="block" id="email-to-phone">
                                    <label for="email" class="text-sm text-white">Email</label>
                                    <div class="mt-1">
                                        <input type="email" required
                                            class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl"
                                            placeholder="Entrer votre Adresse mail" name="email" id="email">
                                        @error('email')
                                            <p class="ml-1 text-red-500 text-sm">Mot de passe invalide</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="block ">
                                    <label for="password" class="text-sm text-white">Mot de passe</label>
                                    <div class="relative mt-1">
                                        <input type="password" required
                                            class="w-full p-3 text-sm  focus-visible:outline-blue-500 focus-visible:outline-1 focus-visible:placeholder:text-blue-500 rounded-xl"
                                            placeholder="Entrer votre mot de passe" name="password" id="password">
                                        <button type="button" id="passwordButton" name="showpasswordButton"
                                            class="absolute -translate-y-1/2 top-1/2 right-2 opacity-30">
                                            <svg id="hiddenPassword" width="24px" class="hidden" height="24px"
                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path opacity="0.1"
                                                        d="M6.29528 7.87634L5 9.17162C3.66667 10.505 3 11.1716 3 12C3 12.8285 3.66667 13.4951 5 14.8285L7.12132 16.9498C9.85499 19.6835 14.2871 19.6835 17.0208 16.9498L17.4322 16.5384L14.5053 14.2619C13.9146 14.8713 13.0873 15.2501 12.1716 15.2501C10.3766 15.2501 8.92157 13.795 8.92157 12.0001C8.92157 11.3746 9.09827 10.7904 9.40447 10.2946L6.29528 7.87634Z"
                                                        fill="#323232"></path>
                                                    <path d="M3.17139 5.12988L21.1714 19.1299" stroke="#323232"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path
                                                        d="M14.3653 13.8456C13.8162 14.5483 12.9609 15 12 15C10.3431 15 9 13.6569 9 12C9 11.3256 9.22253 10.7032 9.59817 10.2021"
                                                        stroke="#323232" stroke-width="2"></path>
                                                    <path
                                                        d="M9 5.62667C11.5803 4.45322 14.7268 4.92775 16.8493 7.05025L19.8511 10.052C20.3477 10.5486 20.5959 10.7969 20.7362 11.0605C21.0487 11.6479 21.0487 12.3521 20.7362 12.9395C20.5959 13.2031 20.3477 13.4514 19.8511 13.948V13.948L19.799 14"
                                                        stroke="#323232" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M7.01596 8.39827C7.40649 8.00774 7.40649 7.37458 7.01596 6.98406C6.62544 6.59353 5.99228 6.59353 5.60175 6.98406L7.01596 8.39827ZM7.65685 16.2427L5.53553 14.1213L4.12132 15.5356L6.24264 17.6569L7.65685 16.2427ZM16.1421 16.2427C13.799 18.5858 10 18.5858 7.65685 16.2427L6.24264 17.6569C9.36684 20.7811 14.4322 20.7811 17.5563 17.6569L16.1421 16.2427ZM5.53553 9.8787L7.01596 8.39827L5.60175 6.98406L4.12132 8.46449L5.53553 9.8787ZM16.7465 15.6383L16.1421 16.2427L17.5563 17.6569L18.1607 17.0526L16.7465 15.6383ZM5.53553 14.1213C4.84888 13.4347 4.40652 12.9893 4.12345 12.6183C3.85798 12.2704 3.82843 12.1077 3.82843 12H1.82843C1.82843 12.7208 2.1322 13.3056 2.53341 13.8315C2.917 14.3342 3.47464 14.8889 4.12132 15.5356L5.53553 14.1213ZM4.12132 8.46449C3.47464 9.11116 2.917 9.6658 2.53341 10.1686C2.1322 10.6944 1.82843 11.2792 1.82843 12H3.82843C3.82843 11.8924 3.85798 11.7297 4.12345 11.3817C4.40652 11.0107 4.84888 10.5654 5.53553 9.8787L4.12132 8.46449Z"
                                                        fill="#323232"></path>
                                                </g>
                                            </svg>
                                            <svg id="showPassword" width="24px" height="24px" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="style=stroke">
                                                        <g id="eye-open">
                                                            <path id="vector (Stroke)" fill-rule="evenodd"
                                                                clip-rule="evenodd"
                                                                d="M12 9.75C10.755 9.75 9.75 10.755 9.75 12C9.75 13.245 10.755 14.25 12 14.25C13.245 14.25 14.25 13.245 14.25 12C14.25 10.755 13.245 9.75 12 9.75ZM8.25 12C8.25 9.92657 9.92657 8.25 12 8.25C14.0734 8.25 15.75 9.92657 15.75 12C15.75 14.0734 14.0734 15.75 12 15.75C9.92657 15.75 8.25 14.0734 8.25 12Z"
                                                                fill="#000000"></path>
                                                            <path id="vector (Stroke)_2" fill-rule="evenodd"
                                                                clip-rule="evenodd"
                                                                d="M2.28282 9.27342C4.69299 5.94267 8.19618 3.96997 12.0001 3.96997C15.8042 3.96997 19.3075 5.94286 21.7177 9.27392C22.2793 10.0479 22.5351 11.0421 22.5351 11.995C22.5351 12.948 22.2792 13.9424 21.7174 14.7165C19.3072 18.0473 15.804 20.02 12.0001 20.02C8.19599 20.02 4.69264 18.0471 2.28246 14.716C1.7209 13.942 1.46509 12.9478 1.46509 11.995C1.46509 11.0419 1.721 10.0475 2.28282 9.27342ZM12.0001 5.46997C8.74418 5.46997 5.66753 7.15436 3.49771 10.1532L3.497 10.1542C3.15906 10.6197 2.96509 11.2866 2.96509 11.995C2.96509 12.7033 3.15906 13.3703 3.497 13.8357L3.49771 13.8367C5.66753 16.8356 8.74418 18.52 12.0001 18.52C15.256 18.52 18.3326 16.8356 20.5025 13.8367L20.5032 13.8357C20.8411 13.3703 21.0351 12.7033 21.0351 11.995C21.0351 11.2866 20.8411 10.6197 20.5032 10.1542L20.5025 10.1532C18.3326 7.15436 15.256 5.46997 12.0001 5.46997Z"
                                                                fill="#000000"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                        @error('password')
                                            <p class="ml-1 text-red-500 text-sm">Mot de passe invalide</p>
                                        @enderror
                                    </div>
                                    <div class="text-right">
                                        <a href="forgot-password.html" class="text-sm text-blue-700">Mot de passe
                                            oublié?</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        {{-- {!! htmlFormSnippet() !!} --}}
                        {{-- @if ($errors->has('g-recaptcha-response'))
                            <div>
                                <small class="text-red-500">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </small>
                            </div>
                        @endif --}}
                    </div>
                    <div>
                        <button id="btnForm" style="background-color: #1976D2;"
                            class="w-full block font-medium p-4 bg-gradient-to-tr bg-blue-500 from-blue-400 border-none rounded-md text-white shadow hover:from-cyan-400 max-sm:text-xs  btn  btn-sm"
                            type="submit">Se connecter</button>
                        {{-- <button type="submit"
                            class="w-full p-3 my-2 text-sm btn text-white rounded-md bg-stone-950 hover:bg-stone-900">Se
                            </button> --}}
                        {{-- <button data-sitekey="6LepvmgqAAAAAFoF6YlKswfbC1OjRsfaBVhH38rJ" data-callback='onSubmit'
                            data-action='submit'
                            class="w-full p-3 my-2 g-recaptcha text-sm btn text-white rounded-md bg-stone-950 hover:bg-stone-900">Se
                            connecter</button> --}}

                        <p class=" text-white text-sm mt-4">Vous êtes nouveau sur UrgenceSAMU?<a
                                href={{ url('/inscription') }} class="text-blue-700 hover:underline font-medium">
                                Créer votre compte.</a></p>
                        {{-- <a href="{{ url('/inscription') }}"
                            class=" text-sm rounded-md text-stone-600 hover:text-blue-700">S'inscrire</a> --}}

                    </div>
                    <div id="loader"
                        class="hidden fixed items-center justify-center w-full h-full z-50 top-0 left-0 bg-black/50"
                        style="display: none">
                        <div class="flex justify-center items-center max-w-xl mx-auto min-h-screen">
                            <svg fill="#ffffff" class="animate-spin" width="64px" height="64px"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
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
                    <div class="flex justify-center">
                        <a href="{{ url('/') }}"
                            class=" text-sm font-semibold text-center mx-auto rounded-md text-white hover:text-blue-700">Retour
                            à
                            l'accueil</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script>
    let form = document.querySelector('#btnForm');
    let loader = document.querySelector('#loader')
    let bol = false
    form.addEventListener('click', function(event) {
        const emailInput = document.getElementById("email")

        const passwordInput = document.getElementById("password")
        const messageError = document.getElementById("message-error")
        if (emailInput.value != "" && passwordInput.value != "") {
            if (!bol) {
                loader.style.display = 'block';
                loader.classList.replace('hidden', 'flex');
                bol = true
            } else {
                messageError.innerHTML = "Veuillez remplir tout les champs "
            }
        }
    });
    const passwordButton = document.getElementById("passwordButton");
    const hiddenPassword = document.getElementById("hiddenPassword");
    const showPassword = document.getElementById("showPassword");
    const password = document.getElementById("password");
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });




    // L.icon permet de créer un icon 
    // var map = L.map('map').setView([51.505, -0.09], 13);

    // Initialisation de la carte et du marqueur

    var map = L.map('map').setView([46, 2], 1.2);
    osm.addTo(map);
    let markeurs = [];
    var marker = L.marker([46, 2]).addTo(map)

    const routing = (latF, lngF, lat, lng, marqueur) => {
        const r = L.Routing.control({
            waypoints: [
                L.latLng(lat, lng),
                L.latLng(latF, lngF),
            ],
            createMarker: function(i, waypoint) {
                return L.marker(waypoint.latLng);
            },
        }).on('routesfound', function(e) {
            const route = e.routes[0];
            const totalSteps = route.coordinates.length;
            let currentStep = 0; // 
            function animateRoute() {
                if (currentStep < totalSteps) {
                    marqueur.setLatLng(route.coordinates[currentStep]);
                    currentStep++;
                    setTimeout(animateRoute, 250); // Adjust animation speed as needed
                }
            }
            animateRoute();

        }).addTo(map)
        const tab = document.querySelector('.leaflet-right');
        if (tab) {
            tab.remove()
        }
    }
    routing(45.98, 1.98, 46, 2, marker);


    window.addEventListener('load', () => {
        let show = false;
        passwordButton.addEventListener('click', () => {
            if (!show) {
                hiddenPassword.classList.remove('hidden');
                showPassword.classList.add('hidden');
                password.type = 'text';
                show = true;
            } else {
                hiddenPassword.classList.add('hidden');
                showPassword.classList.remove('hidden');
                password.type = 'password';
                show = false;
            }
        })

        // signinButton.addEventListener('click', () => {
        //     window.location.href = "../dashboard/index.html";

        // });
    })
</script>

</html>
