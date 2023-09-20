<template>
    <!-- component -->
    <section class="flex flex-col md:flex-row h-screen items-center">

        <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <!-- <img src="https://source.unsplash.com/random" alt="" class="w-full h-full object-cover"> -->
            <img src="https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80"
                alt="" class="w-full h-full object-cover">
        </div>

        <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">

            <div class="w-full h-100">


                <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Register your account</h1>

                <div class="mt-6">
                    <div>
                        <label class="block text-gray-700">Name</label>
                        <input v-model="user.name" type="text" name="" id="" placeholder="Enter Name"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            autofocus autocomplete required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700">Email Address</label>
                        <input v-model="user.email" type="email" name="" id="" placeholder="Enter Email Address"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            autofocus autocomplete required>
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700">Password</label>
                        <input type="password" name="" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required v-model="user.password">
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700">Confirm Password</label>
                        <input type="password" name="" id="" placeholder="Enter Confirm Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none" required v-model="user.confirmPassword">
                    </div>

                    <button class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg
                px-4 py-3 mt-6" @click="register()">Log In</button>
                </div>

                <hr class="my-6 border-gray-300 w-full">


            </div>
        </div>

    </section>xzx
</template>


<script setup>
import { useRouter, useRoute } from "vue-router";
import axios from 'axios'
import { reactive } from 'vue'

const user = reactive({
    name: "",
    email: "",
    password: "",
    confirmPassword:""
})

const router = useRouter();



const register = () => {

    try {
        axios.post('/api/register', user).then(response => {
            const { access_token } = response.data;
            console.log(access_token);
            localStorage.setItem('access_token', access_token);
            router.push('/login');
        });


    } catch (error) {
        console.error('Login failed:', error);
    }
}
</script>

<style>
.st0 {
    fill: none;
    stroke: currentColor;
    stroke-width: 20;
    stroke-linecap: round;
    stroke-miterlimit: 3;
}
</style>
