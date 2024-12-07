<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="../../assets/android-chrome-192x192.png" alt="Admin"
                                class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4>{{ user_info.name }}</h4>
                                <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 text-secondary">
                                    <input type="button" class="btn btn-primary px-4" value="Đổi mật khẩu">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" v-model="update_user_info.name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" v-model="update_user_info.email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" v-model="update_user_info.phone">
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="Bay Area, San Francisco, CA">
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input type="button" class="btn btn-primary px-4" value="Lưu thông tin"
                                    @click="updateUserInfo()">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
import axios from 'axios';

export default {
    data() {
        return {
            user_info: {},
            update_user_info: {}
        }
    },
    mounted() {
        this.getInforUser();
    },
    methods: {
        getInforUser() {
            axios
                .get('http://127.0.0.1:8000/api/kt-be/get_info', {
                    headers: {
                        Authorization: `Bearer ` + localStorage.getItem('access_token'), // Thay bằng token hợp lệ
                    }
                })
                .then((res) => {
                    this.user_info = res.data.info
                    this.update_user_info = { ...res.data.info };
                })
                .catch((error) => {
                    toaster.error(error)
                })
        },
        updateUserInfo() {
            axios
                .post('http://127.0.0.1:8000/api/kt-be/update_info_user', this.update_user_info, {
                    headers: {
                        Authorization: `Bearer ` + localStorage.getItem('access_token'), // Thay bằng token hợp lệ
                    }
                })
                .then((res) => {
                    if (res.data.status) {
                        this.user_info = { ...this.update_user_info }
                        toaster.success(res.data.message)
                    } else {
                        toaster.error(res.data.message)
                    }
                })
        }
    },
}
</script>
<style scoped>
.row {
    align-items: center;
}
</style>