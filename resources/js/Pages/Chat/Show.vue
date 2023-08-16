<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watchEffect } from "vue";

const props = defineProps({
    messages: Object,
    user: Object,
    auth: Number,
});

const updatedMessages = ref(Object.values(props.messages));
console.log(updatedMessages.value)
const form = useForm({
    content: "",
    user_id: props.auth,
    chat_id: props.messages[0].chat_id,
});

const send_message = () => {
    form.post("/message", {
        onSuccess: () => form.reset(),
        preserveScroll: true,
    });
};

watchEffect(() => {
    window.Echo.private("chat").listen("NewMessage", (e) => {
        updatedMessages.value.push(e.message);
        console.log(e.message);
        console.log(updatedMessages.value);
    });
    console.log("bonjour");
    //console.log(updatedMessages);
});
</script>

<template>
    <div class="bg-gray-100">
        <div class="flex items-center space-x-4 h-20 mx-auto max-w-7xl">
            <div class="flex-shrink-0 ml-2">
                <img
                    class="w-8 h-8 rounded-full"
                    src="../../../images/profile.png"
                    alt="Neil image"
                />
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
        class="w-full mx-auto max-w-7xl min-h-screen bg-white border-gray-500 border-solid dark:bg-gray-800 pb-16 "
    >
        <div class="messages mb-48">
            <div class="sm:p-4" v-for="message in updatedMessages">
                <div
                    class="flex justify-start mb-1"
                    v-show="message.user_id == user.id"
                >
                    <p
                        class="sender bg-gray-100 w-3/5 flex items-center p-4 rounded-md"
                    >
                        {{ message.content }}
                    </p>
                </div>
                <div class="flex justify-end" v-show="message.user_id == auth">
                    <p
                        class="receiver bg-green-500 w-3/5 mb-1 flex justify-start items-center p-4 rounded-md"
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
                <button type="submit" class="bg-[#1b3987] text-white w-1/5">
                    Send
                </button>
            </form>
        </div>
    </div>
</template>

<style></style>
