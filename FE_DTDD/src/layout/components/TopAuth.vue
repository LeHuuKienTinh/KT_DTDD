<template>
  <div class="container">
    <div class="header-web">
      <div class="img-banner">
        <a href="/"><img class="img-logo" src="../../assets/banner.jpeg" alt=""></a>
      </div>

      <div class="search-box">
        <input type="search" class="search-inbox form-control" placeholder=" Bạn tìm gì...?">
      </div>

      <!-- <div class="btn-login-wrapper">
        <a href="/kt-mobile/profile" class="link-btn-login"><button class="btn-login btn"><i
              class="fa-solid fa-user"></i>Profile</button></a>
      </div> -->

      <!-- searchProduct()
    {
      axios
      .get(`http://127.0.0.1:8000/api/kt-be/get_product_detail/${this.searchInput}`)
      .then((res)=>{
        
      })
    } -->
      <div class="btn-cart-wrapper">
        <router-link to="/kt-mobile/shopping-cart">
          <button class="btn-cart btn">
            <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
          </button>
        </router-link>
      </div>

      <div class="location-box">
        <i class="fas fa-map-marker-alt location-icon"></i>
        <span class="location-text">Thành phố HCM</span>
      </div>
      <div class="btn-cart-wrapper">

      </div>
      <!-- Example single danger button -->
      <div class="btn-cart-wrapper">
        <a href="#" class="link-btn-cart">
          <button type="button" class="btn btn-cart">
            {{ user.name }}
          </button>
        </a>
        <ul class="dropdown-menu">
          <li><router-link to="/kt-mobile/profile"  class="dropdown-item">Thông tin cá nhân</router-link></li>
          <li><router-link to="/kt-mobile/order-user"  class="dropdown-item">Đơn hàng</router-link></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="link-btn-cart">
              <button class="btn-logout btn-cart btn" @click="logOut()">
                <i class="ic-logout fa-solid fa-right-from-bracket"></i> Đăng xuất
              </button>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </div>

</template>
<script>
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
import axios from 'axios';
export default {
  name: "AppTop", // Đổi từ "Footer" thành "AppFooter"
  data() {
    return {
      user: {},
      // searchInput : "" //dữ liệu tìm kiếm
    }
  },
  created() {
    this.getDataUser()
  },
  methods: {
    getDataUser() {
      axios
        .get('http://127.0.0.1:8000/api/kt-be/get_info', {
          headers: {
            Authorization: `Bearer ` + localStorage.getItem('access_token'), // Thay bằng token hợp lệ
          }
        })
        .then((res) => {
          // console.log(res.data.info)
          this.user = res.data.info;  // Lưu sản phẩm vào biến
        })
        .catch((error) => {
          console.error('Lỗi lấy thông tin', error);
        });
    },
    logOut() {
      axios
        .post('http://127.0.0.1:8000/api/kt-be/logout', {}, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('access_token')}`, // Gửi token hiện tại
          },
        })
        .then((res) => {
          if (res.data.status) {
            localStorage.removeItem('access_token'); // Xóa token khỏi localStorage
            toaster.success(res.data.message); // Hiển thị thông báo thành công

            // Chờ 2 giây trước khi chuyển hướng
            setTimeout(() => {
              window.location.href = '/kt-mobile/login'; // Chuyển hướng về trang đăng nhập
            }, 1000);
          } else {
            toaster.error(res.data.message); // Hiển thị thông báo thành công
          }
        })
    },
    
  },
};
</script>
<style scoped>
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
  width: 310px !important;
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