<template>
  <div class="container">
    <!-- Banner Wrapper -->
    <div class="banner-wrapper">
      <div class="banner">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../assets/banner1.png" class="d-block w-100 img-banner" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../assets/banner2.png" class="d-block w-100 img-banner" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../assets/banner1.png" class="d-block w-100 img-banner" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="banner">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../assets/banner1.png" class="d-block w-100 img-banner" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../assets/banner2.png" class="d-block w-100 img-banner" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../assets/banner1.png" class="d-block w-100 img-banner" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Box Sortby -->
    <div class="card-sort-by card">
      <div class="sort-by">
        <div class="title-sort">Sắp xếp theo:</div>
        <div class="sort-select">
          <a href="#" class="sort-option">Nổi bật</a>
          <a href="#" class="sort-option">Bán chạy</a>
          <a href="#" class="sort-option">Giảm giá</a>
          <a href="#" class="sort-option">Mới</a>
          <a href="#" class="sort-option">Giá</a>
        </div>
      </div>
    </div>

    <!-- Promotion -->
    <div class="promotion-products">
      <div class="card-promotion card">
        <div class="card-body">
          <p class="featured-products">TOP SẢN PHẨM NỔI BẬT</p>
        </div>
      </div>
    </div>

    <!-- List Products -->
    <div class="row row-product">
      <div v-for="(product) in featuredProducts" :key="product.id" class="col-lg-3 item-product">
        <router-link :to="'/kt-mobile/product-detail/' + product.id" style="text-decoration: none;">
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

    <!-- Promotion -->
    <div class="promotion-products">
      <div class="card-promotion card">
        <div class="card-body">
          <p class="featured-products">TOP SẢN PHẨM KHUYẾN MÃI</p>
        </div>
      </div>
    </div>

    <!-- List Products -->
    <div class="row row-product">
      <div v-for="(product) in discountedProducts" :key="product.id" class="col-lg-3 item-product">
        <router-link :to="'/kt-mobile/product-detail/' + product.id" style="text-decoration: none;">
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
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
    };
  },
  computed: {
    // Lọc sản phẩm nổi bật có rating > 4.5
    featuredProducts() {
      return this.products.filter(product => product.rating > 4.5);
    },
    // Lọc sản phẩm khuyến mãi có giá < 600
    discountedProducts() {
      return this.products.filter(product => product.price < 600);
    },
  },
  created() {
    this.getDataProduct();
  },
  methods: {
    getDataProduct() {
      axios
        .get('http://127.0.0.1:8000/api/kt-be/get_product')
        .then((res) => {
          console.log(res.data.data)
          this.products = res.data.data;  // Lưu sản phẩm vào biến
        })
        .catch((error) => {
          console.error('Lỗi lấy sản phẩm:', error);
        });
    },
  },
};
</script>
