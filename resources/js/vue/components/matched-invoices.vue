<template>
    <div>
        <div class="d-flex justify-content-between">
            <div>
                <span>Page {{ `${currentPage + 1}/${totalPages}` }}</span>
                <span>
                    <button class="btn btn-sm btn-info" @click="previousPage" :disabled="currentPage === 0"><i class="icon-copy bi bi-arrow-left-square"></i> Previous</button>
                    <button class="btn btn-sm btn-info" @click="nextPage" :disabled="currentPage === totalPages - 1">Next <i class="icon-copy bi bi-arrow-right-square"></i></button>
                </span>

                <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#export-options"><i class="icon-copy bi bi-file-earmark-excel-fill"></i> Export</button>

            </div>
            <div>
                <div class="form-group">
                    <input type="text" v-model="searchQuery" placeholder="Search..." class="form-control">

                </div>
            </div>
        </div>

        <!-- @click="exportVariations" -->
        <!-- <button class="btn btn-sm btn-info" @click="exportVariations">Export Variations</button>
        <button class="btn btn-sm btn-info" @click="exportToExcel">Export All Matches</ button> -->

        <div class="mt-2" v-for="(row, index) in displayedItems" :key="index">
            <div :class="row['OriginalAmount'] == row['Price'] ? 'alert-primary' : 'alert-danger'" class="alert  mb-0" role="alert">
                <span style="font-size: 10pt;">
                    <span class="d-flex justify-content-between">
                        <span>
                            Date: <strong class="mr-2">{{ row["PostingDate"] }} </strong>
                            Sup. Invoive: <strong class="mr-2">{{ row["SupplierInvNumber"] }} </strong>
                            Commodity: <strong class="mr-2">{{ row["Commodity"] }}</strong>
                            External: <strong class="mr-2">{{ row["ExternalDocNumber"] }}</strong>
                            Supplier: <strong class="mr-2">{{ row["Supplier"] }}</strong>
                            File Ref: <strong class="mr-2">{{ row["FileRegRef"] }}</strong>
                            Doc Type: <strong class="mr-2">{{ row["DocType"] }}</strong>
                        </span>
                        <span>
                            Invoice: <strong class="mr-2">{{ row["DocNumber"] }} {{ row["DocNumber"] != row["DocumentType"] ? '⚠️' : '' }} </strong>
                            Amount: <strong class="mr-2">{{ row["OriginalAmount"] }} </strong>
                        </span>
                    </span>
                </span>
            </div>
            <div :class="row['OriginalAmount'] == row['Price'] ? 'alert-secondary' : 'alert-danger'" class="alert mt-0 ml-4" role="alert">
                <span style="font-size: 10pt;">
                    <span class="d-flex justify-content-between">
                        <span>
                            Due Date: <strong class="mr-2">{{ row["DueDate"] }} </strong>
                            Over: <strong class="mr-2">{{ row["Over"] }} </strong>
                            Entry: <strong class="mr-2">{{ row["Entry"] }} </strong>
                        </span>
                        <span>
                            Document Type: <strong class="mr-2">{{ row["DocumentType"] }} {{ row["DocNumber"] != row["DocumentType"] ? '⚠️' : '' }} </strong>
                            Amount: <strong class="mr-2">{{ row["Price"] }} </strong>
                        </span>
                    </span>
                </span>
            </div>
        </div>

        <div class="modal fade" id="export-options" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Export Options
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import * as XLSX from 'xlsx';
export default {
    data() {
        return {
            display: "list",
            searchQuery: '',
            itemsPerPage: 5,
            currentPage: 0,
            exportOption: "all"
        }
    },
    computed: {
        filteredItems() {
            return this.matchedInvoices.filter(item => {
                for (const key in item) {
                    if (Object.prototype.hasOwnProperty.call(item, key)) {
                        if (String(item[key]).toLowerCase().includes(this.searchQuery.toLowerCase())) {
                            return true;
                        }
                    }
                }
                return false;
            });
        },
        totalPages() {
            return Math.ceil(this.filteredItems.length / this.itemsPerPage);
        },
        displayedItems() {
            const startIndex = this.currentPage * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.filteredItems.slice(startIndex, endIndex);
        },
        variationItems() {
            return this.matchedInvoices.filter(item => parseFloat(item.Price) !== parseFloat(item.OriginalAmount));
        }
    },
    methods: {
        changeView() {
            if (this.display == "list") {
                this.display = "grid"
            } else {
                this.display = "list";
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages - 1) {
                this.currentPage++;
            }
        },
        previousPage() {
            if (this.currentPage > 0) {
                this.currentPage--;
            }
        },
        exportVariations() {

            // Convert relevant fields to numbers
            const matchedInvoicesValidated = this.matchedInvoices.map(item => ({
                ...item,
                Price: parseFloat(item.Price),
                // Amount: parseFloat(item.Amount.replace('-', '.')), // Replace '-' with '.' to parse correctly
                OriginalAmount: parseFloat(item.OriginalAmount),
                Balance: parseFloat(item.Balance)
            }));

            // Convert relevant fields to numbers
            const variationItemsValidated = this.variationItems.map(item => ({
                ...item,
                Price: parseFloat(item.Price),
                // Amount: parseFloat(item.Amount.replace('-', '.')), // Replace '-' with '.' to parse correctly
                OriginalAmount: parseFloat(item.OriginalAmount),
                Balance: parseFloat(item.Balance)
            }));

            // Insert blank column between "Price" and "PostingDate"
            const itemsWithBlankColumn = matchedInvoicesValidated.map(item => {
                const newItem = { ...item };
                newItem['BlankColumn'] = '';
                return newItem;
            });


            const wb = XLSX.utils.book_new();

            const ws2 = XLSX.utils.json_to_sheet(itemsWithBlankColumn);
            XLSX.utils.book_append_sheet(wb, ws2, 'all matched invoices');



            const ws = XLSX.utils.json_to_sheet(variationItemsValidated);
            XLSX.utils.book_append_sheet(wb, ws, 'invoice variances');


            if (this.searchQuery.length > 0) {
                // Convert relevant fields to numbers
                const filteredItemsValidated = this.filteredItems.map(item => ({
                    ...item,
                    Price: parseFloat(item.Price),
                    // Amount: parseFloat(item.Amount.replace('-', '.')), // Replace '-' with '.' to parse correctly
                    OriginalAmount: parseFloat(item.OriginalAmount),
                    Balance: parseFloat(item.Balance)
                }));

                const ws3 = XLSX.utils.json_to_sheet(filteredItemsValidated);
                XLSX.utils.book_append_sheet(wb, ws3, 'searched invoices');
            }

            XLSX.writeFile(wb, 'matched invoices.xlsx');
        },
    },
    props: {
        matchedInvoices: Array
    },
    watch: {
        searchQuery() {
            this.currentPage = 0
        }
    }
}
</script>