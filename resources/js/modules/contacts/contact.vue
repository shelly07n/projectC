<template>
    <!-- <loading v-if="useStore.canShowLoading" /> -->
    <div class="w-full h-screen p-2">
        <div class="flex justify-between items-center">
            <div class="text-gray-900 font-bold text-xl mb-2">
                <p class="text-gray-900 font-semibold text-xl mb-2">{{ useStore.contactList ? useStore.contactList.length : 0 }}
                    Employee</p>
            </div>
            <div class="mx-6 ">
                <button @click="visibleImport = true"
                    class="h-10 px-5 text-indigo-700 transition-colors duration-150 border border-indigo-500 rounded-lg focus:shadow-outline hover:bg-indigo-500 hover:text-indigo-100">Import</button>
                <button @click="useHelper.generateSampleExcel(useStore.contactList, `export_file_${new Date()}`)"
                    class="h-10 px-5 mx-2 text-indigo-700 transition-colors duration-150 border border-indigo-500 rounded-lg focus:shadow-outline hover:bg-indigo-500 hover:text-indigo-100">Export</button>
                <button @click="visibleRight = true"
                    class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">Add
                    staff</button>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-4 my-3" >
            <div v-for="(emp, index) in useStore.contactList ">
                <employeeCard :source="emp" :index="index" />
            </div>
        </div>



        <!-- <DataTable stripedRows  v-model:filters="filters" v-model:selection="selectedCustomer" :value="useStore.contactList"  paginator :rows="5"
        re
         selectionMode="single" dataKey="id" tableStyle="min-width: 50rem">
            <Column field="name" header="Name"></Column>
            <Column field="relationship" header="relationship"></Column>
            <Column field="dob" header="dob"></Column>
            <Column field="mobile" header="mobile"></Column>
            <Column field="email" header="email"></Column>
            <Column field="status" header="status"></Column>
            <Column field="created_at" header="created_at"></Column>
            <Column field="updated_at" header="updated_at"></Column>

            <template #empty> No customers found. </template>
        </DataTable>-->

    </div>

    <!-- {{ useStore.contactList  }} -->








    <Sidebar v-model:visible="visibleRight" position="right" class="w-full">
        <template #header>
            <p class="absolute left-0 mx-4 font-semibold fs-5 ">New Contact</p>
        </template>

        <!-- Content -->
        <div class="w-full bg-grey-lightest">
            <div class="container mx-auto py-8">
                <div class="w-full  bg-white rounded ">
                    <div class="profile-pic">
                        <img class="forRounded"
                            :src=" useStore.previewImage ? useStore.previewImage :  'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDnAV2195eKjdsIWb9qODnuYgxUnwJ0exESA&usqp=CAU'"
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
                        <input id="file" type="file" @change="useStore.profilePicEvent($event)" />
                    </div>
                    <div class="py-4 px-4">
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                    Name</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="first_name" type="text" placeholder="Your first name"
                                    v-model="useStore.createContact.name">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">
                                    Relationship</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="last_name" type="text" placeholder="Your last name"
                                    v-model="useStore.createContact.relationship">
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                    Date of birth</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="first_name" type="text" placeholder="Your department"
                                    v-model="useStore.createContact.dob">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">
                                    Mobile number</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="last_name" type="number" placeholder="Your date of hired"
                                    v-model="useStore.createContact.mobile">
                            </div>
                        </div>
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">
                                    Email</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    id="first_name" type="email" placeholder="Your email"
                                    v-model="useStore.createContact.email">
                            </div>
                        </div>
                        <div class="flex justify-end mx-4">
                            <button @click="visibleRight = false, useStore.saveContact(useStore.createContact)"
                                class="h-10 px-5 m-2 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Sidebar>

    <Sidebar v-model:visible="visibleImport" position="right" class="w-full">
        <template #header>
            <p class="absolute left-0 mx-4 font-semibold fs-5 ">Import</p>
        </template>
        <div class="max-w-sm w-full lg:max-w-full ">
            <div class="text-gray-900 font-bold text-lg ">Can coffee make you a better developer?</div>
            <p class="text-gray-700 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium <button
                    @click="useHelper.generateSampleExcel(sample, `sample_${new Date()}`)"
                    class="underline cursor-pointer text-blue-600 hover:underline">download a sample
                    file here</button> .</p>
        </div>
        <div class="sm:max-w-lg w-full p-4 bg-white rounded-xl z-10 mx-auto">
            <div class="text-center">
                <h2 class="mt-5 text-2xl font-bold text-gray-900">
                    File Upload!
                </h2>
                <p class="mt-2 text-sm text-gray-400">Lorem ipsum is placeholder text.</p>
            </div>
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Attach Document</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-8 group text-center">
                        <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                            <!---<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>-->
                            <div class="flex flex-auto max-h-48 w-2/5 mx-auto">
                                <img class=" h-36 object-center"
                                    src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg"
                                    alt="freepik image">
                            </div>
                            <p class="border p-1.5 rounded-lg font-medium px-3 text-sm" v-if="useStore.selectedFile">
                                {{ useStore.selectedFile.name }}
                            </p>
                            <p v-else class="pointer-none text-gray-500 "><span class="text-sm">Drag and drop</span> files
                                here <br /> or <label for="file"
                                    class="underline cursor-pointer text-blue-600 hover:underline">select a
                                    file</label> from your computer</p>
                        </div>
                        <input type="file" id="file" class="hidden" @change="useStore.handleFileChange">
                    </label>
                </div>
            </div>
            <p class="text-sm text-gray-300">
                <span>File type: doc,pdf,types of images</span>
            </p>
            <div>
                <button @click="useStore.generateFile(), visibleImport = false"
                    class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4  rounded-full tracking-wide
                                font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                    Upload
                </button>
            </div>
        </div>

    </Sidebar>
