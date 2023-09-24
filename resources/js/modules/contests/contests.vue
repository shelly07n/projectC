<template>
    <!-- <loading v-if="useStore.canShowLoading" /> -->
    <!-- <confirmationDailog /> -->
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <spinner v-if="useStore.canShowLoading" />
    <mailSuccessStatus v-if="useStore.canShowMailSuccess" />
    <div class=" h-screen p-2">
        <div class="flex justify-between items-center">
            <div class="text-gray-900 font-bold text-xl mb-2">
                <p class="text-gray-900 font-semibold text-xl mb-2">{{ useStore.contestList ? useStore.contestList.length :
                    0 }}
                    Contests</p>
            </div>
            <div class="mx-6 " v-if="useHelper.decodedToken">
                <!-- <button @click="visibleImport = true"
                    class="h-10 px-5 text-indigo-700 transition-colors duration-150 border border-indigo-500 rounded-lg focus:shadow-outline hover:bg-indigo-500 hover:text-indigo-100">Import</button>
                <button @click="useHelper.generateSampleExcel(useStore.staffList, `export_file_${new Date()}`)"
                    class="h-10 px-5 mx-2 text-indigo-700 transition-colors duration-150 border border-indigo-500 rounded-lg focus:shadow-outline hover:bg-indigo-500 hover:text-indigo-100">Export</button> -->
                <button v-if="useHelper.decodedToken.user_role == 'admin'" @click="useStore.canShowCreateContest = true"
                    class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">Add
                    contest</button>
            </div>
        </div>


        <div class="grid grid-cols-3 gap-4 my-3" v-if="useStore.contestList ? useStore.contestList.length > 0 : null">
            <div v-for="(contest, index) in useStore.contestList ">
                <contestCard :source="contest" />
            </div>
        </div>
        <div v-else>
            <comingSoon />
        </div>


        <DataTable v-if="false" v-model:filters="filters" v-model:selection="selectedCustomer" :value="useStore.contestList"
            paginator responsiveLayout="scroll" :rows="5" selectionMode="single" dataKey="id">
            <Column field="name" header="Name"></Column>
            <Column field="type" header="type"></Column>
            <Column field="start_date" header="start_date"></Column>
            <Column field="end_date" header="end_date"></Column>
            <Column field="contestant_limit" header="contestant_limit"></Column>
            <Column field="winning_prize" header="winning_prize"></Column>
            <Column field="description" header="description"></Column>
            <Column header="description">
                <template #body="{ data }">
                    <button @click="currentlySelectedContest = { ...data }, visibleInvite = true"
                        class="p-2 rounded-lg border bg-red-100">invite</button>
                </template>
            </Column>

            <template #empty> No customers found. </template>
        </DataTable>
    </div>


    <Sidebar v-model:visible="useStore.canShowSentInvitation" position="right" class="w-full">

        <div class="block  p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">

            <div class="flex justify-between my-2">
                <div>
                    <p class="text-gray-900 font-bold text-3xl ">
                        {{ useStore.currentlySelectedContest.name }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-900 font-semibold text-xl ">
                        {{ findContestDuration(new Date(useStore.currentlySelectedContest.start_date), new
                            Date(useStore.currentlySelectedContest.end_date)) }} <span> days
                            left</span>
                    </p>
                </div>
            </div>
            <div class="flex justify-between ">
                <div>
                    <p class="text-gray-900 font-semibold text-lg mb-2">Prize pool : <span
                            class="font-bold text-2xl text-pink-500">
                            {{ useStore.currentlySelectedContest.winning_prize }}</span> </p>
                </div>
                <!-- <div>
                    <p class="text-gray-900 font-semibold text-xl mb-2">Master</p>
                </div> -->
            </div>
        </div>
        <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 ">Latest Contacts</h5>
                <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                    View all
                </a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 ">
                    <li class="py-3 sm:py-4" v-for="contact in useContact.contactList">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="../../assets/coming-soon.png" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate ">
                                    {{ contact.name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ contact.email }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 ">
                                <button v-if="contact.status == 'Sent'"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>

                                    Sent
                                </button>
                                <button v-else
                                    @click="useStore.canShowSentInvitation = false, useStore.sentInvitation(contact, useStore.currentlySelectedContest, useDashboard.decodedToken.user_id), currentlySelectedContestantName = contact.name"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-5 w-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                    </svg>
                                    Invite
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </Sidebar>



    <Sidebar v-model:visible="useStore.canShowCreateContest" position="right" class="w-full">
        <template #header>
            <p class="absolute left-0 mx-4 font-semibold fs-5 ">New contest</p>
        </template>

        <!-- Content -->
        <div class="w-full bg-grey-lightest">
            <div class="container mx-auto py-8">
                <div class="w-full  bg-white rounded ">
                    <div class="profile-pic">
                        <img class="forRounded"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDnAV2195eKjdsIWb9qODnuYgxUnwJ0exESA&usqp=CAU"
                            srcset="" alt="" id="output" width="200" />
                        <!-- <p v-else
                                class="font-semibold text-5xl text-center flex items-center justify-center text-white forRounded"
                                :class="[_instance_profilePagesStore.employeeDetails.short_name_Color ? _instance_profilePagesStore.employeeDetails.short_name_Color : '', _instance_profilePagesStore.employeeDetails.short_name_Color]">
                                {{ _instance_profilePagesStore.employeeDetails.user_short_name }}
                            </p> -->
                        <label class="-label" for="file">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                            <!-- <span>Change</span> -->
                        </label>
                        <input id="file" type="file" @change="updateProfilePhoto($event)" />
                    </div>
                    <div class="py-4 px-4">
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                    Name</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="first_name" type="text" placeholder="Your first name"
                                    v-model="useStore.createContest.name">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">
                                    Type</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="last_name" type="text" placeholder="Your last name"
                                    v-model="useStore.createContest.type">
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                    Start date</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="first_name" type="date" placeholder="Your department"
                                    v-model="useStore.createContest.start_date">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">
                                    End date</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="last_name" type="date" placeholder="Your date of hired"
                                    v-model="useStore.createContest.end_date">
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                    Contestent limit</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="first_name" type="number" placeholder="Your email"
                                    v-model="useStore.createContest.contestant_limit">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                    Winning prize</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="first_name" type="number" placeholder="Your email"
                                    v-model="useStore.createContest.winning_prize">
                            </div>
                        </div>
                        <div class="">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                description</label>
                            <textarea name="" id="" cols="30" rows="10"
                                v-model="useStore.createContest.description"></textarea>
                        </div>
                        <div class="flex justify-end mx-4">
                            <button @click="useStore.saveContest(useStore.createContest,useStore.canEdit), useStore.canShowCreateContest = false"
                                class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Sidebar>
</template>

<script setup>

import { ref, onMounted } from 'vue'
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import { contestMainStore } from './stores/contestMainStore'
import { contactMainStore } from '../contacts/stores/contactMainStore';
import { dashboardMainStore } from '../dashboard/stores/dashboardMainStore';
import { helperMainStore } from '../../helpers/helperMainService';
import contestCard from '../../components/contestCard.vue';
import spinner from '../../components/spinner.vue';
import mailSuccessStatus from '../../components/mailSuccessStatus.vue';
import comingSoon from '../../components/comingsoon.vue';
import confirmationDailog from '../../components/confirmationDailog.vue';





const useStore = contestMainStore()
const useContact = contactMainStore()
const useDashboard = dashboardMainStore()
const useHelper = helperMainStore()

const currentlySelectedContestantName = ref()

const visibleRight = ref(false)
const visibleInvite = ref(false)
const visibleImport = ref(false)

const findContestDuration = (startDate, endDate) => {
    // Calculate the difference in days
    const timeDifference = endDate.getTime() - startDate.getTime();
    const number_of_days = Math.ceil(timeDifference / (1000 * 3600 * 24));
    return number_of_days;
}


onMounted(async () => {
    await useHelper.decodeToken()
    await useContact.getContactList()
    useStore.getContestList(useHelper.decodedToken.user_id)

})





</script>

<style lang="scss">
.p-sidebar-right .p-sidebar {
    width: 55% !important;
    height: 100%;
}

@mixin object-center {
    display: flex;
    justify-content: center;
    align-items: center;
}

$circleSize: 90px;
$radius: 100px;
$shadow: 0 0 10px 0 rgba(255, 255, 255, .35);
$fontColor: rgb(250, 250, 250);

.profile-pic {
    color: transparent;
    transition: all .3s ease;
    @include object-center;
    position: relative;
    transition: all .3s ease;

    input {
        display: none;
    }

    .forRounded {
        position: absolute;
        object-fit: cover;
        width: $circleSize;
        height: $circleSize;
        box-shadow: $shadow;
        border-radius: $radius;
        z-index: 0;
    }

    .-label {
        cursor: pointer;
        height: $circleSize;
        width: $circleSize;
    }

    &:hover {
        .-label {
            @include object-center;
            background-color: rgba(0, 0, 0, .8);
            z-index: 10000;
            color: $fontColor;
            transition: background-color .2s ease-in-out;
            border-radius: $radius;
            margin-bottom: 0;
        }
    }

    span {
        display: inline-flex;
        padding: .2em;
        height: 2em;
        font-size: 12px;
    }
}

.has-mask {
    position: absolute;
    clip: rect(10px, 150px, 130px, 10px);
}

/* Define the custom class and style the title */
.my-custom-title-class {
    font-size: 22px;
    /* Adjust the font size to your preference */
}
</style>
