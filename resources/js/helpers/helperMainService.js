
import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";
import ExcelJS from 'exceljs';
import jwt_decode from 'jwt-decode';

import { dashboardMainStore } from '../modules/dashboard/stores/dashboardMainStore'
import { contactMainStore } from "../modules/contacts/stores/contactMainStore";


export const helperMainStore = defineStore("helperMainStore", () => {


    const useStore = dashboardMainStore()
    const useContact = contactMainStore()

    const decodedToken = ref(null);
    const canShowReferralDialog = ref(false);


    const decodeToken = async () => {
        const token = localStorage.getItem('access_token');

        try {
            const decoded = jwt_decode(token);

            // Display the decoded token
            decodedToken.value = decoded;
            useStore.decodedToken = decoded;
            useStore.contestant.id = decoded.user_id
            useStore.contestant.name = decoded.user_name
            canShowReferralDialog.value = decoded.canShowReferral
            console.log(decoded);
            if (decoded.exp < Date.now() / 1000) {
                // Token has expired, remove it from local storage
                localStorage.removeItem('access_token');
                // Optionally, redirect the user to the login page or take appropriate action.
            }

            // useStore.currentUserContestStatus(decoded.user_id)
        } catch (error) {
            console.error('Error decoding token:', error);
        }
    };













    const generateSampleExcel = (data, filename) => {

        // Create a new workbook
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet('SampleSheet');

        const headerRow = worksheet.getRow(1);
        // Add headers to the worksheet
        headerRow.values = ['name', 'relationship', 'dob', 'email', 'mobile'];

        // Add data to the worksheet
        // Add data to the worksheet
        data.forEach((row) => {
            worksheet.addRow([row.name, row.relationship, row.dob, row.email, row.mobile]);
        });

        // Define header row style (e.g., background color and bold text)

        headerRow.eachCell((cell,colNumber) => {
            cell.fill = {
                type: 'pattern',
                pattern: 'solid',
                fgColor: { argb: 'FFFF00' }, // Yellow background color
            };
            cell.font = {
                bold: true, // Make the text bold
            };
            worksheet.getColumn(colNumber).width = 20;
        });

        // Create a Blob from the workbook and initiate download
        workbook.xlsx.writeBuffer().then((buffer) => {
            const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `${filename}.xlsx`;
            a.click();
            window.URL.revokeObjectURL(url);
        });
    };




    return {
        decodedToken,decodeToken,canShowReferralDialog,
        generateSampleExcel
    }
})
