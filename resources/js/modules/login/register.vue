<template>
    <spinner v-if="canShowSpinner" />
    <!-- component -->
    <section class="flex  flex-col md:flex-row h-screen items-center ">
        <div class=" hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <!-- <img src="https://source.unsplash.com/random" alt="" class="w-full h-full object-cover"> -->
            <img src="../../assets/register.svg"
                alt="" class="w-full h-full ">
        </div>

        <div class="bg-white w-full  md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 max-h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">

            <div class="w-full">
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

                    <button class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg
                px-4 py-3 mt-6" @click="register()">Register</button>
                </div>

                <hr class="my-6 border-gray-300 w-full">


            </div>
        </div>

    </section>
</template>


<script setup>
import { useRouter, useRoute } from "vue-router";
import axios from 'axios'
import { reactive, ref } from 'vue'
import Swal from "sweetalert2";
import spinner from '../../components/spinner.vue'

const canShowSpinner = ref(false)


const user = reactive({
    name: "",
    email: "",
    password: "",
    confirmPassword:""
})

const router = useRouter();



const register = () => {
    try {
        canShowSpinner.value = true
        axios.post('/api/register', user).then(response => {
            router.push('/login');
            Swal.fire({
                title: 'Registration successfully',
                icon: 'success',
                customClass: {
                    title: 'my-custom-title-class',
                },
                showClass: {
                    popup: 'animate__animated animate__bounceIn'
                },
                hideClass: {
                    popup: 'animate__animated animate__bounceOut'
                }
            }).finally(()=>{
                canShowSpinner.value = false
            })

        }).catch(err => {
            console.log(err.response.data);
            Swal.fire({
                title: 'Access denied',
                text:err.response.data.line ,
                icon: 'error',
                customClass: {
                    title: 'my-custom-title-class',
                },
                showClass: {
                    popup: 'animate__animated animate__bounceIn'
                },
                hideClass: {
                    popup: 'animate__animated animate__bounceOut'
                }
            }).finally(()=>{
                canShowSpinner.value = false
            })


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
/* Define the custom class and style the title */
.my-custom-title-class {
    font-size: 22px;
    /* Adjust the font size to your preference */
}
</style>
