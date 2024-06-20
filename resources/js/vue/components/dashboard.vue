<template>
  <div class="xs-pd-20-10 pd-ltr-20">
    <div class="title pb-20">
      <!-- <h2 class="h3 mb-0">{{`${ lowerSiteName(this.userGet[0].site_name)} Activity Overview`}}</h2> -->
      <h2 class="h3 mb-0">{{ `Activity Overview` }}</h2>
    </div>
    <div class="row pb-10">
      <div class="col-12">
        <div class="d-flex">
          <div>
            <button
              type="button"
              @click="$router.push('/')"
              class="btn btn-success mt-1">
              <i class="fa fa-home" aria-hidden="true"></i>
              Home
            </button>
          </div>

          <nav class="breadcrumb ml-3">
            <a class="breadcrumb-item" @click="$router.push('/')">Home</a>
            <span class="breadcrumb-item active">Dashboard</span>
          </nav>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 mb-20" v-if="false">
        <div class="card-box height-100-p widget-style3">
          <div class="d-flex flex-wrap">
            <div class="widget-data">
              <div class="weight-700 font-24 text-dark">75</div>
              <div class="font-14 text-secondary weight-500">
                Visitors recored today
              </div>
            </div>
            <div class="widget-icon">
              <div class="icon" data-color="#00eccf">
                <i class="icon-copy dw dw-calendar1"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 mb-20" v-if="false">
        <div class="card-box height-100-p widget-style3">
          <div class="d-flex flex-wrap">
            <div class="widget-data">
              <div class="weight-700 font-24 text-dark">10</div>
              <div class="font-14 text-secondary weight-500">
                Declarations Recorded Today
              </div>
            </div>
            <div class="widget-icon">
              <div class="icon" data-color="#00eccf">
                <i class="icon-copy dw dw-calendar1"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-6 mb-20" v-if="false">
        <div class="card-box height-100-p widget-style3">
          <div class="d-flex flex-wrap">
            <div class="widget-data">
              <div class="weight-700 font-24 text-dark">15</div>
              <div class="font-14 text-secondary weight-500">
                Gate Passes Received
              </div>
            </div>

            <div class="widget-icon">
              <div class="icon" data-color="#00eccf">
                <i class="icon-copy dw dw-calendar1"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12" v-if="false">
        <h6 class="text-secondary mb-2">Keys Status</h6>
        <div class="mb-2">
          <i
            class="icon-copy fa fa-dot-circle-o text-warning"
            aria-hidden="true"></i>
          Taken
          <i
            class="icon-copy fa fa-dot-circle-o text-success"
            aria-hidden="true"></i>
          On Shelf
        </div>
        <div class="progress mb-20">
          <div
            class="progress-bar bg-warning"
            role="progressbar"
            style="width: 15%"
            aria-valuenow="0"
            aria-valuemin="0"
            aria-valuemax="100">
            <span class="text-black">15%</span>
          </div>
          <div
            class="progress-bar bg-success"
            role="progressbar"
            style="width: 85%"
            aria-valuenow="30"
            aria-valuemin="0"
            aria-valuemax="100">
            85%
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-12 mb-20">
        <apexchart
          type="bar"
          height="350"
          :options="vehicle_movement_bar.chartOptions"
          :series="vehicle_movement_bar.series"></apexchart>
      </div>
    </div>
    <!-- <div class="title pb-20">
            <h2 class="h3 mb-0">Vehicle Movement Overview</h2>
        </div> -->
    <div class="row pb-10" v-if="false">
      <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <apexchart
          type="donut"
          width="380"
          :options="vehicles.chartOptions"
          :series="vehicles.series"></apexchart>
      </div>
    </div>
  </div>
</template>

<script>
// import axios from 'axios';
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      vehicle_movement_bar: {
        series: [
          {
            name: "Access Traffic",
            data: [],
          },
          {
            name: "Egress Traffic",
            data: [],
          },
        ],
        chartOptions: {
          chart: {
            type: "bar",
            height: 350,
          },
          title: {
            text: "Vehicle Movement for logged site",
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: "97%",
              endingShape: "rounded",
            },
          },
          dataLabels: {
            enabled: true,
          },
          stroke: {
            show: true,
            width: 0,
            colors: ["transparent"],
          },
          xaxis: {
            categories: [
              "7 Days ago",
              "6 Days ago",
              "5 Days ago",
              "4 Days ago",
              "3 Days ago",
              "Yesterday",
              "Today",
            ],
          },
          yaxis: {
            title: {
              text: "Frequency Total",
            },
          },
          fill: {
            opacity: 1,
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return val;
              },
            },
          },
        },
      },
      vehicles: {
        series: [44, 55, 41, 17, 15],
        chartOptions: {
          chart: {
            width: 380,
            type: "donut",
          },
          plotOptions: {
            pie: {
              startAngle: -90,
              endAngle: 270,
            },
          },
          dataLabels: {
            enabled: false,
          },
          fill: {
            type: "gradient",
          },
          legend: {
            formatter: function (val, opts) {
              return val + " - " + opts.w.globals.series[opts.seriesIndex];
            },
          },
          title: {
            text: "% of vehicles per department",
          },
          responsive: [
            {
              breakpoint: 480,
              options: {
                chart: {
                  width: 200,
                },
                legend: {
                  position: "bottom",
                },
              },
            },
          ],
        },
      },
    };
  },
  computed: {
    ...mapGetters([
      "vehicle_movement_bar_incomingGet",
      "vehicle_movement_bar_outgoingGet",
      "userGet",
    ]),
  },
  methods: {
    lowerSiteName(string) {
      return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    },
  },
  beforeMount() {
    this.vehicle_movement_bar.series[0].data =
      this.vehicle_movement_bar_incomingGet;
    this.vehicle_movement_bar.series[1].data =
      this.vehicle_movement_bar_outgoingGet;
    // this.vehicle_movement_bar.chartOptions.xaxis = ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun']
  },
  mounted() { },
  beforeRouteEnter(to, from, next) {
    if (from.path != "/dashboard-loading") {
      next((el) => {
        el.$router.push("/dashboard-loading");
      });
    } else {
      next();
    }
  },
  // beforeRouteLeave(to, from, next) {
  //     next((el) => {
  //         console.log(el.$store)
  //         el.$store.dispatch("vehicle_movement_barAct", []);
  //     })
  // },
};
</script>