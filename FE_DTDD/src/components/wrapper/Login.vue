<template>
    <div class="container">
        <div class="card-login-wrapper">
            <div class="card-login card ">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h3 class="">Đăng nhập</h3>
                            <p>Chưa có tài khoản? <a href="/kt-mobile/register" class="register-now">Đăng ký ngay!</a>
                            </p>
                        </div>
                        <hr>
                    </div>
                    <div class="form-body">
                        <form @submit.prevent="actionLogin" class="row g-3">
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Email</label>
                                <input type="text" v-model="user.email" class="input-email form-control"
                                    id="inputEmailAddress" placeholder="Nhập email của bạn...">
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" v-model="user.password"
                                        class="input-password form-control border-end-0" id="inputChoosePassword"
                                        placeholder="Nhập mật khẩu...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="remember-check check-pw form-check-input" type="checkbox"
                                        id="flexSwitchCheckChecked" checked="">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Nhớ tài khoản</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end"> <a href="authentication-forgot-password.html"
                                    class="forgot-password">Quên mật khẩu?</a>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="submit-login btn "><i class="bx bxs-lock-open"></i>Đăng
                                        nhập</button>
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
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
import axios from 'axios';
export default {
    name: "LoginApp",
    data() {
        return {
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        actionLogin() {
            const loginData = {
                email: this.user.email,  // lấy từ dữ liệu của Vue
                password: this.user.password           // lấy từ dữ liệu của Vue
            };
            axios
                .post('http://127.0.0.1:8000/api/kt-be/login', loginData)
                .then((res) => {
                    //Xử lý nếu đăng nhập thành công
                    
                    if (res.status == 200) {
                        // Lưu thông tin người dùng vào localStorage
                        localStorage.setItem('access_token', res.data.access_token);
                        localStorage.setItem('rule', res.data.user.rule)

                        // Hiển thị thông báo thành công
                        toaster.success('Xin chào ' + res.data.user.name);
                        toaster.success(res.data.message);
                        if(res.data.user.rule == 1) {
                            this.$router.push('/kt-mobile/admin/products');  // Chuyển hướng
                        } else {
                            this.$router.push('/kt-mobile/profile');  // Chuyển hướng
                        }
                    }
                })
                .catch((error) => {
                    if (error.response) {
                        if (error.response.status == 403) {
                            toaster.info(error.response.data.message, {
                                timeout: 5000,
                            });
                        } else if (error.response.status == 401) {
                            toaster.error(error.response.data.message, {
                                timeout: 5000,
                            });
                        } else if (error.response.status == 409) {
                            toaster.error(error.response.data.message, {
                                timeout: 5000,
                            });
                            
                        } else if (error.response.status == 422) {
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