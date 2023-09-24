<template>
    <!-- Card -->
    <div class="max-w-full  bg-purple-50 shadow-lg rounded-lg" >
        <div class="p-2">
            <div class="flex items-start">
                <!-- Icon -->
                <svg class="fill-current flex-shrink-0 mr-5" width="30" height="30" viewBox="0 0 30 30">
                    <path class="text-indigo-300" d="m16 14.883 14-7L14.447.106a1 1 0 0 0-.895 0L0 6.883l16 8Z" />
                    <path class="text-indigo-200" d="M16 14.619v15l13.447-6.724A.998.998 0 0 0 30 22V7.619l-14 7Z" />
                    <path class="text-indigo-500" d="m16 14.619-16-8V21c0 .379.214.725.553.895L16 29.619v-15Z" />
                </svg>
                <!-- Card content -->
                <div class="flex-grow truncate">
                    <!-- Card header -->
                    <div class="w-full sm:flex justify-between items-center mb-3">
                        <!-- Title -->
                        <h2 class="text-xl leading-snug font-extrabold text-black truncate mb-1 sm:mb-0">Daily Simple
                            Tips</h2>
                        <!-- Like and comment buttons -->
                        <div class="flex-shrink-0 font-semibold flex items-center text-sm space-x-3 sm:ml-2">
                            {{quotes ? quotes.tags[0] : 'Life' }}
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="flex items-end justify-between whitespace-normal">
                        <!-- Paragraph -->
                        <div class="max-w-md text-gray-700 font-medium">

                            <p class="mb-2 text-sm">{{quotes ? quotes.content : 'Do it again and again until you win'}}</p>
                            <p class="mb-2 float-right font-semibold">- {{quotes ? quotes.author : 'ME'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import {ref,onMounted} from 'vue'
const quotes = ref()
const getQuotes = () =>{
    let url = 'https://api.quotable.io/random'
    axios.get(url).then(res=>{
        quotes.value = res.data
    })
}

onMounted(() => {
    getQuotes()
})
</script>
