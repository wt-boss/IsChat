<script setup>
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import { watchEffect, ref } from "vue";

const props = defineProps({
    name: String,
    lastMessage: String,
    nombreMessage: Number,
    user: Object,
    chat: Number,
});

const online = ref(props.user.status == "ligne" ? "bg-green-600" : "bg-gray-400");
const message = ref('');
const listen = ref(false);

/*     watchEffect(() => {
        window.Echo.private('user.status.6').listen(
            "UserStatusEvent",
            (e) => {
                console.log('bonjour');
                message.value=e.user
                console.log(message.value)
            }
        );
    }); */
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
    <li class="py-3 sm:py-4">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 relative">
                <img
                    class="w-8 h-8 rounded-full"
                    src="../../images/profile.png"
                    alt="Neil image"
                />
                <span
                    :class="
                        `border absolute top-6 left-6 border-gray-100  block w-2 h-2 rounded-full  ` +
                        online
                    "
                ></span>
            </div>
            <Link
                :href="`/chat/${chat}`"
                class="w-full flex lg:justify-start lg:gap-16"
            >
                <div class="f w-2/5">
                    <p
                        class="text-sm font-medium text-gray-900 truncate dark:text-white"
                    >
                        {{ name }}
                    </p>
                    <p
                        class="text-sm text-gray-500 truncate dark:text-gray-400"
                    >
                        {{ lastMessage }}
                    </p>
                </div>
                <div class="">
                    <div
                        class="inline-flex items-center w-6 h-6 justify-center text-base rounded-full font-semibold text-gray-100 bg-green-600 dark:text-white"
                    >
                        {{ nombreMessage }}
                    </div>
                </div>
            </Link>
        </div>
    </li>
</template>

<style></style>
