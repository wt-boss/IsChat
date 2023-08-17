<script setup>
import SearchCard from "../../../Components/SearchCard.vue";
defineProps({
    users:Object,
}
    
)
</script>
<template >
    <div class="create-chat" >
        <button
            type=" button"
            class="create-button w-8 fixed bottom-[25%] text-7xl right-16"
        >
            +
        </button>
    </div>
    <div class="bg-[#1b3987]  sm:w-1/2 w-full flex flex-col p-16 absolute -top-1 -left-1 min-h-[500px] h-1/2 ">
        <div class="select-user mt-2">
            <form action="">
                <input type="search" class="w-2/3 min-w-[200px] h-8 rounded-full " />
                <button type="submit" class="bg-gray-900 m-2 px-1 rounded-lg text-white">Search</button>
            </form>
        </div>
        <ul class="overflow-auto">
            <SearchCard :users="users"></SearchCard>
        </ul>
    </div>
</template>

<style scoped></style>
