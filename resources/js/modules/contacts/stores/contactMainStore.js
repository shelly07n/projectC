import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";
import { helperMainStore } from "../../../helpers/helperMainService";
import * as XLSX from 'xlsx';



export const contactMainStore = defineStore("contactMainStore", () => {

    const formData = new FormData();
    const useHelper = helperMainStore()
    const createContact = ref({ user_id: 1 })
    const contactList = ref()
    const previewImage = ref()
    const canShowLoading = ref(false)

    const getContactList = () => {
        canShowLoading.value = true
        axios.get("/api/getContacts").then(res => {
            console.log(res.data);
            contactList.value = res.data
        }).finally(() => {
            canShowLoading.value = false
        })
    }

    const profilePicEvent = (event) => {
        let file = event.target.files[0];
        formData.append('image', file)
        console.log(formData);
        console.log(createContact.value.profile_image);
        previewImage.value = URL.createObjectURL(event.target.files[0]);
    }

    const saveContact = (list) => {
        let data = []
        data.push(list)
        for (var key in createContact.value) {
            formData.append(key, createContact.value[key]);
        }
        console.log(formData);
        axios.post("/api/createContact", formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            }
        }).finally(() => {
            getContactList()
        })
        createContact.value = {}
    }

    const selectedFile = ref()

    const handleFileChange = (event) => {
        selectedFile.value = event.target.files[0];
    }

    const selected = (data) => {
        console.log(data);
    }


    const generateFile = () => {


        if (selectedFile.value) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const binaryData = e.target.result;
                const workbook = XLSX.read(binaryData, { type: 'binary' });
                const sheetName = workbook.SheetNames[0];
                const sheet = workbook.Sheets[sheetName];

                const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });
                const headers = jsonData[0];
                const data = jsonData.slice(1);

                let currentHeaders = headers;
                let currentSource = data.map((row) =>
                    headers.reduce(
                        (acc, header, index) => ({
                            ...acc,
                            [header]: row[index],
                        }),
                        {}
                    )
                );
                console.log(currentSource);;

                currentSource.forEach(ele => {
                    staffList.value.push(ele)
                })

            };
            reader.readAsBinaryString(selectedFile.value);

        }
    }
    return {
        canShowLoading, selected,
        profilePicEvent, previewImage,
        contactList, createContact, getContactList, saveContact, selectedFile, handleFileChange, generateFile
    }
})
