<template>
    <div class="container">
        <h3>Thanh toán</h3>
        <hr>
        <div class="card-body card-address">
            <div class="address-section">
                <!-- Ô input hiển thị địa chỉ đã chọn -->
                <div class="selected-address">
                    <label class="ms-4 mt-2" style="font-size: 20px; font-weight: bold;">Địa chỉ nhận hàng:</label>
                    <div class="row ms-3 mb-2 mt-2">
                        <div class="col-lg-7">
                            <input v-if="address_default != null" class="form-control" type="text"
                                :value="`${address_default.phone} - ${address_default.name} - ${address_default.address} - ${address_default.district} - ${address_default.city}`"
                                readonly />
                        </div>
                        <div class="col-lg-3">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changeAddress">Thay
                                đổi</button>
                        </div>
                    </div>
                </div>
                <!--Change Address Modal -->
                <div class="modal fade" id="changeAddress" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Địa chỉ của tôi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul style="padding: 0px;">
                                    <li v-for="(v, index) in address_list" :key="index" class="address-item">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <label :for="'radio' + index" class="d-flex align-items-center">
                                                    <input type="radio" :id="'radio' + index" class="me-2" :value="v.id"
                                                        v-model="selected_address_id" />
                                                    <div>
                                                        <p>{{ v.phone }} {{ v.name }}</p>
                                                        <p>{{ v.address }}, {{ v.district }}, {{ v.city }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="btn" style="border: none; color: blue"
                                                    data-bs-toggle="modal" data-bs-target="#updateAddress"
                                                    @click="prepareUpdateAddress(v)">Cập nhật
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <button class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#createModel"> + Thêm địa chỉ mới</button>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                    @click="updateDefaultAddress()">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Create Address Modal -->
                <div class="modal fade" id="createModel" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm mới địa chỉ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-2">
                                    <div class="col-lg-6 mb-2">
                                        <label for="">Tên người nhận</label>
                                        <input type="text" class="form-control" v-model="name_customer">
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control" v-model="phone_customer">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <label for="">Tỉnh/Thành phố</label>
                                        <select class="form-control" v-model="selected_province_code"
                                            @change="getDistrict(selected_province_code)">
                                            <option v-for="(city, index) in provinces" :key="index" :value="city.code">
                                                {{ city.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <label for="">Quận/Huyện</label>
                                        <select name="" id="" class="form-control" v-model="selected_district">
                                            <option v-for="(district, index) in districts" :key="index"
                                                :value="district.name">
                                                {{ district.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <label for="">Số nhà,đường</label>
                                        <input type="text" class="form-control" v-model="selected_address">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#changeAddress">Đóng</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#changeAddress" @click="createAddress()">Thêm mới</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Update address Modal -->
                <div class="modal fade" id="updateAddress" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật địa chỉ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Tên người nhận -->
                                <div class="row mb-2">
                                    <div class="col-lg-6 mb-2">
                                        <label for="">Tên người nhận</label>
                                        <input type="text" class="form-control" v-model="update_address.name">
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control" v-model="update_address.phone">
                                    </div>
                                </div>

                                <!-- Tỉnh/Thành phố -->
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <label for="">Tỉnh/Thành phố</label>
                                        <select class="form-control" v-model="update_selected_province_code"
                                            @change="getDistrict(update_selected_province_code)">
                                            <option v-for="(city, index) in provinces" :key="index" :value="city.code">
                                                {{ city.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Quận/Huyện -->
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <label for="">Quận/Huyện</label>
                                        <select class="form-control" v-model="update_selected_district">
                                            <option v-for="(district, index) in districts" :key="index"
                                                :value="district.name">
                                                {{ district.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Số nhà, đường -->
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <label for="">Số nhà, đường</label>
                                        <input type="text" class="form-control" v-model="update_address.address">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quay
                                    lại</button>
                                <button type="button" class="btn btn-primary" @click="updateAddress()">Lưu thay
                                    đổi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body card-product mt-5">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, k) in product_cart" :key="k">
                            <tr style="justify-content: center; align-items: center;">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <input class="form-check-input me-1" type="checkbox" value=""
                                                aria-label="..." style="border-color: blue;">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <img :src="v.product.img" alt="" width="60px" height="10%">
                                </td>
                                <td style="font-size: 17px;">{{ v.product.name }}</td>
                                <td>{{ formatCurrency(v.price) }}</td>
                                <td>
                                    {{ v.quantity }}
                                </td>
                                <td>{{ formatCurrency(sumProduct(v.price, v.quantity)) }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal"
                                            @click="Object.assign(del, v)"><i class="bx bxs-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        
                            <!-- Lựa chọn phương thức thanh toán -->
                            <div class="payment-options">
                                <h5>Chọn phương thức thanh toán:</h5>
                                <div>
                                    <label>
                                        <input type="radio" value="cod" v-model="paymentMethod" />
                                        Thanh toán khi nhận hàng
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="radio" value="qr" v-model="paymentMethod" />
                                        Thanh toán qua QR Code
                                    </label>
                                </div>
                            </div>

                            <!-- Hiển thị QR Code nếu chọn thanh toán QR -->
                            <div v-if="paymentMethod === 'qr'" class="qr-section">
                                <h5>Quét mã QR để thanh toán</h5>
                                <img :src="qrCodeImage" alt="QR Code" v-if="qrCodeImage" />
                                <button class="btn btn-primary" @click="createPayment()">Tạo mã QR</button>
                            </div>

                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><span class="ms-4" style="font-weight: bold;">Tổng tiền:</span></td>
                            <td><span class="ms-4" style="font-weight: bold; margin-left: 0px !important;">{{
                                formatCurrency(totalPrice().toFixed(2)) }}
                                </span></td>
                            <td>
                                <button :disabled="isCheckoutDisabled" @click="goToComfirm" class="btn btn-danger mt-2"
                                    style=" border-radius: 0px; font-weight: bold">Đặt hàng</button>
                            </td>
                        </tr>
                    </tfoot>
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
                                Bạn có chắc muốn xóa sản phẩm <span v-if="del.product" style="font-weight: bold;">{{
                                    del.product.name }}
                                </span>
                                khỏi giỏ hàng không?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                    @click="deleteProduct()">Xóa sản
                                    phẩm</button>
                            </div>
                        </div>
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
    data() {
        return {
            product_cart: [],
            del: {},
            address_list: [],
            address_default: {},
            address_create: {},
            provinces: [],
            districts: [],
            selected_province_code: '',
            selected_district: '',
            selected_address: '',
            name_customer: '',
            phone_customer: '',
            selected_address_id: '',
            update_address: {},
            update_selected_province_code: '',
            update_selected_district: '',
            paymentMethod: "cod", // Mặc định là thanh toán khi nhận hàng
            qrCodeImage: null, // Lưu hình ảnh QR Code
        }
    }, created() {
        this.getInfoCart();
        this.getDataAddress();
        this.getProvince();
    },
    computed: {
        isCheckoutDisabled() {
            // Kiểm tra tổng tiền
            return this.totalPrice() <= 0;
        },
    },
    methods: {
        // goToComfirm() {
        //     this.$router.push('/kt-mobile/confirm-order')
        // },
        getInfoCart() {
            axios
                .get('http://127.0.0.1:8000/api/kt-be/get-info-cart', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
                    },
                })
                .then((res) => {
                    if (res.data.status) {
                        this.product_cart = res.data.data
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        deleteProduct() {
            axios
                .delete('http://127.0.0.1:8000/api/kt-be/delete-product-cart/' + this.del.id, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
                    },
                })
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getInfoCart();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        sumProduct(price, quantity) {
            // Ép kiểu để đảm bảo giá trị là số nguyên
            price = parseFloat(price);
            quantity = parseInt(quantity);
            return parseFloat(price * quantity);
        },
        totalPrice() {
            return this.product_cart.reduce((total, item) => {
                const price = parseFloat(item.price);
                const quantity = parseInt(item.quantity);
                return total + price * quantity; // Cộng giá trị từng sản phẩm
            }, 0); // Bắt đầu với tổng là 0
        },
        formatCurrency(value) {
            // Định dạng theo kiểu "vi-VN" (Việt Nam), sử dụng VND
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(value);
        },
        getDataAddress() {
            axios
                .get('http://127.0.0.1:8000/api/kt-be/get-data-address', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
                    },
                })
                .then((res) => {
                    if (res.data.status) {
                        this.address_list = res.data.data
                        this.address_default = res.data.default
                        console.log(this.address_list)
                        console.log(this.address_default)
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        createAddress() {
            axios
                .post('http://127.0.0.1:8000/api/kt-be/create-address', {
                    province: this.getCityName(this.selected_province_code),
                    district: this.selected_district,
                    address: this.selected_address,
                    name: this.name_customer,
                    phone: this.phone_customer
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
                    },
                })
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getDataAddress();
                        this.selected_province_code = '',
                            this.selected_district = '',
                            this.selected_address = '',
                            this.name_customer = '',
                            this.phone_customer = ''
                    }
                })
        },
        updateDefaultAddress() {
            axios
                .post('http://127.0.0.1:8000/api/kt-be/update-default-address', {
                    id: this.selected_address_id
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
                    },
                })
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.address_default = res.data.data
                    }
                })
        },
        getProvince() {
            axios
                .get('https://provinces.open-api.vn/api/p')
                .then((res) => {
                    this.provinces = res.data
                    console.log(this.provinces)
                })
        },
        getDistrict(province) {
            axios
                .get(`https://provinces.open-api.vn/api/p/${province}?depth=2`)
                .then((res) => {
                    this.districts = res.data.districts
                    console.log(this.districts)

                })
        },
        getCityName() {
            const selectedCity = this.provinces.find(city => city.code === this.selected_province_code);
            if (selectedCity) {
                // Lưu tên tỉnh/thành phố (city.name) để gửi về DB
                return selectedCity.name;
            }
        },
        prepareUpdateAddress(address) {
            // Gán giá trị từ address vào update_address
            this.update_address = Object.assign({}, address);
            this.update_selected_province_code = this.selected_province_code
            this.update_selected_district = this.selected_district
        },
        createPayment() {
            axios
                .post('http://127.0.0.1:8000/api/kt-be/create-payment', {
                    amount: parseInt(this.formatCurrency(this.totalPrice().toFixed(2))) // Chỉ cần gửi số tiền
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
                    },
                })
                .then(response => {
                    this.qrCodeImage = `data:image/png;base64,${response.data.data.qr_code}`;
                    this.paymentStatus = response.data.data.status;
                    console.log("Payment created successfully:", response.data);
                })
                .catch(error => {
                    console.error("Error creating payment:", error.response.data);
                });
        }

    },
}
</script>
<style scoped>
li {
    border: 1px solid #ddd;
    /* Viền mặc định */
    border-radius: 5px;
    /* Bo góc */
    margin-bottom: 10px;
    /* Khoảng cách giữa các mục */
    padding: 10px;
    /* Khoảng cách bên trong */
    cursor: pointer;
    /* Con trỏ hiển thị dạng click */
    transition: all 0.3s;
    /* Hiệu ứng chuyển đổi */
    text-decoration: none;
    list-style: none;
    /* Loại bỏ dấu bullet */
}

/* Hiệu ứng khi hover */
li:hover {
    border-color: #999;
    /* Đổi màu viền khi hover */
}

/* Khi mục được chọn */
li.selected {
    border: 2px solid yellow;
    /* Viền màu vàng khi được chọn */
    box-shadow: 0 0 10px rgba(255, 223, 0, 0.5);
    /* Hiệu ứng sáng */
}

input[type="checkbox"] {
    width: 20px;
    /* Chiều rộng */
    height: 20px;
    /* Chiều cao */
    cursor: pointer;
    /* Con trỏ dạng click */
}

/* Tùy chỉnh khi checkbox được chọn */
input[type="checkbox"]:checked {
    background-color: #007bff;
    /* Nền khi được chọn */
    border: 2px solid #0056b3;
    /* Viền khi được chọn */
}

/* Hiệu ứng hover */
input[type="checkbox"]:hover {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    /* Hiệu ứng sáng khi hover */
}
</style>