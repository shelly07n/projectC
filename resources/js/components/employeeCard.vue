<template>
    <!-- {{ source }} -->
    <div class="w-[180px] p-2 bg-white rounded-lg" v-if="source">
        <div class="flex justify-between">
            <div class="">
                <div class="flex justify-end mx-2" >
                    <button >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-600 font-semibold">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                          </svg>
                    </button>
                </div>
                <!-- Dropdown menu -->
            </div>
            <div class="rounded-sm h-4"  :class="[source.status == 'Sent' ? 'bg-green-50 border-green-400 border rounded-sm h-4  text-green-600' : 'bg-red-50 border-red-400 border rounded-sm h-4  text-red-600']" >
                <p class="text-[10px] px-2 font-medium">{{ source.status }}</p>
            </div>
        </div>
        <div class="mt-6">
            <div class="flex justify-center">
                <div v-if="source.image" class="rounded-full  p-2 h-16 w-16 flex justify-center items-center">
                    <img :src="source.image" alt="">
                </div>
                <div v-else class="rounded-full  p-2 h-16 w-16 flex justify-center items-center"
                    :class="`${getBackgroundColor(index)}`">
                    <p class="text-gray-900 font-bold text-xl mb-2">
                        {{ source.name.charAt(0) + source.name.charAt(0) }}
                    </p>
                </div>
            </div>
            <p class="text-gray-900 font-bold text-md text-center ">{{ source.name }}</p>

            <div class="bg-gray-50 p-2  rounded-lg mt-2">
                <div class="flex justify-between gap-4">
                    <div>
                        <p class="text-gray-600 text-center text-[10px]">Relationship</p>
                        <p class="text-gray-900 font-semibold text-xs">{{ source.relationship }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-center text-[10px]">dob</p>
                        <p class="text-gray-900 font-semibold text-xs">23-09-2001</p>
                    </div>
                </div>
                <p class="text-gray-900 font-semibold text-[10px] my-1">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                      </svg> -->
                      {{ source.email }}</p>
                <p class="text-gray-900 font-semibold text-[10px]">{{ source.mobile }}</p>
            </div>
        </div>
    </div>
<!--
    <div id="dropdown"
        class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2" aria-labelledby="dropdownButton">
            <li>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export
                    Data</a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
            </li>
        </ul>
    </div> -->
</template>

<script setup>
import { contactMainStore } from '../modules/contacts/stores/contactMainStore'


const usestore = contactMainStore()

const props = defineProps({
    source: {
        type: Object,
        required: true,
    },
    index: {
        type: Number,
        required: true,
    },
});


const colors = [
    'bg-orange-50',
    'bg-emerald-50',
    'bg-yellow-50',
    'bg-rose-50',
    'bg-cyan-50',
    'bg-amber-50',
    'bg-red-50',
    'bg-blue-50',
    'bg-pink-50',
    'bg-green-50',
    'bg-fuchsia-50',
];

const getBackgroundColor = (index) => {
    return colors[index % colors.length];
};
</script>
