<script setup>
import Card from "../../Components/Card.vue";
import CreateChat from "./chatComponents/CreateChat.vue";
import { ref } from "vue";
const props = defineProps({
    chats_users: {
        type: Object,
    },
    last_messages: {
        type: Object,
    },
    users: {
        type: Array,
    },
    chat_id:{
        type:Array
    }
});

console.log(props.users);

const searchState = ref(false);
const handleSearch = () => {
    searchState.value = !searchState.value;
};


</script>

<template>
    <div
        class="mx-auto max-w-7xl h-screen p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 relative"
    >
        <div class="create-chat flex items-center gap-10 ">
            <span class=" text-[#1b3987] text-3xl font-black">IS CHAT</span>

            <button
                v-show="!searchState"
                @click="handleSearch"
                type=" button"
                class="create-button rounded-full m-0 p-0 text-white w-8 h-8 text-2xl  bg-[#1b3987] flex justify-center items-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 fill-white"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v12m6-6H6"
                    />
                </svg>
            </button>
        </div>
        <div class="flow-root">
            <ul
                class="divide-y divide-gray-200 dark:divide-gray-700"
                v-for="(value, key, index) in props.chats_users"
                :key="value"
            >
                <Card
                    :name="value.name"
                    :lastMessage="last_messages[key]"
                    :nombreMessage="10"
                    :user="value"
                    :chat="chat_id[key]"
                ></Card>
            </ul>
        </div>

        <CreateChat
            :users="users"
            :searchState="searchState"
            @handleSearch="handleSearch"
        ></CreateChat>
    </div>
</template>
<style lang="scss" scoped></style>
