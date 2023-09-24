<template>
    <div id="app" v-if="source">
        <transition name="fade">
            <div v-if="isOpen">
                <div @click="onToggle" class="absolute bg-black opacity-70 inset-0 z-0"></div>
                <div class="w-full max-w-lg p-3 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
                    <div>
                        <div class="text-center p-3 flex-auto justify-center leading-6">
                            <div class="success-animation">
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                </svg>
                            </div>
                            <h2 v-if="source.status == 200" class="text-2xl font-bold py-4">Successful!</h2>
                            <h2  v-else class="text-2xl font-bold py-4">Failure!</h2>
                            <p class="text-md text-gray-500 px-8">
                                <!-- Successfully sent an email to <span class="font-semibold text-lg text-black">{{source}}</span>. -->
                                 {{ source.Message }}
                            </p>
                        </div>
                        <div class="p-3 mt-2 text-center space-x-4 md:block">
                            <button @click="onToggle"
                                class="mb-2 md:mb-0 bg-purple-500 border border-purple-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-md hover:shadow-lg hover:bg-purple-600">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref } from 'vue'
const isOpen = ref(true)



const props = defineProps({
    source: {
        type: Object,
        required: true,
    },
});


const onToggle = () => {
    isOpen.value = !isOpen.value;
}

</script>
<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 500ms ease-out;
}

.success-animation {
    margin: 10px auto;
}

.checkmark {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #4bb71b;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #4bb71b;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    position: relative;
    top: 5px;
    right: 5px;
    margin: 0 auto;
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #4bb71b;
    fill: #fff;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;

}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {

    0%,
    100% {
        transform: none;
    }

    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #4bb71b;
    }
}
</style>
