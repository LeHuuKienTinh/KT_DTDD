<template>
    <div class="card-register-wrapper">
        <div class="card-register card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="text-center">
                        <h3 class="">Đăng ký tài khoản</h3>
                        <p>Bạn đã có tài khoản? <a href="/kt-mobile/login" class="login-now">Đăng nhập ngay!</a>
                        </p>
                    </div>
                    <div class="form-body">
                        <form @submit.prevent="actionRegister" class="row g-3">
                            <div class="col-sm-12">
                                <label for="inputFirstName" class="form-label">Tên người dùng</label>
                                <input type="text" v-model="user_create.name" class="input-name form-control"
                                    id="inputFirstName" placeholder="Nhập tên người dùng của bạn...">
                            </div>
                            <div class="col-12">
                                <label for="inputPhone" class="form-label">Số điện thoại</label>
                                <input type="text" v-model="user_create.phone_number" class="input-phone form-control"
                                    id="inputPhone" placeholder="Nhập số điện thoại của bạn...">
                            </div>
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Địa chỉ Email</label>
                                <input type="text" v-model="user_create.email" class="input-email form-control"
                                    id="inputEmailAddress" placeholder="Nhập địa chỉ email của bạn...">
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                    <input id="password" type="password" v-model="user_create.password"
                                        class="input-password form-control border-end-0" placeholder="Nhập mật khẩu...">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputChooseRePassword" class="form-label">Nhập lại mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                    <input v-model="rePassword" id="re_password" type="password"
                                        class="input-repassword form-control border-end-0"
                                        placeholder="Nhập lại mật khẩu">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class=" form-check form-switch">
                                    <input class="agree-condition-check form-check-input" type="checkbox"
                                        id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Tôi đồng ý với các Điều
                                        khoản &amp; Điều kiện</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="submit-register btn"><i class="bx bx-user"></i>Đăng
                                        ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    name: "RegisterApp",
    data() {
        return {
            user_create: {},
            rePassword: ''
        }
    },
    methods: {
        actionRegister() {
            if (this.user_create.password !== this.rePassword) {
                toaster.error('Mật khẩu xác nhận không khớp!');
                return;
            }
            axios
                .post('http://127.0.0.1:8000/api/kt-be/register', this.user_create)
                .then((res) => {
                    console.log(res.status);
                    //Xử lý nếu đăng ký thành công
                    if (res.status == 201) {
                        toaster.success(res.data.message);
                        this.$router.push('/kt-mobile/login')
                        this.user_create = {}
                        this.rePassword = ''
                    }
                })
                .catch((error) => {
                    if (error.response) {
                        if (error.response.status == 422) {
                            // Giả sử error.response.data.message là một mảng
                            // Object.values(errorMessage) lấy tất cả các thông báo lỗi từ đối tượng errorMessage.
                            // .flat() làm phẳng các mảng lồng nhau thành một mảng phẳng.
                            // [0] lấy thông báo lỗi đầu tiên từ mảng đã làm phẳng.
                            let errorMessage = error.response.data.message;
                            let firstErrorMessage = Object.values(errorMessage).flat()[0]; // Lấy thông báo lỗi đầu tiên

                            toaster.error(firstErrorMessage, {
                                timeout: 5000,
                            });
                        }
                    } else {
                        toaster.error('Không thể kết nối tới máy chủ, vui lòng kiểm tra lại mạng!', {
                            timeout: 5000,
                        });
                    }

                })
        }
    }

}
</script>
<style></style>