<script setup>
import { Link } from '@inertiajs/vue3';

    const props=defineProps({
        name:String,
        lastMessage:String,
        nombreMessage:Number,
        user:Number,
        chat:Number
    })

</script>

<template>
    <li class="py-3 sm:py-4">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                <img
                    class="w-8 h-8 rounded-full"
                    src="../../images/profile.png"
                    alt="Neil image"
                />
            </div>
            <Link :href="`/chat/${chat}`"  class="w-full flex lg:justify-start lg:gap-16">
               
                <div class="f  w-2/5">
                    <p
                        class="text-sm font-medium text-gray-900 truncate dark:text-white"
                    >
                        {{name}}
                    </p>
                    <p
                        class="text-sm text-gray-500 truncate dark:text-gray-400"
                    >
                       {{lastMessage}}
                    </p>
                </div>
                <div class="">
                    <div
                    class="inline-flex items-center w-6 h-6 justify-center text-base rounded-full font-semibold text-gray-100 bg-green-600 dark:text-white"
                >
                    {{nombreMessage}}
                </div>
                </div>

            </Link>
        </div>
    </li>
</template>

<style></style>
