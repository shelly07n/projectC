import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";
import { helperMainStore } from '../../../helpers/helperMainService'
import Swal from "sweetalert2";
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";


export const contestMainStore = defineStore("contestMainStore", () => {

    const useHelper = helperMainStore()
    const confirm = useConfirm();
    const toast = useToast();

    const createContest = ref({})
    const contestList = ref()
    const canShowLoading = ref(false)
    const canShowMailSuccess = ref(false)
    const canShowSentInvitation = ref(false)
    const canShowCreateContest = ref(false)
    const canShowConfirmation = ref(false)
    const canEdit = ref(false)
    const currentlySelectedContest = ref({})

    const getContestList = async (id) => {
        canShowLoading.value = true
        await axios.get(`api/getContests/${id}`).then(res => {
            console.log(res.data);
            contestList.value = res.data
        }).finally(() => {
            canShowLoading.value = false
        })
    }

    const saveContest = (list, canEdit) => {
        canShowLoading.value = true
        console.log(list);
        let data = []
        data.push(list)
        let url;
        if (canEdit) {
            url = `/api/updateContest/${list.id}`
            axios.put(url, data).finally(() => {
                getContestList(useHelper.decodedToken.user_id)
                canShowLoading.value = false
                createContest.value = {}
                // Your entry into the contest was a success
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
        } else {
            url = "/api/createContest"
            axios.post(url, data).finally(() => {
                getContestList(useHelper.decodedToken.user_id)
                canShowLoading.value = false
                createContest.value = {}
                Swal.fire({
                    title: 'Your data has been successfully saved.',
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
    }

    const deleteContest = (id) => {
        confirm.require({
            message: 'Do you want to delete this record?',
            header: 'Delete Confirmation',
            icon: 'pi pi-info-circle',
            acceptClass: 'p-button-danger',
            accept: () => {
                canShowLoading.value = true
                axios.delete(`/api/deleteContest/${id}`).finally(() => {
                    getContestList(useHelper.decodedToken.user_id)
                    toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record deleted', life: 3000 });
                    canShowLoading.value = false
                })
            },
            reject: () => {
                toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
            }
        });
    };


    const sentInvitation = (userdetails, contestDetails, currentUser) => {
        console.log(currentUser);
        canShowLoading.value = true
        axios.post("/api/sentInvitation",
            {
                userdetails, contestDetails, currentUser
            }).finally(() => {
                canShowLoading.value = false
                canShowMailSuccess.value = true
            })
    }
    const join = (contestDetails, currentUser) => {
        console.log(currentUser);
        canShowLoading.value = true
        axios.post("/api/joinContestWithoutReferralCode",
            {
                contestDetails, currentUser
            }).finally(() => {
                canShowLoading.value = false
                getContestList(useHelper.decodedToken.user_id)
                Swal.fire({
                    title: 'Your entry into the contest was a success.',
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



    return {
        join, canShowCreateContest, canEdit, deleteContest,
        canShowLoading, canShowMailSuccess, canShowConfirmation, createContest, contestList, getContestList, saveContest, sentInvitation, canShowSentInvitation
    }
})
