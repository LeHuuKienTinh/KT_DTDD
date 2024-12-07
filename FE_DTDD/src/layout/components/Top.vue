<template>
  <div class="container">
    <div class="header-web">
      <div class="img-banner">
        <a href="/"><img class="img-logo" src="../../assets/banner.jpeg" alt=""></a>
      </div>

      <div class="search-box">
        <input type="search" class="search-inbox form-control" placeholder=" Bạn tìm gì...?">
      </div>

      <div class="btn-login-wrapper">
        <a href="/kt-mobile/login" class="link-btn-login"><button class="btn-login btn"><i class="fa-solid fa-user"></i>Đăng nhập</button></a>
      </div>

      <div class="btn-cart-wrapper">
        <a href="/kt-mobile/shopping-cart" class="link-btn-cart"><button class="btn-cart btn"><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</button></a>
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
export default {
  name: "AppTop", // Đổi từ "Footer" thành "AppFooter"
};
</script>
<style></style>