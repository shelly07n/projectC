<template>
    <div class="min-h-screen py-20 px-10 bg-gray-100">
      <div class="grid grid-cols-1 gap-20 lg:grid-cols-2 lg:gap-10">
        <!-- Circular Progress Bar 1 -->
        <div
          class="flex items-center flex-wrap max-w-md px-10 bg-white shadow-xl rounded-2xl h-20"
          :data="{ circumference: 50 * 2 * Math.PI, percent: 80 }"
        >
          <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
            <svg class="w-32 h-32 transform translate-x-1 translate-y-1" aria-hidden="true">
              <circle
                class="text-gray-300"
                stroke-width="10"
                stroke="currentColor"
                fill="transparent"
                r="50"
                cx="60"
                cy="60"
              />
              <circle
                class="text-blue-600"
                stroke-width="10"
                :stroke-dasharray="circumference"
                :stroke-dashoffset="circumference - percent / 100 * circumference"
                stroke-linecap="round"
                stroke="currentColor"
                fill="transparent"
                r="50"
                cx="60"
                cy="60"
              />
            </svg>
            <!-- <span class="absolute text-2xl text-blue-700" :textContent="`${percent}%`"></span> -->
            <span class="absolute text-2xl text-blue-700">100%</span>
          </div>
          <p class="ml-10 font-medium text-gray-600 sm:text-xl">Performance</p>
          <span class="ml-auto text-xl font-medium text-blue-600 hidden sm:block">+25%</span>
        </div>

        <!-- Circular Progress Bar 2 -->
        <div
          class="flex items-center flex-wrap max-w-md px-10 bg-white shadow-xl rounded-2xl h-20"
          :data="{ circumference: 50 * 2 * Math.PI, percent: 90 }"
        >
          <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
            <svg class="w-32 h-32 transform translate-x-1 translate-y-1" aria-hidden="true">
              <circle
                class="text-gray-300"
                stroke-width="10"
                stroke="currentColor"
                fill="transparent"
                r="50"
                cx="60"
                cy="60"
              />
              <circle
                class="text-red-600"
                stroke-width="10"
                :stroke-dasharray="circumference"
                :stroke-dashoffset="circumference - percent / 100 * circumference"
                stroke-linecap="round"
                stroke="currentColor"
                fill="transparent"
                r="50"
                cx="60"
                cy="60"
              />
            </svg>
            <!-- <span class="absolute text-2xl text-red-700" :textContent="`${percent}%`"></span> -->
            <span class="absolute text-2xl text-red-700">100%</span>
          </div>
          <p class="ml-10 font-medium text-gray-600 sm:text-xl">Storage</p>
          <span class="ml-auto text-xl font-medium text-red-600 hidden sm:block">20GB</span>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        // Data properties can be defined here if needed
      };
    },
  };
  </script>

  <style scoped>
  /* Your CSS styles can be placed here */
  </style>
