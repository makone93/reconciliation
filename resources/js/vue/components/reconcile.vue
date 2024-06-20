<template>
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <div>
                    <button
                        type="button"
                        @click="$router.go(-1)"
                        class="btn btn-success mt-1">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Back
                    </button>
                </div>

                <nav class="breadcrumb ml-3">
                    <a class="breadcrumb-item" @click="$router.push('/')">Home</a>
                    <span class="breadcrumb-item active">Reconcile</span>
                </nav>
            </div>
        </div>
        <div class="col-12" v-if="!reconciled">
            <hr>
            <div
                v-if="display_alert"
                :class="[alert_type, 'alert', 'fade', 'show', 'mt-2']"
                role="alert">
                <button type="button" class="close" @click="hideAlert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-flex justify-content-between">
                    <strong>{{ error_message }}</strong>
                    <span v-if="countdown < 6" class="countdown mr-3">Disappears in: {{ countdown }}</span>
                </div>

            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4" v-if="!reconciled">
            <div>
                <label>Import Ledger CSV File</label>
            </div>
            <input type="file" class="" accept=".csv" @change="ledgerFile" />
            <div v-if="ledgerValid">
                <img class="imgs-fluid" src="img/ok.png" alt="" />
            </div>
        </div>
        <div v-if="openStatement && !reconciled" class="col-12 col-sm-6 col-md-4">
            <div>
                <label>Import Statement CSV File</label>
            </div>
            <input type="file" class="" accept=".csv" @change="statementFile" />
            <div v-if="statementValid">
                <img class="imgs-fluid" src="img/ok.png" alt="" />
            </div>
        </div>
        <div class="col-12" v-if="!reconciled">
            <hr>
            <div>
                <button
                    v-if="!loading && ledgerValid && statementValid"
                    @click="reconcileData"
                    :disabled="reconciled"
                    class="btn btn-sm btn-success px-3 mt-2">
                    <i class="icon-copy bi bi-chevron-bar-contract mr-2"></i>
                    Reconcile Documents {{ `${reconciled ? "Again" : ""}` }}
                </button>
            </div>
            <div v-if="loading" class="progress my-2">
                <div
                    class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                    role="progressbar"
                    style="width: 100%"></div>
            </div>

        </div>
        <div v-if="matchedInvoices.length > 0" class="col-12">
            <hr>

            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a
                            class="nav-link active text-blue"
                            data-toggle="tab"
                            href="#home"
                            role="tab"
                            aria-selected="true">
                            Matched Invoice No.
                            <span class="badge badge-light">{{ matchedInvoices.length }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            @click="tab = 'duplicates'"
                            class="nav-link text-blue"
                            data-toggle="tab"
                            href="#profile"
                            role="tab"
                            aria-selected="false">Possible Invoice Duplicates
                            <span class="badge badge-light">{{ duplicatedInvoices.length }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            @click="loadUnmatchedInvoices()"
                            class="nav-link text-blue"
                            data-toggle="tab"
                            href="#contact"
                            role="tab"
                            aria-selected="false">Un-Matched Invoices
                            <span v-if="unmatchedLedgerInvoices.length > 0" class="badge badge-light">{{ unmatchedLedgerInvoices.length + unmatchedStatementInvoices .length}}</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div
                        class="tab-pane fade show active"
                        id="home"
                        role="tabpanel">
                        <div class="pd-20">
                            <matchedInvoices :matched-invoices="matchedInvoices" />

                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <div class="pd-20">
                            <!-- duplicates -->
                            <duplicates v-if="tab == 'duplicates'" :matched-invoices="matchedInvoices" :duplicatedInvoices="duplicatedInvoices" />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel">
                        <div class="pd-20">
                            <unmatched-vue :unmatchedLedgerInvoices="unmatchedLedgerInvoices" :unmatchedStatementInvoices="unmatchedStatementInvoices" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from "vuex";
import matchedInvoices from "./matched-invoices.vue";
import duplicates from "./duplicates.vue";
import unmatchedVue from './unmatched.vue';


export default {
    data() {
        return {
            csvLedger: null,
            csvStatement: null,
            loading: false,
            error_message: "",
            display_alert: false,
            alert_type: "",
            countdown: 6,

            reconciled: false,
            countDown: 10,

            ledgerValid: false,
            statementValid: false,
            invoiceValid: false,

            openInvoices: false,
            openStatement: false,

            matchedInvoices: [],
            unmatchedLedgerInvoices: [],
            unmatchedStatementInvoices: [],
            tab: "invoices"



        };
    },
    computed: {
        ...mapGetters(["userGet"]),
        duplicatedInvoices() {
            const docNumbersCount = {};
            const filtered = this.matchedInvoices.filter(item => {
                // Count occurrences of each DocNumber
                docNumbersCount[item.DocNumber] = (docNumbersCount[item.DocNumber] || 0) + 1;
                // Include item if DocNumber has more than one occurrence
                return docNumbersCount[item.DocNumber] > 1;
            });
            return filtered;

        }
    },
    methods: {
        validateCSV(event, section) {
            // `files` is always an array because the file input may be in multiple mode
            let res = false;
            if (section == "Ledger") {
                this.csvLedger = event.target.files[0];
            } else if (section == "Statement") {
                this.csvStatement = event.target.files[0];
            }

            if (event.target.files[0].type == "text/csv") {
                this.display_alert = true;
                this.alert_type = "alert-success";
                this.error_message = section + " file extention accepted";
                res = true;
                switch (section) {
                    case "Ledger":
                        this.ledgerValid = true;
                        break;
                    case "Statement":
                        this.statementValid = true;
                        break;
                    case "Invoices":
                        this.invoicesValid = true;
                        break;
                    default:
                        this.ledgerValid = false;
                        this.statementValid = false;
                        this.invoicesValid = false;
                        break;
                }
            } else {
                this.display_alert = true;
                this.alert_type = "alert-danger";
                this.error_message = section + " file should have .csv extention";
                res = false;
                switch (section) {
                    case "Ledger":
                        this.ledgerValid = false;
                        break;
                    case "Statement":
                        this.statementValid = false;
                        break;
                    case "Invoices":
                        this.invoicesValid = false;
                        break;
                    default:
                        this.ledgerValid = false;
                        this.statementValid = false;
                        this.invoicesValid = false;
                        break;
                }
            }
            return res;
        },
        ledgerFile(event) {
            if (this.validateCSV(event, "Ledger")) {
                this.openStatement = true;
            } else {
                this.openStatement = false;
            }
        },
        statementFile(event) {
            if (this.validateCSV(event, "Statement")) {
                this.openInvoices = true;
            } else {
                this.openInvoices = false;
            }
        },
        hideAlert() {
            setInterval(() => {
                if (this.countdown > 1) {
                    this.countdown--;
                } else {
                    clearInterval(this.hideAlert);
                    this.display_alert = false;
                    this.countdown = 6
                }
            }, 1000); // Update countdown every second
        },
        async reconcileData() {
            const data = new FormData();
            // Append csvLedger if it exists
            if (this.csvLedger) {
                data.append("csvLedger", this.csvLedger);
            }

            // Append csvStatement if it exists
            if (this.csvStatement) {
                data.append("csvStatement", this.csvStatement);
            }

            this.loading = true;
            try {
                const res = await axios.post(
                    "http://localhost:8000/api/reconcile-documents",
                    data
                );
                if (res.status == 200 && res.headers["content-type"] === "application/json") {
                    this.loading = false;
                    this.error_message = "Reconciled";
                    this.reconciled = true;
                    this.display_alert = true;
                    this.alert_type = "alert-success";
                    this.matchedInvoices = res.data.matchedInvoices;
                    // this.startCountdown();
                } else {
                    this.display_alert = true;
                    this.loading = false;
                    this.error_message = "Unable to get proper response";
                    this.alert_type = "alert-danger";
                    this.reconciled = false;
                }
            } catch (error) {
                this.error_message = "Unable to perfom task";
                this.alert_type = "alert-danger";
                this.display_alert = true;
                this.loading = false;
                this.reconciled = false;
            }
        },
        async loadUnmatchedInvoices() {
            const data = new FormData();
            // Append csvLedger if it exists
            if (this.csvLedger) {
                data.append("csvLedger", this.csvLedger);
            }

            // Append csvStatement if it exists
            if (this.csvStatement) {
                data.append("csvStatement", this.csvStatement);
            }

            this.loading = true;
            try {
                const res = await axios.post(
                    "http://localhost:8000/api/unmatched-entries",
                    data
                );
                if (res.status == 200 && res.headers["content-type"] === "application/json") {
                    this.loading = false;
                    this.error_message = "Reconciled";
                    this.reconciled = true;
                    this.display_alert = true;
                    this.alert_type = "alert-success";
                    this.unmatchedLedgerInvoices = res.data.ledgerRows;
                    this.unmatchedStatementInvoices = res.data.statementRows
                    // this.startCountdown();
                } else {
                    this.display_alert = true;
                    this.loading = false;
                    this.error_message = "Unable to get proper response";
                    this.alert_type = "alert-danger";
                    // this.reconciled = false;
                }
            } catch (error) {
                this.error_message = "Unable to perfom task";
                this.alert_type = "alert-danger";
                this.display_alert = true;
                this.loading = false;
                // this.reconciled = false;
            }
        }
    },
    mounted() { },
    components: {
        matchedInvoices,
        duplicates,
        unmatchedVue
    }
};
</script>

<style>
.cursor {
    cursor: pointer;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>