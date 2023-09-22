import { defineStore } from "pinia";
import axios from "axios";
import { reactive, ref } from "vue";

export const dashboardMainStore = defineStore("dashboardMainStore", () => {

    const decodedToken = ref()

    const currentContestStatus = ref()

    const referralCode = (referralCode) => {
        console.log(referralCode);
        axios.post(`/api/referral`,{referralCode:referralCode})

    }

    const contestant = reactive({
        id:null,
        name:null ,
        contest_id:1,
        referral_id:null,
        current_position:0

    })

    const createContest = (referralCode) =>{

         contestant.referral_id = referralCode

        axios.post(`/api/createContestant`,contestant)
    }

    const currentUserContestStatus = async (id) =>{
        await axios.get(`/api/currentStatusContest/${id}`).then(res=>{
            currentContestStatus.value = res.data
        })
    }

    return {
        decodedToken,
        referralCode,
        createContest,
        contestant,
        currentUserContestStatus,
        currentContestStatus

    }
})
