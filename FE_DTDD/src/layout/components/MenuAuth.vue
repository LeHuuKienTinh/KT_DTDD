<template>
    <hr class="light">
    <div class="container menu-container">
      <div class="menu-web">
        <div class="select-mobile">
          <!-- Duyệt qua mảng ds để hiển thị các danh mục -->
          <router-link v-for="(category, index) in categories" :key="index" :to="'/kt-mobile/category/' + category.id + '?name=' + category.name_cate + '&slug=' + category.slug_cate ">
            <a>
              <button class="option-mobile">{{ category.name_cate }}</button>
            </a>
          </router-link>
        </div>
      </div>
    </div>
  </template>
  <script>
  import axios from 'axios';
  
  export default {
    name: "AppMenu", // Đổi từ "Footer" thành "AppFooter"
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