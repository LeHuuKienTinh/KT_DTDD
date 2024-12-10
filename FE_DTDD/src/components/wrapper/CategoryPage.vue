<template>
  <div class="container">
    <div class="category-page">
      <h1>Các sản phẩm liên quan tới : {{ category.name_cate }}</h1>

      <!-- List Products -->
      <div class="row row-product">
        <!-- Duyệt qua các sản phẩm -->
        <div v-for="(product) in filteredProducts" :key="product.id" class="col-lg-3 item-product">
          <router-link :to="'/kt-mobile/product-detail/' + product.id + '&slug=' + product.slug" style="text-decoration: none;">
            <a class="link-product">
              <div class="card card-product">
                <img :src="product.img" class="card-img-top img-product" alt="product.name" />
                <div>
                  <div class="product-discount position-absolute top-0 start-0">
                    <span>Trả góp 0%</span>
                  </div>
                </div>
                <div class="card-body">
                  <h6 class="product-title card-title cursor-pointer" style="font-weight: 600; font-size: large;">
                    {{ product.name }}
                  </h6>
                  <div class="clearfix">
                    <p class="cost-product mb-0 fw-bold">
                      <span>{{ product.price }}</span>
                    </p>
                  </div>
                  <div class="d-flex align-items-center mt-3 fs-6">
                    <div class="cursor-pointer">
                      <!-- Hiển thị sao đánh giá -->
                      <i v-for="n in 5" :key="n" class="bx bxs-star"
                        :class="{ 'text-warning': n <= product.rating, 'text-secondary': n > product.rating }"></i>
                    </div>
                    <p class="mb-0 ms-auto">{{ product.rating }} ({{ product.reviews }})</p>
                  </div>
                </div>
              </div>
            </a>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      category: {}  // Để lưu thông tin của category từ query params
    };
  },
  computed: {
    filteredProducts() {
      return this.products.filter(product => product.id_cate == this.category.id); // Lọc sản phẩm theo id_cate
    }
  },
  created() {
    this.getDataProduct();
    this.setCategoryData();
  },
  watch: {
    // Watch sự thay đổi của $route
    '$route'() {
      this.setCategoryData();  // Cập nhật lại category khi URL thay đổi
    },
  },
  methods: {
    setCategoryData() {
      // Lấy category từ query params trong URL
      this.category.id = this.$route.params.category;  // ID từ URL
      this.category.name_cate = this.$route.query.name;  // Name từ query params
      this.category.slug_cate = this.$route.query.slug;  // Slug từ query params
    },
    getDataProduct() {
      axios
        .get('http://127.0.0.1:8000/api/kt-be/get_product')
        .then((res) => {
          this.products = res.data.data;  // Lưu sản phẩm vào biến
        })
        .catch((error) => {
          console.error('Lỗi lấy sản phẩm:', error);
        });
    },
  },
};
</script>


<style scoped>
.category-page {
  padding: 20px;
}

.product-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.product-item {
  border: 1px solid #ddd;
  padding: 10px;
  width: 200px;
}

img {
  width: 100%;
  height: 200px;
}
</style>