<template>
    <div class="row">
        <div v-for="(entry, index) in duplicatedInvoices" :key="index" class="col-12 col-sm-6 col-lg-3 col-md-4 mb-1">
            <div class="card card-box">
                <h5 class="card-header weight-500">{{ entry.DocNumber }} {{ statementFigure(true, entry.DocNumber) }}</h5>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-text"><strong>{{ entry.Commodity }}</strong></p>
                        <span>
                            <button type="button" @click="exportToExcel(entry.DocNumber)" class="btn btn-sm btn-primary"> <i class="icon-copy bi bi-file-earmark-excel-fill"></i></button>
                            <a @click="assignInvoiceNum2Search(entry.DocNumber)" class="btn btn-sm btn-success px-2 text-white" data-toggle="modal" data-target="#modelId"><i class="icon-copy bi bi-eye-fill"></i></a>
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> <strong>{{ searchQuery }}</strong> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2" v-for="(row, index) in filteredItems" :key="index">
                            <div class="alert alert-primary mb-0" role="alert">
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
                            <div class="alert alert-secondary mt-0 ml-4" role="alert">
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
                        <hr>
                        <div class="d-flex justify-content-end">
                            <div>
                                <th>Total on Statement</th>
                                <th>Total for ledger values</th>
                                <th>Difference</th>
                                <tr>
                                    <td>{{ statementAmount }}</td>
                                    <td>{{ ledgerAmount }}</td>
                                    <td>{{ statementAmount - ledgerAmount }}</td>
                                </tr>
                                <!-- <span><strong>Amount on statement {{ statementAmount }}</strong></span> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="exportToExcel(searchQuery)" class="btn btn-primary"> <i class="icon-copy bi bi-file-earmark-excel-fill"></i> Export to Excel</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            searchQuery: ''
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
        statementAmount() {

            let res = 0;
            for (let i = 0; i < this.filteredItems.length; i++) {
                res += parseFloat(this.filteredItems[i].OriginalAmount);
            }
            return res / this.filteredItems.length;
        },
        ledgerAmount() {

            let res = 0;
            for (let i = 0; i < this.filteredItems.length; i++) {
                res += parseFloat(this.filteredItems[i].Price);
            }
            return res;
        }

    },
    props: {
        matchedInvoices: Array,
        duplicatedInvoices: Array
    },
    methods: {
        assignInvoiceNum2Search(invoiceNum) {
            this.searchQuery = invoiceNum;
        },
        statementFigure(setValue = null) {

            // this.searchQuery = setValue;

            // let res;
            // for (let i = 0; i < this.filteredItems.length; i++) {
            //     for (let j = i + 1; j < this.filteredItems.length; j++) {
            //         const priceI = parseFloat(this.filteredItems[i].OriginalAmount);
            //         const priceJ = parseFloat(this.filteredItems[j].OriginalAmount);
            //         if (priceI === priceJ) {
            //             res = priceI;
            //         } else {
            //             res = "Ledger amounts differ";
            //         }
            //     }
            // }
            // return res;
        },
        ledgerFigure(setValue = null) {

            // this.searchQuery = setValue;

            // let res = 0;
            // for (let i = 0; i < this.filteredItems.length; i++) {
            //     res += parseFloat(this.filteredItems[i].Price);
            // }
            // return res;
        },
        exportToExcel(invoiceNum) {

            this.searchQuery = invoiceNum;

            // Convert relevant fields to numbers
            const convertedItems = this.filteredItems.map(item => ({
                ...item,
                Price: parseFloat(item.Price),
                // Amount: parseFloat(item.Amount.replace('-', '.')), // Replace '-' with '.' to parse correctly
                OriginalAmount: parseFloat(item.OriginalAmount),
                Balance: parseFloat(item.Balance)
            }));


            const wb = XLSX.utils.book_new();

            const ws2 = XLSX.utils.json_to_sheet(convertedItems);
            XLSX.utils.book_append_sheet(wb, ws2, this.searchQuery);
            XLSX.writeFile(wb, 'duplicate' + this.searchQuery + '.xlsx');
        }
    }

    ,
    mounted() {

    }
}
</script>