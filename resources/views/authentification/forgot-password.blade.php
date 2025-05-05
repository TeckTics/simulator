<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Mot de passe - UrgenceSAMU</title>
</head>

<body>
    <main>
        <div class="grid min-h-screen md:grid-cols-2 bg-violet-50" style="background-color: #1b1b1b;">
            <div class="flex flex-col items-center justify-center " style="background-color: #3232a7;">
                <div class="relative z-10">
                    <h1 class="my-4 font-bold text-white text-7xl">UrgenceSAMU</h1>
                    <p class="text-white">Entrez dans la monde des équipes du SAMU</p>
                    <div class="w-fit bg-white px-3 shadow-lg shadow-black/30 py-2 mt-4 rounded-md">
                        <a href="{{ url('/') }}"
                            class=" text-sm font-semibold rounded-md text-purple-600 hover:text-violet-700">Retour à
                            l'accueil</a>
                    </div>
                </div>
                <img src="../assets/images/3d-business-black-doctor-standing-with-clipboard-and-writing.png"
                    alt="" class="absolute z-0 opacity-20" srcset="">
            </div>
            <div class="fixed top-0 flex items-center justify-center w-full h-full p-3 md:p-0 md:relative">
                <form action="{{ url('/connexion') }}" method="POST"
                    class="w-full p-10 m-auto bg-white rounded-md shadow-xl " style="max-width: 456px;  ">
                    @csrf
                    <div class="space-y-12">

                        <div class="pb-12 ">
                            <h2 class="text-2xl leading-7 text-gray-900">Mot de passe oublié</h2>

                            <div class="grid grid-cols-1 gap-4 py-4 mt-4">
                                <div>
                                    @isset($message)
                                        <p class="text-sm text-red-500">
                                            {{ $message }}
                                        </p>
                                    @endisset
                                </div>
                                <div class="block" id="email-to-phone">
                                    <label for="email" class="text-sm">Email</label>
                                    <div class="mt-1">
                                        <input type="email" required
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="Email" name="email" id="email">
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full p-3 my-2 text-sm text-white rounded-md bg-stone-950 hover:bg-stone-900">Envoyer</button>
                        <div class="flex justify-between">
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    const passwordButton = document.getElementById("passwordButton");
    const hiddenPassword = document.getElementById("hiddenPassword");
    const showPassword = document.getElementById("showPassword");
    const password = document.getElementById("password");

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
