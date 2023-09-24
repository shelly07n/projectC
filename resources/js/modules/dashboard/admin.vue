<template>
    <spinner v-if="canShowLoading" />
    <div class="w-full" v-if="currentContestStatus">
        <div class="grid grid-cols-12 gap-5">
            <div class="col-span-8">
                <h5 class="mb-3 text-lg font-bold text-gray-900 ">
                {{ useDashboard.getSession(new Date()) }}
                </h5>
                <message />
                <div class="my-3">
                    <leaderboard :source="currentContestStatus.contestResults" />
                </div>
            </div>
            <div class="col-span-4">
                <contestList :source="currentContestStatus.Contest"  :role="useHelper.decodedToken.user_role" />
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref, onMounted } from 'vue'
import message from './components/message.vue';
leaderboard
import contestList from './components/contestList.vue';
import contestStatus from './components/contestStatus.vue';
import { helperMainStore } from '../../helpers/helperMainService';
import { dashboardMainStore } from './stores/dashboardMainStore';
import leaderboard from './components/leaderboard.vue';
import spinner from '../../components/spinner.vue';



const useHelper = helperMainStore()
const useDashboard = dashboardMainStore()

const canShowLoading = ref(false)
const currentContestStatus = ref()

const getCurrentUserContestStatus = async (id) => {
    await axios.get(`/api/currentStatusContest/${id}`).then(res => {
        currentContestStatus.value = res.data
    })
}

onMounted(async () => {
    canShowLoading.value = true
    await useHelper.decodeToken()
    await getCurrentUserContestStatus(useHelper.decodedToken.user_id).finally(()=>{
        canShowLoading.value = false
    })
})
</script>

