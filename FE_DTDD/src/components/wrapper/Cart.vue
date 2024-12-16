<template>
    <div class="container">
        <div class="card-body">
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
                                    <div class="number-input">
                                        <button class="minus" @click="decrease(v)">-</button>
                                        <input type="number" v-model.number="v.quantity" min="1"
                                            @change="onQuantityChange(v)" />
                                        <button class="plus" @click="increase(v)">+</button>
                                    </div>
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
                    </tbody>

                    <tfoot>
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
                                style=" border-radius: 0px; font-weight: bold">Thanh
                                toán</button>
                        </td>
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
            value: 1, // Giá trị mặc định
            del: {},
        }
    },
    created() {
        this.getInfoCart();
    },
    computed: {
        isCheckoutDisabled() {
            // Kiểm tra tổng tiền
            return this.totalPrice() <= 0;
        },
    },
    methods: {
        goToComfirm(){
            this.$router.push('/kt-mobile/confirm-order')
        },
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
        updateQuantity(item) {
            axios
                .post('http://127.0.0.1:8000/api/kt-be/update-quantity', {
                    id: item.id,
                    quantity: item.quantity
                }, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
                    },
                })
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        increase(item) {
            // Tăng số lượng sản phẩm
            item.quantity++;
            this.updateQuantity(item);
        },
        decrease(item) {
            // Giảm số lượng sản phẩm, không cho nhỏ hơn 1
            if (item.quantity > 1) {
                item.quantity--;
                this.updateQuantity(item);
            }
        },
        onQuantityChange(item) {
            // Kiểm tra giá trị nhập vào có hợp lệ không
            if (item.quantity < 1 || isNaN(item.quantity)) {
                item.quantity = 1; // Đặt lại số lượng tối thiểu là 1
            }

            // Gửi yêu cầu API để cập nhật số lượng trong cơ sở dữ liệu
            this.updateQuantity(item);
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
        }

    },

}
</script>
<style scoped>
.number-input {
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc;
    /* Viền sáng */
    border-radius: 5px;
    width: 105px;
    height: 30px;
    background-color: white;
    /* Màu nền trắng */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    /* Đổ bóng nhẹ */
}

.number-input button {
    width: 30px;
    height: 120%;
    background-color: white;
    /* Màu nền trắng */
    color: black;
    /* Màu chữ đen */
    border: none;
    /* outline: none; */
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.number-input button:hover {
    background-color: #f0f0f0;
    /* Hiệu ứng hover màu xám nhạt */
}

.number-input input[type="number"] {
    width: 40px;
    height: 100%;
    text-align: center;
    border: none;
    background-color: white;
    color: black;
    /* Màu chữ đen */
    font-size: 18px;
    border: none
}

.number-input input[type="number"]:focus {
    outline: none;
    border: none
}
</style>