<script setup>
import { Link } from "@inertiajs/vue3";
const props= defineProps({
    users:{
        type:Object || Array,
    },
});

console.log(props.users)

</script>

<template >
    
    <li class="py-3 sm:py-4" v-for="user in users">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                <img
                    class="w-8 h-8 rounded-full"
                    src="../../images/profile.png"
                    alt="Neil image"
                />
            </div>
            <Link :href="`/chat`" method="post" as="button" :data="user" class="w-full flex text-start  ">
                <div class="flex-4 w-4/5">
                    <p
                        class="text-sm font-medium text-gray-100 truncate dark:text-white"
                    >
                        {{ user['name'] }}
                    </p>
                    <p
                        class="text-sm text-gray-100 truncate dark:text-gray-400"
                    >
                        {{ user['email']}}
                    </p>
                </div>
            </Link>
        </div>
    </li>

    
</template>

<style></style>
