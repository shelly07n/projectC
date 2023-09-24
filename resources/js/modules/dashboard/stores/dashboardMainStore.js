import { defineStore } from "pinia";
import axios from "axios";
import { reactive, ref } from "vue";
import Swal from "sweetalert2";


export const dashboardMainStore = defineStore("dashboardMainStore", () => {

    const decodedToken = ref()
    const canShowLoading = ref(false)

    const currentContestStatus = ref()

    const referralCode = (referralCode) => {
        canShowLoading.value = true
        axios.post(`/api/referral`, { referralCode: referralCode }).finally(() => {
            canShowLoading.value = false
        })
    }

    const contestant = reactive({
        id: null,
        name: null,
        contest_id: 1,
        referral_id: null,
        current_position: 0

    })

    const createContest = (referralCode) => {
        contestant.referral_id = referralCode
        canShowLoading.value = true
        axios.post(`/api/createContestant`, contestant)
            .finally(() => {
                canShowLoading.value = false
                Swal.fire({
                    title: 'Your data has been successfully Updated.',
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
                })
            })
    }

    const currentUserContestStatus = async (id) => {
        await axios.get(`/api/currentStatusContest/${id}`).then(res => {
            currentContestStatus.value = res.data
        })
    }


    const getSession = (today) => {
        var curHr = today.getHours();

        if (curHr < 12) {
            return "Good Morning";
            // console.log('good morning')
        } else if (curHr < 18) {
            return "Good Afternoon";
            // console.log('good afternoon')
        } else {
            return "Good Evening";
            // console.log('good evening')
        }
    };

    return {
        decodedToken,
        referralCode,
        canShowLoading,
        createContest,
        contestant,
        currentUserContestStatus,
        currentContestStatus,
        getSession

    }
})
