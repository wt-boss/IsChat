<template>
    <div
        class="w-full h-screen bg-white border-gray-500 border-solid rounded-lg shadow border-b-2 dark:bg-gray-800 dark:border-gray-700"
    >
        <div class="flex items-center space-x-4 h-20 bg-gray-100">
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
                    Jhon doe
                </p>
            </div>
        </div>
        <div class="messages sm:p-8">
            <div class=" flex justify-start mb-4 ">
                <p class="sender bg-gray-100 w-2/3 flex items-center p-4 rounded-md">
                    message destinataire
                </p>
            </div>
            <div class="flex justify-end  ">
                <p class="receiver bg-green-500 w-2/3 block mb-4 flex justify-start items-center p-4 rounded-md ">
                    message current user
                </p>
            </div>
        </div>

        <div class="form p-8">

            <form action="" class="space-x-2 flex ">
                
                        <input
                            id="name"
                            name="name"
                            type="text"
                
                           
                            class="block w-4/5  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        />
                        <button type="submit" class="bg-[#1b3987] text-white w-1/5">Send</button>
            </form>

        </div>
    </div>
</template>

<script setup></script>

<style></style>
