<template>
  <div class="">
    <div v-if="userGet.length > 0">
      <div class="container-fluid">
        <div class="row mt-2">
          <div class="col-12 mb-5">
            <div class="d-flex justify-content-start">
              <!-- <img class="imgs-fluid" style="height: 72px;" src="img/gf.png" alt="" /> -->
            </div>
            <div class="d-flex justify-content-start">
              <h5 class="text-secondary font-weight-bold">
                Accounts Reconciliation Utility
              </h5>
            </div>
            <hr />
          </div>
        </div>
        <!-- <div class="main-container"> -->
        <router-view></router-view>
      </div>
    </div>
    <!-- login -->
    <login-vue v-else />
  </div>
</template>

<script>
import axios from "axios";
import loginVue from "./components/login.vue";
import activityCenterVue from "./components/activity-center.vue";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      user: [],
    };
  },
  computed: {
    ...mapGetters(["userGet"]),
  },
  methods: {
    logOut() {
      this.$store.dispatch("userAct", "logout");
      localStorage.removeItem("user");
      window.location.href = "/login";
    },
    // resetTimer() {

    //     if (localStorage.user) {
    //         let timer = setTimeout(() => {
    //             this.logOut();
    //             console.log('first timer')
    //         }, 5000); // 10 minutes

    //         clearTimeout(timer);

    //         timer = setTimeout(() => {

    //             this.logOut();
    //             console.log('second timer')

    //         }, 5000);

    //     }
    // },
  },
  mounted() {
    if (localStorage.user) {
      // this.resetTimer();
      this.user = JSON.parse(localStorage.user);

      this.$store.dispatch("userAct", this.user[0]);
    }

    document.addEventListener("mousemove", this.resetTimer);
    // document.addEventListener('keypress', this.resetTimer);
  },
  beforeDestroy() {
    // document.removeEventListener('mousemove', this.resetTimer);
    // document.removeEventListener('keypress', this.resetTimer);
  },
  unmounted() {
    window.onunload = function () {
      localStorage.clear();
    };
  },
  components: {
    loginVue,
    activityCenterVue,
  },
};
</script>

<style scoped>
.active-nav {
  color: #fff;
  background-color: rgb(10, 107, 52);
}
</style>
