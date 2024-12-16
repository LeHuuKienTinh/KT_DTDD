<template>
  <div class="container">
    <div class="header-web">
      <div class="img-banner">
        <a href="/"><img class="img-logo" src="../../assets/banner.jpeg" alt=""></a>
      </div>

      <!-- <div class="btn-cart-wrapper">
        <a href="#" class="link-btn-cart">
          <button type="button" class="btn btn-cart">
            {{ user.name }}  Xin chào ADMIN
          </button>
        </a>
        
      </div> -->
      <div class="info" style="display:flex; align-items:  center;  margin-left: auto;">
        <p style="margin-bottom: 0; margin-right: 10px;">Xin chào ADMIN</p>
        <div class="btn-login-wrapper">
          <button @click="logOut()" class="btn-login btn"><i class="fa-solid fa-user"></i>Đăng xuất</button>
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
  name: "AppTopAD", // Đổi từ "Footer" thành "AppFooter"
  data() {
    return {
      user: {},
    }
  },
  created() {
    this.getDataUser();
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