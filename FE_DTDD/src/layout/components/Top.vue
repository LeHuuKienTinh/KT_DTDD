<template>
  <div class="container">
    <div class="header-web">
      <div class="img-banner">
        <a href="/"><img class="img-logo" src="../../assets/banner.jpeg" alt=""></a>
      </div>

      <div ref="searchBox" class="search-box">
        <input v-model="query" @input="searchProducts" type="search" class="search-inbox form-control"
          placeholder="Bạn tìm gì...?">
        <div v-if="products.length > 0 && query.length > 2" class="search-results">
          <ul>
            <li v-for="product in products" :key="product.id" @click="selectProduct(product)">{{ product.name }}</li>
          </ul>
        </div>
      </div>

      <div class="btn-login-wrapper">
        <a href="/kt-mobile/login" class="link-btn-login"><button class="btn-login btn"><i
              class="fa-solid fa-user"></i>Đăng nhập</button></a>
      </div>

      <div class="btn-cart-wrapper">
        <a href="/kt-mobile/shopping-cart" class="link-btn-cart"><button class="btn-cart btn"><i
              class="fa-solid fa-cart-shopping"></i>Giỏ hàng</button></a>
      </div>

      <!-- <div class="input-location">
        <select name="" id="" class="select-location form-control">
          <option value="" class="option-city">Thành phố HCM</option>
        </select>
      </div> -->

      <div class="location-box">
        <i class="fas fa-map-marker-alt location-icon"></i>
        <span class="location-text">Thành phố HCM</span>
      </div>

    </div>
  </div>

</template>
<script>
import { debounce } from 'lodash';  // Import debounce từ lodash
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
import axios from 'axios';
export default {
  name: "AppTop", // Đổi từ "Footer" thành "AppFooter"
  data() {
    return {
      query: '',
      products: [],
      isSearchBoxActive: false, // Trạng thái để theo dõi ô tìm kiếm có đang được mở hay không
    }
  },
  created() {
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
  watch: {
    // Khi `id` thay đổi (ví dụ người dùng chuyển sản phẩm), ta sẽ tải lại dữ liệu
    '$route.params.id': 'selectProduct',
  },
  methods: {
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
        this.products = [];  // Nếu từ khóa ngắn hơn 3 ký tự, không hiển thị kết quả
      }
    },
    handleClickOutside(event) {
      // Kiểm tra xem click có diễn ra ngoài ô tìm kiếm không
      const searchBox = this.$refs.searchBox; // Lấy ô tìm kiếm bằng ref
      if (searchBox && !searchBox.contains(event.target)) {
        this.isSearchBoxActive = false; // Tắt ô tìm kiếm
        this.isLoading = false; // Tắt trạng thái loading
        this.products = []; // Xóa kết quả tìm kiếm
      }
    },
    selectProduct(product) {
    // Điều hướng đến trang chi tiết sản phẩm
    this.$router.push({ path: `/kt-mobile/product-detail/${product.id}` });
  },
  },
};
</script>
<style>
.ic-logout {
  margin-right: 4px;
}

.location-box {
  display: flex;
  width: 175px !important;
  align-items: center;
  padding: 8px 16px;
  background-color: white;
  border-radius: 64px;
  cursor: pointer;
}

.search-box {
  position: relative;
  width: 310px !important;
}

.search-results {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 10;
}

.search-results ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.search-results li {
  padding: 8px 16px;
  cursor: pointer;
}

.search-results li:hover {
  background-color: #f8f9fa;
}

.search-results li:active {
  background-color: #e9ecef;
}

/* Hiển thị dropdown khi hover vào wrapper */
.btn-cart-wrapper:hover .dropdown-menu {
  display: block;
}

/* Tùy chỉnh các mục trong dropdown */
.btn-cart-wrapper .dropdown-menu .dropdown-item {
  padding: 0.5rem 1rem;
  color: #333;
  text-decoration: none;
}

/* Hiệu ứng hover cho các mục */
.btn-cart-wrapper .dropdown-menu .dropdown-item:hover {
  background-color: #f8f9fa;
  color: #007bff;
}
</style>