</template>

<script setup>
import employeeCard from '../../components/employeeCard.vue';
import loading from '../../components/loading.vue';
import { ref, onMounted } from 'vue'
import { contactMainStore } from './stores/contactMainStore'
import { helperMainStore } from '../../helpers/helperMainService';
import { FilterMatchMode, FilterOperator } from 'primevue/api';



const useStore = contactMainStore()
const useHelper = helperMainStore()

const visibleRight = ref(false)
const visibleImport = ref(false)


// Define sample data
const sample = [
    { name: '', relationship: '', dob: '', email: '', mobile: ''},
];

const customers = ref([
    {
        id: 1000,
        name: 'James Butt',
        country: {
            name: 'Algeria',
            code: 'dz'
        },
        company: 'Benton, John B Jr',
        date: '2015-09-13',
        status: 'unqualified',
        verified: true,
        activity: 17,
        representative: {
            name: 'Ioni Bowcher',
            image: 'ionibowcher.png'
        },
        balance: 70663
    },
]);
const selectedCustomer = ref();
const filters = ref(
    {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        'country.name': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        representative: { value: null, matchMode: FilterMatchMode.IN },
        status: { operator: FilterOperator.OR, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] }
    }
);
const representatives = ref([
    { name: 'Amy Elsner', image: 'amyelsner.png' },
    { name: 'Anna Fali', image: 'annafali.png' },
    { name: 'Asiya Javayant', image: 'asiyajavayant.png' },
    { name: 'Bernardo Dominic', image: 'bernardodominic.png' },
    { name: 'Elwin Sharvill', image: 'elwinsharvill.png' },
    { name: 'Ioni Bowcher', image: 'ionibowcher.png' },
    { name: 'Ivan Magalhaes', image: 'ivanmagalhaes.png' },
    { name: 'Onyama Limba', image: 'onyamalimba.png' },
    { name: 'Stephen Shaw', image: 'stephenshaw.png' },
    { name: 'XuXue Feng', image: 'xuxuefeng.png' }
]);
const statuses = ref(['unqualified', 'qualified', 'new', 'negotiation', 'renewal', 'proposal']);



const getSeverity = (status) => {
    switch (status) {
        case 'unqualified':
            return 'danger';

        case 'qualified':
            return 'success';

        case 'new':
            return 'info';

        case 'negotiation':
            return 'warning';

        case 'renewal':
            return null;
    }
};



onMounted(() => {
    useStore.getContactList()
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
</style>
