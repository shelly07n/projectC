<template>
   <div id="app">
      <!--Sidebar with Dimmer -->
      <div class="flex flex-row h-screen fixed w-screen">
         <!-- Sidebar -->
         <div>
            <sidebar />
         </div>
         <!-- Page Content -->
         <div class="bg-gray-100  text-gray-700 h-screen w-[100%] ">
            <div class="w-[100%]">
               <topbar />
            </div>
            <div class="h-screen w-[100%]  p-2 pb-36 overflow-auto">
               <RouterView></RouterView>
            </div>
         </div>
      </div>
   </div>
</template>



<script setup>

import { ref } from 'vue'
import sidebar from './sidebar.vue';
import topbar from './topbar.vue';


const selectedCity = ref();
const cities = ref([
   { name: 'New York', code: 'NY' },
   { name: 'Rome', code: 'RM' },
   { name: 'London', code: 'LDN' },
   { name: 'Istanbul', code: 'IST' },
   { name: 'Paris', code: 'PRS' }
]);


</script>
 
<style>
.fade-enter-active,
.fade-leave-active {
   transition: opacity 1s ease-out;
}

.fade-enter,
.fade-leave-to {
   opacity: 0;
}
</style>

<style>
html {
   background: #efefef;
}

.fade-enter-active,
.fade-leave-active {
   transition: opacity 1s ease-out;
}

.fade-enter,
.fade-leave-to {
   opacity: 0;
}
</style>
