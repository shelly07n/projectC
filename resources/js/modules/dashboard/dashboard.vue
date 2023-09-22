<template>
    <div v-if="useHelper.decodedToken">
        <AdminDashboard v-if="useHelper.decodedToken.user_role == 'admin'" />
        <contestantDashboard v-else />

        <div class="grid grid-cols-4 gap-5">
            <div class="bg-white p-10 rounded-lg shadow-md" v-for="event in useStore.currentContestStatus">
                <h1 class="text-xl font-bold">Jump back in!</h1>
                <div class="mt-4 mb-10">
                    <p class="text-gray-600">Course 75% completed</p>
                    <div class="bg-gray-400 w-64 h-3 rounded-lg mt-2 overflow-hidden">
                        <div class="bg-pink-400 w-3/4 h-full rounded-lg shadow-md"></div>
                    </div>
                </div>
                <h3 class="text-xs uppercase">Current contest:</h3>
                <h2 class="tracking-wide">
                   {{event.name}}
                </h2>
                <button class="bg-orange-400 py-3 px-8 mt-4 rounded text-sm font-semibold hover:bg-opacity-75">Go to
                    contest</button>
            </div>
        </div>
    </div>



    <!-- component -->
    <div v-if="useHelper.canShowReferralDialog"
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
                        type="text" placeholder="Referral code" v-model="referralCode">
                </div>
                <!--footer-->
                <div class="p-3  mt-2 text-center space-x-4 md:block">
                    <button @click="canShowReferralDialog = false"
                        class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                        Cancel
                    </button>
                    <button @click="useStore.referralCode(referralCode)"
                        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Submit</button>
                </div>
            </div>
        </div>
    </div>
<!--
    <button @click="useStore.createContest('sheltonKarina68IwGFUW6cton')"
        class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Submit</button> -->
</template>

<script setup>
import { onMounted, ref } from 'vue';
import AdminDashboard from './admin.vue'
import contestantDashboard from './contestant.vue'
import { dashboardMainStore } from './stores/dashboardMainStore'

import { helperMainStore } from '../../helpers/helperMainService';

const useStore = dashboardMainStore()
const useHelper = helperMainStore()

const referralCode = ref()


onMounted(async () => {
    await useHelper.decodeToken()
})
</script>
