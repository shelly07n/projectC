<template>
    <div class="w-full" v-if="source">
        <h5 class="mb-3 flex items-center text-base font-semibold text-gray-900 md:text-lg">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                  </svg>

            </span>
            <span  class="mx-2">
                My status
            </span>
             </h5>
        <div class="grid grid-cols-3 gap-2"  v-if="source ? source.length > 0 : null">
            <div class="bg-white rounded-lg border p-2" v-for="(status,index) in source">
                <div class="flex justify-between px-2">
                    <div class="flex items-center">
                        <div
                            class="flex items-center justify-center w-6 h-6 ml-auto overflow-hidden rounded-full cursor-pointer mx-2">
                            <img src="https://assets.codepen.io/5041378/internal/avatars/users/default.png?fit=crop&format=auto&height=512&version=1600304177&width=512"
                                alt="">
                        </div>
                        <div>
                            <!-- <p class="font-bold text-md text-gray-900 "></p> -->
                            {{ status.name }}
                        </div>
                    </div>
                    <div>
                        ..
                    </div>
                </div>
                <div class="text-center my-2">
                    <span class="mb-3 text-base font-semibold text-gray-900 md:text-4xl">{{ status.current_position }}</span>
                    <span class="mb-3 text-base font-semibold text-gray-900 md:text-xl">/</span>
                    <span class="mb-3 text-base font-semibold text-gray-900 md:text-xl">{{ status.start_position }}</span>
                    <p class="font-medium">Status</p>
                </div>
            </div>
        </div>
        <div v-else>
            <p>No data</p>
        </div>
    </div>

</template>


<script setup>

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
