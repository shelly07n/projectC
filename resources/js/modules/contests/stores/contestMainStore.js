import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";

export const contestMainStore = defineStore("contestMainStore", () => {

    const createContest = ref({})
    const contestList = ref()
    const canShowLoading = ref(false)

    const getContestList = () => {
        canShowLoading.value = true
        axios.get("/api/getContests").then(res => {
            console.log(res.data);
            contestList.value = res.data
        }).finally(() => {
            canShowLoading.value = false
        })
    }

    const saveContest = (list) => {
        console.log(list);
        let data = []
        data.push(list)
        axios.post("/api/createContest", data).finally(() => {
            getContestList()
        })
        createContest.value = {}
    }

    const sentInvitation = (userdetails, contestDetails,currentUser) => {
        console.log(currentUser);
        axios.post("/api/sentInvitation",
            {
                userdetails, contestDetails,currentUser
            })
    }

    return {
        createContest, contestList, getContestList, saveContest, sentInvitation
    }
})
