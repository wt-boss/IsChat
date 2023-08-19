<script setup>
import SearchCard from "../../../Components/SearchCard.vue";
import { defineProps, ref } from "vue";
const props = defineProps({
    users: Object,
    searchState: Boolean,
});

defineEmits("handleSearch");

const regex = ref(null);
const filteredUser = ref(props.users);
console.log(props.users);
const filterUsers = () => {
    let filteredArray = [];

    for (const key in props.users) {
        
            const element = props.users[key];
            if (element.name.toLowerCase().includes(regex.value.toLowerCase())) {
            filteredArray.push(element);
        
            
        }
    }
    console.log(regex.value);

    filteredUser.value = filteredArray;
    console.log(filteredArray);
};
</script>
<template>
    <div
        v-show="searchState"
        class="bg-[#1b3987] newChat  w-full flex flex-col px-16 py-4 absolute -top-1 -left-1 min-h-[500px] h-full"
    >
        <div class="select-user mt-2">
            <div class="flex justify-start gap-4 items-center mb-4 text-white">
                <button
                    class="bg-gray-100 m-2 px-1 rounded-sm text-gray-900"
                    @click="$emit('handleSearch')"
                >
                    <svg
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"
                        />
                    </svg>
                </button>
                <span class="text-2xl">Nouvelle conversation</span>
            </div>
            <form action="" class="flex items-center gap-2">
                <input
                    type="search"
                    class="w-2/3 min-w-[200px] h-8 rounded-full bg-none"
                    v-model="regex"
                    @keyup="filterUsers"
                />
            </form>
        </div>
        <ul class="overflow-x-hidden search-card scrollbar-track:!rounded">
            <SearchCard :users="regex ? filteredUser : users"></SearchCard>
        </ul>
    </div>
</template>

<style scoped>
.search-card::-webkit-scrollbar {
    width: 5px;
}

/* Track */
.search-card::-webkit-scrollbar-track {
    background: #5281f87e;
    border-radius: 10px;
}

/* Handle */
.search-card::-webkit-scrollbar-thumb {
    background: #849cd8;
    border-radius: 10px;

    height: 10px;
}

/* Handle on hover */
.search-card::-webkit-scrollbar-thumb:hover {
    background: #3268f3;
}
</style>
