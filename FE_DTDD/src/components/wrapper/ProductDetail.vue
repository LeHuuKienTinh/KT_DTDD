<template>
  <div class="product-page" :key="$route.path">
    <div class="container" v-if="product">
      <div class="card-product-detail card">
        <div class="product-details">
          <div class="product-image">
            <img v-bind:src="product.img" alt="Product Image">
          </div>
          <div class="product-info">
            <h1>{{ product.name }}</h1>
            <p class="price">{{ product.price }} VND</p>
            <p class="description">{{ product.description }}</p>

            <!-- Chọn số lượng và thêm vào giỏ -->
            <div class="quantity">
              <label class="number-product" for="quantity">Số lượng: </label>
              <input class="input-number form-control" type="number" v-model="quantity" min="1" max="10">
            </div>

            <button class="btn btn-add-to-cart" :disabled="isLoading" @click="addToCart(product)">
              <span v-if="isLoading">Đang xử lý...</span>
              <span v-else>Thêm vào giỏ hàng</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <p>Không tìm thấy sản phẩm.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
  name: "ProductDetailPage",
  data() {
    return {
      product: {},  // Sản phẩm chi tiết
      quantity: 1,    // Số lượng mặc định
    };
  },
  created() {
    this.setProductData();
    this.getProductDetail();
  },
  beforeRouteUpdate(to, from, next) {
    // Khi route thay đổi, cập nhật lại sản phẩm
    this.setProductData();
    this.getProductDetail();
    next(); // Tiến hành chuyển route
  },
  methods: {
    setProductData() {
      // Lấy category từ query params trong URL
      this.product.id = this.$route.params.product;  // ID từ URL
      this.product.slug = this.$route.query.slug;  // ID từ URL
    },
    getProductDetail() {
      axios
        .get(`http://127.0.0.1:8000/api/kt-be/get_product_detail/${this.product.id}`)
        .then((res) => {
          console.log(res.data.data)
          this.product = res.data.data;  // Lưu sản phẩm vào biến
        })
        .catch((error) => {
          console.error('Lỗi lấy sản phẩm:', error);
        });
    },
    addToCart(product) {
      if (this.quantity < 1) {
        toaster.error('Số lượng không hợp lệ.');
        return;
      }
      this.isLoading = true;
      axios
        .post('http://127.0.0.1:8000/api/kt-be/add-to-cart', {
          product_id: product.id,
          quantity: this.quantity,
        },{
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
          },
        })
        .then((res) => {
          if (res.data.status) {
            toaster.success(res.data.message);
            this.$emit('cartUpdated'); // Gửi sự kiện để cập nhật giỏ hàng (nếu cần)
          } else {
            toaster.error(res.data.message)
          }
        })
        .finally(() => {
          this.isLoading = false; // Mở khóa nút sau khi xử lý xong
        });
    }
  }
};
</script>

<style scoped>
.product-page {
  margin-top: 20px;
}

.card-product-detail {
  border-width: 2px;
  border-color: rgb(226, 172, 36) !important;
}

.product-details {
  display: flex;
  margin-top: 16px;
  padding: 8px;
}

.product-image img {
  max-width: 100%;
  max-height: 400px;
}

.product-info {
  margin-left: 20px;
}

.product-info h1 {
  font-size: 24px;
  color: #333;
}

.price {
  font-weight: 700;
  font-size: 20px;
  color: red;
}

.quantity {
  float: left;
  margin-top: 10px;
  display: flex;
  align-items: center;
}

.reviews {
  margin-top: 30px;
}

.btn-add-to-cart {
  background-color: rgb(226, 172, 36);
  margin-top: 8px;
  margin-left: 8px;
  float: left;
}

.btn-add-to-cart:hover {
  background-color: rgb(219, 150, 23) !important;
}

.btn-add-to-cart:active {
  background-color: rgb(219, 150, 23) !important;
  border: none;
}

.number-product {
  white-space: nowrap;
}

.input-number {
  margin-left: 8px;
  border-width: 2px;
  border-color: orange;
}

input[type="number"] {
  width: auto;
  padding: 5px;
  font-size: 16px;
  display: inline-block;
  max-width: 100px;
  /* Giới hạn chiều rộng tối đa */
  min-width: 80px;
}

/* Đảm bảo các spinner chỉ xuất hiện trong component này */
.input-number-container input[type="number"] {
  -webkit-appearance: inner-spin-button !important;
  /* Hiển thị spinner cho Chrome, Safari */
  appearance: inner-spin-button !important;
  /* Hiển thị spinner cho Firefox */
  -moz-appearance: textfield !important;
  /* Đảm bảo không ảnh hưởng đến Firefox */
}

/* Đảm bảo không ẩn các nút tăng giảm */
.input-number-container input[type="number"]::-webkit-outer-spin-button,
.input-number-container input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none !important;
  margin: 0;
}

.input-number-container input[type="number"] {
  -moz-appearance: textfield !important;
  /* Loại bỏ các spinner trong Firefox */
}
</style>