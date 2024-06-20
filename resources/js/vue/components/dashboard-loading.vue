<template>
    <div>
        Dashboard Loading....
        <div class="progress my-2">
            <div
                class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                role="progressbar"
                style="width: 100%">
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            vehicle_movement_bar: {
                incoming: [],
                outgoing: []
            }
        }
    },
    computed: {
        ...mapGetters(['userGet'])
    },
    methods: {
        async getVehicleLogs() {
            try {
                const res = await axios.post("http://172.16.50.2/api/vehicle-movememt-logs", {
                    control: 'week',
                    init_date: this.initMidnight(1),
                    site: this.userGet[0].site
                    // final_date: this.finalMidnight(0)
                });
                if (res.status == 200 && res.headers["content-type"] === "application/json") {
                    this.vehicle_movement_bar.incoming = res.data.incoming
                    this.vehicle_movement_bar.outgoing = res.data.outgoing
                    // this.vehicle_movement_bar.data.push(res.data)
                    this.$store.dispatch("vehicle_movement_barAct", this.vehicle_movement_bar);
                    this.$router.push('/dashboard')
                    // this.vehicle_logs_loading = false;
                } else {
                    // this.display_alert = true;
                    // this.alert_type = "alert-danger"
                    // this.vehicle_logs_loading = false;
                    // this.error_message = "Essential data not loaded"
                }
            } catch (error) {
                // this.error_message = "Essential data not loaded"
                // this.alert_type = "alert-danger"
                // this.display_alert = true;
                // this.vehicle_logs_loading = false;
            }
        },
        initMidnight(days) {
            let now = new Date();
            now.setDate(now.getDate() + days);
            // now.setHours(now.getHours());

            let startMidnight = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            return startMidnight
        },
        finalMidnight(days) {
            let nextMidnight = new Date(this.initMidnight(days).getTime() + 24 * 60 * 60 * 1000);
            return nextMidnight;
        }
    },
    mounted() {
        this.getVehicleLogs();
    }
}
</script>