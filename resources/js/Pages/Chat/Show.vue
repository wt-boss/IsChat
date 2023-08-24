<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watchEffect, onMounted } from "vue";

const props = defineProps({
    messages: Object,
    user: Object,
    auth: Number,
    chat: Object,
});

const updatedMessages = ref(Object.values(props.messages));
const form = useForm({
    content: "",
    user_id: props.auth,
    chat_id: props.chat.id,
});

const send_message = () => {
    form.post("/message", {
        onSuccess: () => form.reset(),
        preserveScroll: true,
    });
};
onMounted(() => {
    const scrollbotom = document.getElementById("message-container");
    scrollbotom.scrollTo(0, scrollbotom.scrollHeight);
}),
    watchEffect(() => {
        window.Echo.private('chat.'+props.chat.id).listen(
            "NewMessage",
            (e) => {
                updatedMessages.value.push(e.message);
            }
        );
    });
    const online = ref(props.user.status == "ligne" ? "bg-green-600" : "bg-gray-400");

    const getStatus = async ()=>{
       const res = await axios.post('/user.handle.status', props.user);
        if(res.data.user_status){
            props.user.status=res.data.user_status
            if(res.data.user_status=='ligne'){
                online.value="bg-green-600"
            }
            else{
                online.value="bg-gray-400"
            }
            
        }
    }
    setInterval(
        ()=>{
            getStatus();
        },5000

    );
</script>

<template>
    <div class="bg-gray-100">
        <div class="flex items-center space-x-4 h-20 mx-auto max-w-7xl">
            <div class="flex-shrink-0 relative ml-2">
                <img
                    class="w-8 h-8 rounded-full"
                    src="../../../images/profile.png"
                    alt="Neil image"
                />
                <span
                    :class="
                        `border absolute top-6 left-6 border-gray-100  block w-2 h-2 rounded-full  ` +
                        online
                    "
                ></span>
            </div>
            <div class="flex-1 min-w-0">
                <p
                    class="text-sm font-medium text-gray-900 truncate dark:text-white"
                >
                    {{ user.name }}
                </p>
            </div>
        </div>
    </div>

    <div
        id="message-container"
        class="w-full message-container max-w-[1000px] mx-auto max-w-7xl overflow-y-auto h-[60vh] min-h-[100px] bg-white border-gray-500 border-solid dark:bg-gray-800 mt-1 text-gray-900"
    >
        <div class="messages mb-48">
            <div class="p-4" v-for="message in updatedMessages">
                <div
                    class="flex justify-start mb-1"
                    v-show="message.user_id == user.id"
                >
                    <p
                        class="sender bg-gray-100 w-3/5 flex items-center p-2 rounded-md max-w-[500px] max-w-[600px]"
                    >
                        {{ message.content }}
                    </p>
                </div>
                <div class="flex justify-end" v-show="message.user_id == auth">
                    <p
                        class="receiver bg-[#44e675] w-3/5 mb-1 flex justify-start items-center p-2 rounded-md max-w-[500px] max-w-[600px]"
                    >
                        {{ message.content }}
                    </p>
                </div>
            </div>
        </div>

        <div class="form p-8 fixed bottom-0 w-full w-full mx-auto max-w-7xl">
            <form class="space-x-2 flex" @submit.prevent="send_message">
                <input
                    v-model="form.content"
                    id="content"
                    name="content"
                    type="text"
                    class="block w-4/5 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
                <button
                    type="submit"
                    class="bg-[#1b3987] text-white w-10 h-10 rounded-full flex justify-center items-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 stroke-[#fff] m-0 p-0"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"
                        />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</template>

<style>
.message-container::-webkit-scrollbar {
    width: 5px;
}

/* Track */
.message-container::-webkit-scrollbar-track {
    background: #15181f1c;
    border-radius: 10px;
}

/* Handle */
.message-container::-webkit-scrollbar-thumb {
    background: #2a303f71;
    border-radius: 10px;

    height: 10px;
}

/* Handle on hover */
.message-container::-webkit-scrollbar-thumb:hover {
    background: #535864;
}
</style>
