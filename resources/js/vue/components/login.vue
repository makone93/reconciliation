<template>
    <div>
        <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-7">
                        <img src="vendors/images/login-page-img.png" alt="" />
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="login-box bg-white box-shadow border-radius-10">

                            <!-- <img src="img/gf.png" alt="" class="dark-logo" /> -->
                            <div class="login-title">
                                <h2 class="text-center text-primary">Login To Recon - System</h2>
                            </div>
                            <form>

                                <div class="input-group custom">
                                    <input
                                        type="text"
                                        v-model="user.username"
                                        class="form-control form-control-lg"
                                        placeholder="Username" />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                    </div>
                                </div>
                                <div class="input-group custom">
                                    <input
                                        type="password"
                                        v-model="user.password"
                                        class="form-control form-control-lg"
                                        placeholder="**********" />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    </div>
                                </div>
                                <!-- <div class="row pb-30">
                                    <div class="offset-6 col-6">
                                        <div class="forgot-password">
                                            <a href="forgot-password.html">Forgot Password</a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div v-if="login_loading && !loading_fail" class="progress my-2">
                                            <div
                                                class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                                role="progressbar"
                                                style="width: 100%">
                                            </div>
                                        </div>
                                        <div v-else class="input-group mb-0">
                                            <a :class="user.username == '' ||
                                                    user.password == '' ? 'disabled' : ''" class="btn btn-success btn-lg btn-block text-white" @click="getUser()">Sign In</a>
                                        </div>
                                        <div v-if="loading_fail" class="alert alert-danger fade show mt-2" role="alert">
                                            <strong>{{ error_message }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                username: "",
                password: "",
            },
            profile: {},

            loading_fail: false,
            error_message: '',


            login_loading: false,
            authenticated: false,
        }
    },
    methods: {
        login() {
            localStorage.user = JSON.stringify([this.profile]);
            this.$store.dispatch("userAct", this.profile);
            window.location.href = '/';

        },
        async getUser() {

            this.login_loading = true
            this.error_message = ''
            this.loading_fail = false


            try {
                const res = await axios.post("http://localhost:8000/api/get_user", {
                    username: this.user.username,
                    password: this.user.password
                });


                if (res.status == 200 && res.headers["content-type"] === "application/json") {
                    this.profile = res.data.user;

                    this.login_loading = false;
                    //login
                    this.login()
                } else {
                    this.error_message = "Internal failure";
                    this.loading_fail = true;
                    this.login_loading = false;
                }

            } catch (error) {
                this.error_message = "Incorrect Username or Password";
                this.loading_fail = true;
            }
        },

    },
    mounted() {

    }
}
</script>