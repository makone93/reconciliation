<template>
  <div class="">
    <div v-if="userGet.length > 0">
      <div class="header d-none">
        <!-- app bar left -->
        <div class="header-left">
          <div class="menu-icon bi bi-list mr-3"></div>
          <span class="d-none d-lg-inline mr-1">{{
            userGet[0].site_name
          }}</span>
        </div>
        <!-- app bar right -->
        <div class="header-right">
          <div class="dashboard-setting user-notification">
            <div class="dropdown">
              <a
                class="dropdown-toggle no-arrow"
                href="javascript:;"
                data-toggle="right-sidebar"
              >
                <span class="bi bi-menu-up"></span>
              </a>
            </div>
          </div>

          <!-- notification -->
          <div class="user-notification">
            <div class="dropdown">
              <!-- notification icon -->
              <a
                class="dropdown-toggle no-arrow"
                href="#"
                role="button"
                data-toggle="dropdown"
              >
                <i class="icon-copy dw dw-notification"></i>
                <span class="badge notification-active"></span>
              </a>
              <!-- notification dropdown -->
              <div class="dropdown-menu dropdown-menu-right">
                <div class="notification-list mx-h-350 customscroll">
                  <ul>
                    <li>
                      <a href="#">
                        <img src="vendors/images/img.jpg" alt="" />
                        <h3>John Doe</h3>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing
                          elit, sed...
                        </p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="vendors/images/photo1.jpg" alt="" />
                        <h3>Lea R. Frith</h3>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing
                          elit, sed...
                        </p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="vendors/images/photo2.jpg" alt="" />
                        <h3>Erik L. Richards</h3>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing
                          elit, sed...
                        </p>
                      </a>
                    </li>
                    <li>
                      <router-link to="/notifications">
                        <!-- <img src="vendors/images/photo2.jpg" alt="" /> -->
                        <h3>View all notifications</h3>
                        <p>See all.....</p>
                      </router-link>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="user-info-dropdown">
            <div class="dropdown pt-2 mr-2">
              <a
                class="dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
              >
                <span class="user-name mr-1">{{ userGet[0].full_name }}</span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
              >
                <a class="dropdown-item" href="profile.html"
                  ><i class="dw dw-user1"></i> Profile</a
                >
                <a class="dropdown-item" href="profile.html"
                  ><i class="dw dw-settings2"></i> Setting</a
                >
                <a class="dropdown-item" href="faq.html"
                  ><i class="dw dw-help"></i> Help</a
                >
                <a class="dropdown-item" @click="logOut()"
                  ><i class="dw dw-logout"></i> Log Out</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- right-side-bar -->
      <div class="right-sidebar d-none">
        <activity-center-vue />
      </div>

      <div class="left-side-bar d-nones">
        <div class="brand-logo">
          <a href="index.html">
            <img src="img/gf.png" alt="" class="dark-logo" />
            <!-- <img src="img/gf.png" alt="" class="light-logo" /> -->
          </a>
          <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
          </div>
        </div>
        <div class="menu-block customscroll">
          <div class="sidebar-menu">
            <ul id="accordion-menu">
              <li class="ml-3">General</li>
              <li>
                <router-link
                  to="/dashboard"
                  active-class="active"
                  class="dropdown-toggle no-arrow"
                >
                  <span class="micon bi bi-grid-1x2"></span>
                  <span class="mtext">Dashboard</span>
                </router-link>
              </li>
              <li>
                <router-link
                  to="/visitors"
                  active-class="active"
                  class="dropdown-toggle no-arrow"
                >
                  <!-- <span class="micon bi bi-grid-1x2-fill"></span> -->
                  <i class="micon fa fa-suitcase" aria-hidden="true"></i>
                  <span class="mtext">Walk-in Visitors</span>
                </router-link>
              </li>
              <li>
                <router-link
                  to="/vehicle-movement"
                  active-class="active"
                  class="dropdown-toggle no-arrow"
                >
                  <i class="micon fa fa-car" aria-hidden="true"></i>
                  <span class="mtext">Vehicle Movement</span>
                </router-link>
              </li>
              <li>
                <router-link
                  to="/keys"
                  active-class="active"
                  class="dropdown-toggle no-arrow"
                >
                  <span class="micon bi bi-key"></span>
                  <span class="mtext">Key Logs</span>
                </router-link>
              </li>
              <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                  <span class="micon bi bi-arrows-move"></span>
                  <span class="mtext">Declarations</span>
                </a>
                <ul class="submenu">
                  <li>
                    <router-link
                      to="/gate-pass"
                      active-class="active"
                      class="dropdown-toggle no-arrow"
                    >
                      Gate Pass
                    </router-link>
                  </li>
                  <li>
                    <router-link
                      to="/items-movement"
                      active-class="active"
                      class="dropdown-toggle no-arrow"
                    >
                      Items Movement
                    </router-link>
                  </li>
                </ul>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li class="ml-3">Management</li>
              <!-- <li>
                            <router-link to="/reports" active-class="active" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-grid-1x2"></span>
                                <span class="mtext">Reports</span>
                            </router-link>
                        </li> -->
              <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                  <span class="micon bi bi-pie-chart-fill"></span>
                  <span class="mtext">Reports</span>
                </a>
                <ul class="submenu">
                  <li>
                    <router-link
                      to="/users"
                      active-class="active"
                      class="dropdown-toggle no-arrow"
                    >
                      <span class="mtext">Vehicle Movement</span>
                    </router-link>
                  </li>
                  <li>
                    <router-link
                      to="/users"
                      active-class="active"
                      class="dropdown-toggle no-arrow"
                    >
                      <span class="mtext">Key Tracking</span>
                    </router-link>
                  </li>
                  <li>
                    <router-link
                      to="/users"
                      active-class="active"
                      class="dropdown-toggle no-arrow"
                    >
                      <span class="mtext">Anomarlies</span>
                    </router-link>
                  </li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                  <span class="micon bi bi-person-lines-fill"></span
                  ><span class="mtext">Users</span>
                </a>
                <ul class="submenu">
                  <li>
                    <router-link
                      to="/users"
                      active-class="active"
                      class="dropdown-toggle no-arrow"
                    >
                      <span class="mtext">Users List</span>
                    </router-link>
                  </li>
                  <li>
                    <router-link
                      to="/users"
                      active-class="active"
                      class="dropdown-toggle no-arrow"
                    >
                      <span class="mtext">Priviledges and Rights</span>
                    </router-link>
                  </li>
                </ul>
              </li>
              <li>
                <router-link
                  to="/administration"
                  active-class="active"
                  class="dropdown-toggle no-arrow"
                >
                  <span class="micon bi bi-gear-wide-connected"></span>
                  <span class="mtext">Administration</span>
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="mobile-menu-overlay d-none"></div>

      <div class="main-container">
        <!-- <div class="main-container"> -->
        <router-view></router-view>
      </div>
      <!-- For light theme -->
      <a class="sidebar-light"></a>
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
