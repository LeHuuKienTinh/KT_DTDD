<template>
    <div class="container">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="search-box" ref="searchBox">
                    <input v-model="query" @input="searchProducts" type="search" class="form-control ps-5 radius-30"
                        placeholder="Tìm sản phẩm"> <span
                        class="position-absolute top-50 product-show translate-middle-y"><i
                            class="bx bx-search ms-3"></i></span>
                </div>
                <div class="ms-auto"><button data-bs-toggle="modal" data-bs-target="#createModal"
                        class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> Thêm sản
                        phẩm</button></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Nhãn hiệu</th>
                            <th>Mô tả</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, k) in products" :key="k">
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
                                            <h6 class="mb-0 font-14">{{ getIdProduct(v.id_cate, v.id) }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ v.name }}</td>
                                <td>
                                    <img :src="v.img" alt="" width="50px" height="10%">
                                </td>
                                <td>{{ v.price }}đ</td>
                                <td>{{ getBrands(v.id_cate) }}</td>
                                <td><button type="button" class="btn btn-primary btn-sm radius-30 px-4"
                                        data-bs-toggle="modal" data-bs-target="#descripModal"
                                        @click="Object.assign(des, v)">Xem mô tả</button>
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
                <!-- Description Modal -->
                <div class="modal fade" id="descripModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" style="padding: none">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Mô tả sản phẩm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ des.description }}
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                Bạn có chắc muốn xóa sản phẩm {{ del.name }} không?
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
                <!--Update Modal -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật sản phẩm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="">Tên sản phẩm</label>
                                        <input type="text" class="form-control" v-model="update.name">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Giá</label>
                                        <input type="text" class="form-control" v-model="update.price">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <label for="">Nhãn hiệu</label>
                                        <select name="" id="" class="form-control" v-model="update.id_cate">
                                            <option value="1">Iphone</option>
                                            <option value="2">SamSung</option>
                                            <option value="3">Xiaomi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <label for="">Hình ảnh (Url)</label>
                                        <input type="text" class="form-control" v-model="update.img">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <label for="">Mô tả</label>
                                        <input type="text" class="form-control" v-model="update.description">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" @click="updateProduct()"
                                    data-bs-dismiss="modal">Cập
                                    nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Create Modal -->
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sản phẩm mới</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="">Tên sản phẩm</label>
                                        <input type="text" class="form-control" v-model="create.name">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Giá</label>
                                        <input type="text" class="form-control" v-model="create.price">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <label for="">Nhãn hiệu</label>
                                        <select name="" id="" class="form-control" v-model="create.id_cate">
                                            <option value="1">Iphone</option>
                                            <option value="2">SamSung</option>
                                            <option value="3">Xiaomi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <label for="">Hình ảnh (Url)</label>
                                        <input type="text" class="form-control" v-model="create.img">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg">
                                        <label for="">Mô tả</label>
                                        <input type="text" class="form-control" v-model="create.description">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                    @click="createProduct()">Thêm sản
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
import { debounce } from 'lodash';  // Import debounce từ lodash
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            products: [],
            products_full: [],
            des: {},
            del: {},
            update: {},
            create: {},
            query: "",
            isSearchBoxActive: false, // Trạng thái để theo dõi ô tìm kiếm có đang được mở hay không
        }
    },
    created() {
        this.getDataProducts();
        this.searchProducts = debounce(this.searchProducts, 500);

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
        getDataProducts() {
            axios
                .get('http://127.0.0.1:8000/api/kt-be/get_product')
                .then((res) => {
                    this.products = res.data.data;  // Lưu sản phẩm vào biến
                    this.products_full = res.data.data
                })
                .catch((error) => {
                    console.error('Lỗi lấy sản phẩm:', error);
                });
        },
        getBrands($id_cate) {
            if ($id_cate == '1') {
                return 'Iphone'
            } else if ($id_cate == '2') {
                return 'SamSung'
            } else if ($id_cate == '3') {
                return 'Xiaomi'
            }
        },
        getIdProduct($id_cate, $id) {
            var firstID = ''
            if ($id_cate == '1') {
                firstID = 'IP'
            } else if ($id_cate == '2') {
                firstID = 'SS'
            } else if ($id_cate == '3') {
                firstID = 'XM'
            }
            var idProduct = firstID + '-' + parseInt($id + 5200386119198)
            return idProduct;
        },
        deleteProduct() {
            axios
                .delete('http://127.0.0.1:8000/api/kt-be/delete_product/' + this.del.id)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getDataProducts();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        updateProduct() {
            axios
                .put('http://127.0.0.1:8000/api/kt-be/update_product', this.update)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getDataProducts();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        createProduct() {
            axios
                .post('http://127.0.0.1:8000/api/kt-be/create_product', this.create)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success(res.data.message);
                        this.getDataProducts();
                    } else {
                        toaster.error(res.data.message);
                    }
                })
        },
        searchProducts() {
            if (this.query.length > 2) {  // Chỉ tìm kiếm khi người dùng nhập ít nhất 3 ký tự\
                axios
                    .get('http://127.0.0.1:8000/api/kt-be/search_product/', {
                        params: { query: this.query },
                    })
                    .then((res) => {
                        this.products = res.data.data;
                    });
            } else {
                this.products = this.products_full;  // Nếu từ khóa ngắn hơn 3 ký tự, không hiển thị kết quả
            }
        },
        handleClickOutside(event) {
            // Kiểm tra xem người dùng có click ra ngoài ô tìm kiếm hay không
            const searchBox = this.$refs.searchBox;
            if (searchBox && !searchBox.contains(event.target)) {
                // Nếu click ra ngoài, không làm gì cả, tránh reset kết quả
                this.isSearchBoxActive = false; // Có thể thay đổi trạng thái tìm kiếm ở đây
            }
        },
        selectProduct(product) {
            // Điều hướng đến trang chi tiết sản phẩm
            this.$router.push({ path: `/kt-mobile/product-detail/${product.id}` });
        },

    },

}
</script>
<style></style>