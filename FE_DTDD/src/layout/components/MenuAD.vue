<template>
    <hr class="light mb-1">
    <div class="container menu-container">
        <!-- <div class="menu-web" > -->
            <!-- <div class="select-mobile" style="display: flex;align-items: flex-start !important;"> -->
                <!-- Duyệt qua mảng ds để hiển thị các danh mục -->
                <router-link to="/kt-mobile/admin/products" style="margin-right: 10px;">     
                        <button class="option-mobile">Sản phẩm</button>
                </router-link>
                <router-link to="/kt-mobile/admin/orders" style="margin-right: 10px;">     
                        <button class="option-mobile">Đơn hàng</button>
                </router-link>
                <router-link to="/kt-mobile/admin/users" style="margin-right: 10px;">     
                        <button class="option-mobile">Tài khoản</button>
                </router-link>
                <router-link to="/kt-mobile/admin/stock-receive" style="margin-right: 10px;">     
                        <button class="option-mobile">QL Kho</button>
                </router-link>
                <router-link to="/kt-mobile/admin/reports" style="margin-right: 10px;">     
                        <button class="option-mobile">Thống kê</button>
                </router-link>
            </div>
        <!-- </div>   -->
    <!-- </div> -->
</template>
<script>
import axios from 'axios';

export default {
    name: "AppMenuAD", // Đổi từ "Footer" thành "AppFooter"
    data() {
        return {
            categories: []
        }
    },
    created() {
        this.getDataCate()
    },
    methods: {
        getDataCate() {
            axios
                .get('http://127.0.0.1:8000/api/kt-be/get_category')
                .then((res) => [
                    // console.log(res),
                    this.categories = res.data.data
                ])
        }
    }
};
</script>