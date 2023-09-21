
import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";
import ExcelJS from 'exceljs';

export const helperMainStore = defineStore("helperMainStore", () => {

    const generateSampleExcel = (data,filename) => {

        // Create a new workbook
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet('SampleSheet');

     
        // Define header row style (e.g., background color and bold text)
        const headerRow = worksheet.getRow(1);
        headerRow.eachCell((cell) => {
            cell.fill = {
                type: 'pattern',
                pattern: 'solid',
                fgColor: { argb: 'FFFF00' }, // Yellow background color
            };
            cell.font = {
                bold: true, // Make the text bold
            };
        });

        // Add headers to the worksheet
        headerRow.values = ['firstname', 'lastname','department', 'doj','email', 'mobileNumber','designation', 'status',];

        // Add data to the worksheet
        // Add data to the worksheet
        data.forEach((row) => {
            worksheet.addRow([row.firstname, row.lastname,row.department, row.doj,row.email, row.mobileNumber,row.designation, row.status]);
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
        generateSampleExcel
    }
})