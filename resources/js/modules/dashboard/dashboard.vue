<template>
    <!-- component -->
    <div v-if="false"
        class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        id="modal-id">
        <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
        <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div class="">
                <!--body-->
                <div class="text-center p-3 flex-auto justify-center">
                    <h3 class="text-xl font-semibold  ">Enter Who Refer You </h3>
                    <img src="../../assets/referFriend.svg" alt="" class="w-72 mx-auto">
                    <!-- <p class="text-sm text-gray-500 px-8">Do you really want to delete your account?
                        This process cannot be undone</p> -->
                </div>
                <div>
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">
                        Referral code</label>
                    <input class="appearance-none border rounded-lg w-full py-2 px-3 text-grey-darker" id="last_name"
                        type="text" placeholder="Referral code">
                </div>
                <!--footer-->
                <div class="p-3  mt-2 text-center space-x-4 md:block">
                    <button @click="referDialog = false"
                        class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                        Cancel
                    </button>
                    <button @click="useStore.referralCode('sheltonUZ0llVXqH0ton')"
                        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <button @click="useStore.createContest('sheltonFknKSgLsH3ton')"
        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Submit</button>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { dashboardMainStore } from './stores/dashboardMainStore'
import jwt_decode from 'jwt-decode';

const useStore = dashboardMainStore()


const decodedToken = ref(null);


const decodeToken = () => {
    const token = localStorage.getItem('access_token');

    try {
        const decoded = jwt_decode(token);

        // Display the decoded token
        decodedToken.value = decoded;
        useStore.decodedToken = decoded;
        useStore.contestant.id = decoded.user_id
        useStore.contestant.name = decoded.user_name
        console.log(decoded);
        if (decoded.exp < Date.now() / 1000) {
            // Token has expired, remove it from local storage
            localStorage.removeItem('access_token');
            // Optionally, redirect the user to the login page or take appropriate action.
        }
    } catch (error) {
        console.error('Error decoding token:', error);
    }
};

const referDialog = ref(true)

onMounted(() => {
    decodeToken()
})
</script>
