<script setup>
import Card from "../../Components/Card.vue";
const props = defineProps({
    chats_users: {
        type: Object,
       },
       last_messages:{
         type:Array,
       }
});


</script>

<template>
    <div
        class="mx-auto max-w-7xl h-screen p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
        <div class="flow-root">
            <ul
                role="list"
                class="divide-y divide-gray-200 dark:divide-gray-700"
                v-for="(value, key, index) in props.chats_users" :key="value"
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
    </div>
</template>
<style lang="scss" scoped></style>
