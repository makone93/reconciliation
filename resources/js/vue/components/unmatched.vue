<template>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Invoices from Ledger
                        <span class="badge badge-light">{{ unmatchedLedgerInvoices.length }}</span>
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>
                            <span>Page {{ `${ledgerCurrentPage + 1}/${ledgerTotalPages}` }}</span>
                            <button class="btn btn-sm btn-info" @click="ledgerPreviousPage" :disabled="ledgerCurrentPage === 0"><i class="icon-copy bi bi-arrow-left-square"></i> Previous</button>
                            <button class="btn btn-sm btn-info" @click="legderNextPage" :disabled="ledgerCurrentPage === ledgerTotalPages - 1">Next <i class="icon-copy bi bi-arrow-right-square"></i></button>
                            <button class="btn btn-sm btn-secondary" @click="exportAllLedger"><i class="icon-copy bi bi-file-earmark-excel-fill"></i> Export</button>
                        </span>

                        <div>
                            Filter:
                            <button :class="!ledgerShowPayments ? '' : 'btn-secondary'" class="btn btn-sm" @click="ledgerShowPayments = !ledgerShowPayments"><i :class="!ledgerShowPayments ? 'bi-filter' : 'bi-check2'" class="icon-copy bi"></i> Show Payments Only</button>
                        </div>``

                        <div class="form-group">
                            <input type="text" v-model="ledgerSearchQuery" placeholder="Search..." class="form-control">
                        </div>
                    </div>


                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Entry</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Over</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody v-if="unmatchedLedgerInvoices.length > 0">
                            <tr v-for="(row, index) in ledgerDisplayedItems" :key="index">
                                <td>{{ row['DocumentType'] }}</td>
                                <td>{{ row['Entry'] }}</td>
                                <td>{{ row['DueDate'] }}</td>
                                <td>{{ row['Over'] }}</td>
                                <td>{{ row['Price'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Invoices from Statement
                        <span class="badge badge-light">{{ unmatchedStatementInvoices.length }}</span>
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>
                            <span>Page {{ `${statementCurrentPage + 1}/${statementTotalPages}` }}</span>
                            <button class="btn btn-sm btn-info" @click="statementPreviousPage" :disabled="statementCurrentPage === 0"><i class="icon-copy bi bi-arrow-left-square"></i> Previous</button>
                            <button class="btn btn-sm btn-info" @click="statementNextPage" :disabled="statementCurrentPage === statementTotalPages - 1">Next <i class="icon-copy bi bi-arrow-right-square"></i></button>
                            <button class="btn btn-sm btn-secondary" @click="exportAllstatement"><i class="icon-copy bi bi-file-earmark-excel-fill"></i> Export</button>
                        </span>

                        <div>
                            Filter:
                            <button :class="!statementShowPayments ? '' : 'btn-secondary'" class="btn btn-sm" @click="statementShowPayments = !statementShowPayments"><i :class="!statementShowPayments ? 'bi-filter' : 'bi-check2'" class="icon-copy bi"></i> Show Payments Only</button>
                        </div>``

                        <div class="form-group">
                            <input type="text" v-model="statementSearchQuery" placeholder="Search..." class="form-control">
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Commodity</th>
                                <th scope="col">Original Amount</th>
                                <th scope="col">Posting Date</th>
                            </tr>
                        </thead>
                        <tbody v-if="unmatchedStatementInvoices.length > 0">
                            <tr v-for="(row, index) in statementDisplayedItems" :key="index">
                                <td>{{ row['DocNumber'] }}</td>
                                <td>{{ row['Supplier'] }}</td>
                                <td>{{ row['Commodity'] }}</td>
                                <td>{{ row['OriginalAmount'] }}</td>
                                <td>{{ row['PostingDate'] }}</td>
                            </tr>
                        </tbody>
                    </table>
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
            ledgerSearchQuery: '',
            ledgerItemsPerPage: 5,
            ledgerCurrentPage: 0,
            ledgerShowPayments: false,
            ledgerisNegativePriceFilterActive: false,

            statementItemsPerPage: 5,
            statementCurrentPage: 0,
            statementSearchQuery: '',
            statementShowPayments: false,
            statementisNegativePriceFilterActive: false,

        }
    },
    computed: {
        // ledger values
        ledgerFilteredItems() {
            if (this.ledgerisNegativePriceFilterActive) {
                return this.ledgerfilteredItemsWithNegativePrice;
            }
            return this.unmatchedLedgerInvoices.filter(item => {
                for (const key in item) {
                    if (Object.prototype.hasOwnProperty.call(item, key)) {
                        if (String(item[key]).toLowerCase().includes(this.ledgerSearchQuery.toLowerCase())) {
                            return true;
                        }
                    }
                }
                return false;
            });
        },
        ledgerfilteredItemsWithNegativePrice() {
            // Filter out items with negative "Price"
            return this.unmatchedLedgerInvoices.filter(item => {
                let price = parseFloat(item.Price);
                return price < 0;
            });
        },


        ledgerTotalPages() {
            return Math.ceil(this.ledgerFilteredItems.length / this.ledgerItemsPerPage);
        },
        ledgerDisplayedItems() {
            const startIndex = this.ledgerCurrentPage * this.ledgerItemsPerPage;
            const endIndex = startIndex + this.ledgerItemsPerPage;
            return this.ledgerFilteredItems.slice(startIndex, endIndex);
        },
        // statement
        // statement values
        statementFilteredItems() {
            if (this.statementisNegativePriceFilterActive) {
                return this.statementFilteredItemsWithNegativePrice;
            }
            return this.unmatchedStatementInvoices.filter(item => {
                for (const key in item) {
                    if (Object.prototype.hasOwnProperty.call(item, key)) {
                        if (String(item[key]).toLowerCase().includes(this.statementSearchQuery.toLowerCase())) {
                            return true;
                        }
                    }
                }
                return false;
            });
        },
        statementFilteredItemsWithNegativePrice() {
            // Filter out items with negative "Price"
            return this.unmatchedStatementInvoices.filter(item => {
                let price = parseFloat(item.OriginalAmount);
                return price < 0;
            });
        },


        statementTotalPages() {
            return Math.ceil(this.statementFilteredItems.length / this.statementItemsPerPage);
        },
        statementDisplayedItems() {
            const startIndex = this.statementCurrentPage * this.statementItemsPerPage;
            const endIndex = startIndex + this.statementItemsPerPage;
            return this.statementFilteredItems.slice(startIndex, endIndex);
        },
    },
    methods: {
        //ledger
        legderNextPage() {
            if (this.ledgerCurrentPage < this.ledgerTotalPages - 1) {
                this.ledgerCurrentPage++;
            }
        },
        ledgerPreviousPage() {
            if (this.ledgerCurrentPage > 0) {
                this.ledgerCurrentPage--;
            }
        },
        exportAllLedger() {

            // Convert relevant fields to numbers
            const unmatchedInvoicesValidated = this.ledgerFilteredItems.map(item => ({
                ...item,
                Price: parseFloat(item.Price),
            }));

            const wb = XLSX.utils.book_new();

            const ws2 = XLSX.utils.json_to_sheet(unmatchedInvoicesValidated);
            XLSX.utils.book_append_sheet(wb, ws2, 'unmatched ledger invoices');

            XLSX.writeFile(wb, 'unmatched ledger invoices.xlsx');
        },
        applyLegderNegativePriceFilter() {
            this.ledgerFilteredItems = this.unmatchedLedgerInvoices.filter(item => {
                // Parse "Price" as a float
                let price = parseFloat(item.Price);
                // Filter out items with negative "Price"
                return price < 0;
            });
            this.ledgerisNegativePriceFilterActive = true;
        },
        resetLedgerFilter() {
            this.ledgerisNegativePriceFilterActive = false;
        },
        //statement
        statementNextPage() {
            if (this.statementCurrentPage < this.statementTotalPages - 1) {
                this.statementCurrentPage++;
            }
        },
        statementPreviousPage() {
            if (this.statementCurrentPage > 0) {
                this.statementCurrentPage--;
            }
        },
        exportAllstatement() {

            // Convert relevant fields to numbers
            const unmatchedInvoicesValidated = this.statementFilteredItems.map(item => ({
                ...item,
                OriginalAmount: parseFloat(item.OriginalAmount),
            }));

            const wb = XLSX.utils.book_new();

            const ws2 = XLSX.utils.json_to_sheet(unmatchedInvoicesValidated);
            XLSX.utils.book_append_sheet(wb, ws2, 'unmatched statement invoices');

            XLSX.writeFile(wb, 'unmatched statement invoices.xlsx');
        },
        applystatementNegativePriceFilter() {
            this.statementFilteredItems = this.unmatchedstatementInvoices.filter(item => {
                // Parse "Price" as a float
                let price = parseFloat(item.OriginalAmount);
                // Filter out items with negative "Price"
                return price < 0;
            });
            // this.statementisNegativePriceFilterActive = true;
        },
        resetstatementFilter() {
            this.statementisNegativePriceFilterActive = false;
        }
    },
    props: {
        unmatchedLedgerInvoices: Array,
        unmatchedStatementInvoices: Array
    },
    watch: {
        ledgerShowPayments(val) {
            if (val) {
                this.applyLegderNegativePriceFilter();
                this.ledgerCurrentPage = 0
            } else {
                this.resetLedgerFilter();
            }
        },
        ledgerSearchQuery() {
            this.ledgerCurrentPage = 0
        },
        statementShowPayments(val) {
            if (val) {
                this.applystatementNegativePriceFilter();
                this.statementCurrentPage = 0
            } else {
                this.resetstatementFilter();
            }
        },
        statementSearchQuery() {
            this.statementCurrentPage = 0
        }
    }
}
</script>