<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./../../assets/output.css" rel="stylesheet">
    <link href="./../../assets/global.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
      
        <script src="https://cdn.tailwindcss.com"></script>
        <script
            src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Reinitialiser le mot de passe - UrgenceSAMU</title>
</head>

<body>
    <main>
        <div class="grid min-h-screen md:grid-cols-2 bg-violet-50" style="background-color: #dadaff;">
            <div class="flex flex-col items-center justify-center " style="background-color: #3232a7;">
                <div class="relative z-10">
                    <h1 class="text-7xl my-4 font-bold text-white">UrgenceSAMU</h1>
                    <p class="text-white">Entrez dans la monde des équipes du SAMU</p>
                </div>
                <img src="../assets/images/3d-business-black-doctor-standing-with-clipboard-and-writing.png" alt="" class="absolute opacity-20 z-0"  srcset="">
            </div>
            <div class="fixed top-0 flex items-center justify-center w-full h-full p-3 md:p-0 md:relative">
                <form id="form" class="w-full p-10 m-auto bg-white rounded-md shadow-xl md:shadow-none " style="max-width: 456px;  ">
                    <div class="space-y-12">
                        <div class="pb-12 ">
                            <h2 class="text-2xl leading-7 text-gray-900">Password reset by email</h2>
                            <div class="grid grid-cols-1 gap-4 py-4 mt-4">
                                <p class="font-bold">We’ve sent a reset email to <a target="_blank" href="https://mail.google.com/" rel="" class="text-violet-500">email@email.com</a>
                                </p>
                                <div class="grid grid-cols-6 gap-2">
                                    <div>
                                        <input type="text" maxlength="1" id="number1"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="_" name="phone">
                                    </div>
                                    <div> <input type="text" maxlength="1" id="number2"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="_" name="phone"></div>
                                    <div> <input type="text" maxlength="1" id="number3"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="_" name="phone"></div>
                                    <div> <input type="text" maxlength="1" id="number4"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="_" name="phone"></div>
                                    <div> <input type="text" maxlength="1" id="number5"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="_" name="phone"></div>
                                    <div> <input type="text" maxlength="1" id="number6"
                                            class="w-full p-3 text-sm focus-visible:bg-violet-100/40 focus-visible:outline-violet-500 focus-visible:outline-1 focus-visible:placeholder:text-violet-500 rounded-xl bg-stone-100"
                                            placeholder="_" name="phone"></div>
                                </div>
                                <p class="text-sm text-stone-600">Didn’t get the code? <button type="button"
                                        class="text-violet-500" id="resend">Resend it</button></p>
                                <div id="loader" class="opacity-0">
                                    <img src="./../../assets/images/loader.svg" class=" animate-spin" alt="" srcset="">
                                </div>
                                <div id="resendMessage" class="hidden">
                                    The code will be sent in <span id="compteur"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="submitButton"
                            class="w-full p-3 my-2 text-sm text-white rounded-md focus-within:outline-4 focus-visible:outline-violet-400/70 disabled:bg-stone-700 bg-stone-950 hover:bg-stone-900">Submit</button>
                        <button type="button" class="text-sm text-violet-500" id="backButton">Retour</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    const resend = document.getElementById("resend");
    const loader = document.getElementById("loader");
    const compteur = document.getElementById("compteur");
    const resendMessage = document.getElementById("resendMessage");
    const submitButton = document.getElementById("submitButton");
    const number1 = document.getElementById("number1");
    const number2 = document.getElementById("number2");
    const number3 = document.getElementById("number3");
    const number4 = document.getElementById("number4");
    const number5 = document.getElementById("number5");
    const number6 = document.getElementById("number6");
    const backButton = document.getElementById("backButton");
    const form = document.getElementById("form");
    backButton.addEventListener('click', () => {
        history.back();
    })
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        window.location.href = "reset-password.html";
    })
    let completed = false;
    number1.focus();
    let i = 30;
    number1.addEventListener('input', () => {
        if (!completed)
            number2.focus();
    })
    number2.addEventListener('input', () => {
        if (!completed)
            number3.focus();
    })
    number3.addEventListener('input', () => {
        if (!completed)
            number4.focus();
    })
    number4.addEventListener('input', () => {
        if (!completed)
            number5.focus();
    })
    number5.addEventListener('input', () => {
        if (!completed)
            number6.focus();
    })
    number6.addEventListener('input', () => {
        if (!completed) {
            submitButton.focus();
            completed = true;
        }
    })



    resend.addEventListener('click', () => {
        loader.classList.remove('animate-rotate-out');
        loader.classList.add('animate-rotate-in');
        loader.classList.remove('opacity-0');
        loader.classList.add('opacity-100');
        submitButton.disabled = true;
        setTimeout(() => {
            loader.classList.remove('animate-rotate-in');
            loader.classList.add('animate-rotate-out');
            loader.classList.remove('opacity-100');
            loader.classList.add('opacity-0');
            loader.classList.add('hidden');
            resendMessage.classList.remove('hidden');
            let intervalResend = setInterval(() => {
                switch (i) {
                    case 1:
                        compteur.innerText = i + " second";
                        break;
                    case 0:
                        compteur.innerText = i + " second";
                        clearInterval(intervalResend);
                        submitButton.disabled = false;
                        number1.value = "";
                        number2.value = "";
                        number3.value = "";
                        number4.value = "";
                        number5.value = "";
                        number6.value = "";
                        completed = false;
                        number1.focus();
                        break;
                    default:
                        compteur.innerText = i + " seconds";
                        break;
                }
                i--;
            }, 1000);
        }, 3000);
    })


</script>

</html>