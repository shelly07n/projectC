<template>
    <div class="bg-white rounded-lg border p-3" v-if="source">
        <div class="flex justify-between">
            <div>
                <div class="flex items-center justify-center w-8 h-8 ml-auto overflow-hidden rounded-full cursor-pointer">
                    <img src="https://assets.codepen.io/5041378/internal/avatars/users/default.png?fit=crop&format=auto&height=512&version=1600304177&width=512"
                        alt="">
                </div>
            </div>
            <div>
                <div class="flex justify-end mx-2"  v-if="useHelper.decodedToken.user_role == 'admin'">
                    <button @click="useContest.createContest = {...source},useContest.canEdit = true, useContest.canShowCreateContest = true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5  h-5 mx-2 text-green-600 font-semibold">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                          </svg>
                    </button>
                    <button @click="useContest.deleteContest(source.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600 font-semibold">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                          </svg>
                    </button>
                </div>
             <div class="mt-2">
                <button v-if="useHelper.decodedToken.user_role == 'admin'" type="button"
                @click="useContest.currentlySelectedContest = { ...source }, useContest.canShowSentInvitation = true"
                class='flex max-w-sm w-full bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 focus:outline-none text-white text-sm px-7 uppercase font-bold shadow-md rounded-lg mx-auto p-1'>
                Invite
            </button>
            <button v-else-if="source.status == 1" type="button"
                @click="useContest.currentlySelectedContest = { ...source }, useContest.canShowSentInvitation = true"
                class='flex max-w-sm w-full bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 focus:outline-none text-white text-sm px-7 uppercase font-bold shadow-md rounded-lg mx-auto p-1'>
                Invite
            </button>
            <button v-else type="button" @click="useContest.join(source, useHelper.decodedToken.user_id)"
                class='flex max-w-sm w-full bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 focus:outline-none text-white text-sm px-7 uppercase font-bold shadow-md rounded-lg mx-auto p-1'>
                Join
            </button>
             </div>
            </div>
        </div>
        <div class="flex justify-between mb-1">
            <div>
                <p class="text-gray-900 font-bold text-xl ">
                    {{ source.name }}
                </p>
            </div>
            <div>
                <p class="text-gray-900 font-semibold text-sm mt-2 ">
                    {{ findContestDuration(new Date(source.start_date), new Date(source.end_date)) }} <span> days
                        left</span>
                </p>
            </div>
        </div>
        <div class="flex justify-between ">
            <div>
                <p class="text-gray-900 font-semibold text-md mb-2">Prize pool : <span
                        class="font-bold text-lg text-pink-600">
                        {{ source.winning_prize }}</span> </p>
            </div>
        </div>
        <div>
            <ProgressBar class="progressbar_val2"
                v-if="generateRandomNumberInRange(40,80) + 1 > 40 && generateRandomNumberInRange(40,80) + 1 <= 59"
                :class="[generateRandomNumberInRange(40,80) + 1 >= 40 && generateRandomNumberInRange(40,80) + 1 <= 59]"
                :value="generateRandomNumberInRange(40,80) + 1">
            </ProgressBar>

            <ProgressBar class="progressbar_val3" v-else-if="generateRandomNumberInRange(80,100) + 1 >= 60"
                :class="[generateRandomNumberInRange(80,100) + 1 >= 60]" :value="generateRandomNumberInRange(80,100) + 1">
            </ProgressBar>
        </div>
        <div class="flex justify-end">
            <div>
                <p class="text-gray-900 font-semibold text-md mb-2">{{ source.contestant_limit }} <span
                        class="text-gray-500 font-medium text-sm">Contestant limit</span></p>
            </div>
        </div>
    </div>
</template>


<script setup>
import { helperMainStore } from '../helpers/helperMainService';
import { contestMainStore } from '../modules/contests/stores/contestMainStore';


const useContest = contestMainStore()
const useHelper = helperMainStore()



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


const findContestDuration = (startDate, endDate) => {
    // Calculate the difference in days
    const timeDifference = endDate.getTime() - startDate.getTime();
    const number_of_days = Math.ceil(timeDifference / (1000 * 3600 * 24));
    return number_of_days;
}

function generateRandomNumberInRange(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


const colors = [
    'bg-orange-50',
    'bg-emerald-50',
    'bg-yellow-50',
    'bg-rose-50',
    'bg-cyan-50',
    'bg-amber-50',
    'bg-red-50',
    'bg-blue-50',
    'bg-pink-50',
    'bg-green-50',
    'bg-fuchsia-50',
];

const getBackgroundColor = (index) => {
    return colors[index % colors.length];
};



</script>
