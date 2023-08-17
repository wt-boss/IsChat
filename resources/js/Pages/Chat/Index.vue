<script setup>
import Card from "../../Components/Card.vue";
import CreateChat from "./chatComponents/CreateChat.vue";
const props = defineProps({
    chats_users: {
        type: Array,
    },
    last_messages: {
        type: Array,
    },
    users:{
        type:Array
    }
});
</script>

<template>
    <div
        class="mx-auto max-w-7xl h-screen p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 relative"
    >
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
                    :user="value.id"
                    :chat="key"
                ></Card>
            </ul>
        </div>

        <CreateChat :users="users"></CreateChat>
    </div>
</template>
<style lang="scss" scoped></style>
