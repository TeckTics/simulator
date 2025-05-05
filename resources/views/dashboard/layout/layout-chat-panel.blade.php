<div class=" relative w-full p-2 overflow-hidden  justify-center items-center  md:inset-0 ">

    <div class="relative  rounded-sm ">
        <div class="p-4 md:p-5 ">
            <h3 class=" font-semibold text-center text-white uppercase ">
                Chattez avec l'alliance <span id="title-chat"></span>
            </h3>
        </div>
        <div class="  rounded-sm">
            <div id="messagesContainer" style="max-height: 500px"
                class="body-message  p-2 overflow-y-auto rounded-md  bg-[#1a2539] text-white ">
                <div class="chat-messages  text-[#1a2539] gap-2 min-h-screen flex flex-col " id="MessageSentContent">

                </div>
            </div>
            <div id="messagesContainer-alliance" style="max-height: 500px"
                class="body-message  p-2 overflow-y-auto rounded-md  bg-[#1a2539] text-white ">
                <div class="chat-messages  text-[#1a2539] gap-2 min-h-screen flex flex-col "
                    id="MessageSentContent-alliance">

                </div>
            </div>
            <div class="footer-messager  mt-4">
                <form class="flex flex-col" id="chat-form" method="post">
                    @csrf
                    <textarea type="text" name="content" required id="message-input" class="form-control rounded-md text-xs"
                        placeholder="Votre message"></textarea>
                    {{-- 
                    <button id="chat-message-submit" type="submit"
                        class="btn  p-2  text-white transition-all items-center border-white border-2 flex flex-row gap-2  text-sm justify-center from-blue-700 bg-gradient-to-t rounded-lg w-full mt-2 hover:bg-blue-600 bg-blue-500 font-semibold ">
                        <span>Envoyer</span></button> --}}
                    <button name="base-list" id="button-chat"
                        class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-white hover:bg-[#15244c]  hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white  text-center text-sm transition-all cursor-pointer">
                        <span>Envoyer</span>
                    </button>
                </form>
                <form class="flex flex-col" id="chat-form-alliance" method="post">
                    @csrf
                    <textarea type="text" name="content" required id="message-input-alliance" class="form-control rounded-md text-xs"
                        placeholder="Votre message"></textarea>
                    {{-- 
                    <button id="chat-message-submit" type="submit"
                        class="btn  p-2  text-white transition-all items-center border-white border-2 flex flex-row gap-2  text-sm justify-center from-blue-700 bg-gradient-to-t rounded-lg w-full mt-2 hover:bg-blue-600 bg-blue-500 font-semibold ">
                        <span>Envoyer</span></button> --}}
                    <button name="base-list" id="button-chat-alliance"
                        class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-white hover:bg-[#15244c]  hover:fill-blue-500 flex items-center h-full text-[#15244c] font-bold hover:text-white  text-center text-sm transition-all cursor-pointer">
                        <span>Envoyer</span>
                    </button>
                </form>
                <button name="base-list" id="view-chat-alliance"
                    class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-orange-500 hover:bg-white  hover:fill-blue-500 flex items-center h-full text-white font-bold hover:text-orange-500  text-center text-sm transition-all cursor-pointer">
                    <span>Chatter avec alliance</span><span id="clan-name-chat"></span>
                </button>
                <button name="base-list" id="view-chat-generale"
                    class=" gap-2 rounded-xl p-3 mt-4 w-full justify-center fill-white bg-[#15244c] hover:bg-white  hover:fill-blue-500 flex items-center h-full text-white font-bold hover:text-[#15244c]  text-center text-sm transition-all cursor-pointer">
                    <span>Chat Générale</span>
                </button>
            </div>
            {{-- <form class="p-4">
                <button type="submit" class="btn w-full py-3 btn-secondary text-xs mt-1" value="">Chat de
                    groupe</button>
                <form> --}}
            {{-- <form class="p-4">
        <button type="submit" class="btn w-full btn-secondary text-xs mt-1"
            value="">Chat de groupe</button>
        <form> --}}
        </div>
    </div>
</div>
