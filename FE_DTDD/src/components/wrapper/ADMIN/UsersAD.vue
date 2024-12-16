<template>
    <div class="container">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="search-box" ref="searchBox">
                    <input v-model="query" @input="searchUsers()" type="search" class="form-control ps-5 radius-30"
                        placeholder="Tìm người dùng"> <span
                        class="position-absolute top-50 product-show translate-middle-y"><i
                            class="bx bx-search ms-3"></i></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, k) in users" :key="k">
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <input class="form-check-input me-1" type="checkbox" value=""
                                                aria-label="..." style="border-color: blue;">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">{{ v.name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ v.email }}</td>
                                <td>{{ v.phone_number }}</td>
                                <td>{{ formatDate(v.created_at) }}</td>
                                <td>
                                    <button @click="changeStatus(v)" v-if="v.is_lock == 0 && v.is_active == 1" class="btn btn-success">Đang hoạt động</button>
                                    <button v-else-if="v.is_active == 0" class="btn btn-info" style="padding:6px 17px;">Chưa kích hoạt</button>
                                    <button @click="changeStatus(v)" v-else-if="v.is_lock == 1" class="btn btn-danger" style="padding:6px 31px;">Đã bị khóa</button>
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <button class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#updateModal" @click="Object.assign(update, v)"><i
                                                class="bx bxs-edit"></i></button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal"
                                            @click="Object.assign(del, v)"><i class="bx bxs-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <!--Delete Modal -->
                <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa sản phẩm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Bạn có chắc muốn xóa người dùng <span style="font-weight: bold;">{{ del.name }}</span> không?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                    @click="deleteUser()">Xóa người dùng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Update Modal -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật thông tin</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="">Tên người dùng</label>
                                        <input type="text" class="form-control" v-model="update.name">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control" v-model="update.phone_number">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" v-model="update.email">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" @click="updateUser()"
                                    data-bs-dismiss="modal">Cập
                                    nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment/moment';
import { debounce } from 'lodash';  // Import debounce từ lodash
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            users: [],
            users_full: [], 
            des: {},
            del: {},
            update: {},
            query: "",
        }
    },
    created() {
        this.getDataUsers();
        this.searchUsers = debounce(this.searchUsers, 500);
    },
    mounted() {
        // Lắng nghe sự kiện click bên ngoài
        document.addEventListener('click', this.handleClickOutside);
    },
    beforeDestroy() {
        // Hủy bỏ sự kiện click khi component bị huỷ
        document.removeEventListener('click', this.handleClickOutside);
    },
    methods: {
        getDataUsers() {
            axios
                .get('http://127.0.0.1:8000/api/kt-be/get_users')
                .then((res) => {
                    this.users = res.data.data.filter(item => item.rules == 0);
                    this.users_full = res.data.data.filter(item => item.rules == 0)
                })
                .catch((error) => {
                    console.error('Lỗi lấy thông tin tài khoản', error);
                });
        },
        deleteUser() {
            axios
                .delete('http://127.0.0.1:8000/api/kt-be/delete_user/' + this.del.id)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getDataUsers();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        updateUser() {
            axios
                .put('http://127.0.0.1:8000/api/kt-be/update_user', this.update)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getDataUsers();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        searchUsers() {
            if (this.query.length > 2) {  // Chỉ tìm kiếm khi người dùng nhập ít nhất 3 ký tự\
                axios
                    .get('http://127.0.0.1:8000/api/kt-be/search_user/', {
                        params: { query: this.query },
                    })
                    .then((res) => {
                        this.users = res.data.data.filter(item => item.rules == 0);
                       
                    });
            } else {
                this.users = this.users_full;  // Nếu từ khóa ngắn hơn 3 ký tự, không hiển thị kết quả
            }
        },
        handleClickOutside(event) {
            // Kiểm tra xem người dùng có click ra ngoài ô tìm kiếm hay không
            const searchBox = this.$refs.searchBox;
            if (searchBox && !searchBox.contains(event.target)) {
                // Nếu click ra ngoài, không làm gì cả, tránh reset kết quả
            }
        },
        formatDate(date) {
            return moment(date).format('DD/MM/YYYY'); // Định dạng ngày tháng năm
        },
        changeStatus(user){
            axios
                .put('http://127.0.0.1:8000/api/kt-be/change_status_lock', user)
                .then((res) => {
                    if(res.data.status){
                        toaster.success(res.data.message);
                        this.getDataUsers();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },

    },

}
</script>
<style></style>