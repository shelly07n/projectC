<template>
    <div class="w-full my-3" v-if="source">
        <h5 class="mb-3 flex items-center text-base font-semibold text-gray-900 md:text-lg ">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                </svg>
            </span>
            <span>
                Leaderboard
            </span>
        </h5>
        <div class="grid grid-cols-3 gap-2" v-if="source ? source.length > 0 : null">
            <div class="bg-white rounded-lg border p-2" v-for="(status, index) in source">
                <div class="flex justify-between px-2">
                    <div class="flex items-center">
                        <div
                            class="flex items-center justify-center w-6 h-6 ml-auto overflow-hidden rounded-full cursor-pointer mx-2">
                            <img src="https://assets.codepen.io/5041378/internal/avatars/users/default.png?fit=crop&format=auto&height=512&version=1600304177&width=512"
                                alt="">
                        </div>
                        <div v-if="status">
                            {{ status.name }}
                        </div>
                    </div>
                    <div>
                        ..
                    </div>
                </div>
                <div class="text-center my-2">
                    <span class="mb-3 text-base font-semibold text-gray-900 md:text-4xl" v-if="status">{{ status.current_position
                    }}</span>
                    <span class="mb-3 text-base font-semibold text-gray-900 md:text-xl">/</span>
                    <span class="mb-3 text-base font-semibold text-gray-900 md:text-xl"  v-if="status">{{ status.start_position }}</span>
                    <p class="font-medium">Status</p>
                </div>
            </div>
        </div>
        <div v-else class="bg-white rounded-lg border p-2 ">
            <p>There is no information available for presentation</p>
        </div>
    </div>
</template>


<script setup>

import { useRouter, useRoute } from "vue-router";
import { onMounted, ref } from 'vue';
import axios from "axios";
const router = useRouter();
const route = useRoute();

const props = defineProps({
    source: {
        type: Object,
        required: true,
    },
    // index: {
    //     type: Number,
    //     required: true,
    // },
});




</script>

<style>
* {
    font-size: 62, 5%;
    box-sizing: border-box;
    margin: 0;
}



main {
    height: 15rem;
    background-color: #ffffff;
    -webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
    box-shadow: 0px 5px 15px 8px #e4e7fb;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 0.5rem;
}

#header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 2.5rem 2rem;
}

.share {
    width: 4.5rem;
    height: 3rem;
    background-color: #f55e77;
    border: 0;
    border-bottom: 0.2rem solid #c0506a;
    border-radius: 2rem;
    cursor: pointer;
}

.share:active {
    border-bottom: 0;
}

.share i {
    color: #fff;
    font-size: 2rem;
}

h1 {
    font-family: "Rubik", sans-serif;
    font-size: 1.7rem;
    color: #141a39;
    text-transform: uppercase;
    cursor: default;
}

#leaderboard {
    width: 100%;
    position: relative;
}

table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    color: #141a39;
    cursor: default;
}

tr {
    transition: all 0.2s ease-in-out;
    border-radius: 0.2rem;
}

tr:not(:first-child):hover {
    background-color: #fff;
    transform: scale(1);
    -webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
    box-shadow: 0px 5px 15px 8px #e4e7fb;
    z-index: 9999;
}

tr:nth-child(odd) {
    background-color: #f9f9f9;
}

tr:nth-child(1) {
    color: #fff;
}

td {
    height: 1rem;
    font-family: "Rubik", sans-serif;
    font-size: 1rem;
    padding: 0.2rem 1rem;
    position: relative;
}

.number {
    width: 1rem;
    font-size: 2.2rem;
    font-weight: bold;
    text-align: left;
}

.name {
    text-align: left;
    font-size: 1.2rem;
}

.points {
    font-weight: bold;
    font-size: 1.3rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    position: relative;
    top: 20px;

}

.points:first-child {
    width: 10rem;
}

.gold-medal {
    height: 3rem;
    margin-left: 1.5rem;
}

.ribbon {
    width: 100%;
    height: 3.5rem;
    top: -0.25rem;
    background-color: #5c5be5;
    position: absolute;
    left: -4px;
    -webkit-box-shadow: 0px 15px 11px -6px #7a7a7d;
    box-shadow: 0px 15px 11px -6px #7a7a7d;
}

.ribbon::before {
    content: "";
    height: 1.5rem;
    width: 1.5rem;
    bottom: -0.8rem;
    left: 0.35rem;
    transform: rotate(45deg);
    background-color: #5c5be5;
    position: absolute;
    z-index: -1;
}

.ribbon::after {
    content: "";
    height: 1.5rem;
    width: 1.5rem;
    bottom: -0.8rem;
    right: 0.35rem;
    transform: rotate(45deg);
    background-color: #5c5be5;
    position: absolute;
    z-index: -1;
}

@media (max-width: 740px) {
    * {
        font-size: 70%;
    }
}

@media (max-width: 500px) {
    * {
        font-size: 55%;
    }
}

@media (max-width: 390px) {
    * {
        font-size: 45%;
    }
}
</style>
