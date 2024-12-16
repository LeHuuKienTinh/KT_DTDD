// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import headerToken from './middlewareLogin';


const routes = [
  //Trang Chủ
  {
    path: '/',
    component: ()=>import('../components/TrangChu.vue'),
    meta : {layout : 'default'}
  },
  //Đăng nhập
  {
    path: '/kt-mobile/login',
    component: ()=>import('../components/wrapper/Login.vue'),
    meta : {layout : 'default'}
  },
  //Đăng ký
  {
    path: '/kt-mobile/register',
    component: ()=>import('../components/wrapper/Register.vue'),
    meta : {layout : 'default'}
  },
  //Danh mục sản phẩm
  {
    path: '/kt-mobile/category/:category',
    component: ()=>import('../components/wrapper/CategoryPage.vue'),
    meta : {layout : 'default'},
    props: true
  },
  //Chi tiết sản phẩm
  {
    path: '/kt-mobile/product-detail/:product',
    component: ()=>import('../components/wrapper/ProductDetail.vue'),
    meta : {layout : 'default'},
    props: true
  },
  //Đơn hàng
  {
    path: '/kt-mobile/order-user',
    component: ()=>import('../components/wrapper/Orders.vue'),
    meta : {layout : 'auth'},
    beforeEnter: headerToken ,
  },
  //Xác nhận giỏ hàng
  {
    path: '/kt-mobile/confirm-order',
    component: ()=>import('../components/wrapper/ConfirmOrder.vue'),
    meta : {layout : 'auth'},
    beforeEnter: headerToken ,
  },
  //Thông tin cá nhân
  {
    path: '/kt-mobile/profile',
    component: ()=>import('../components/wrapper/UserProfile.vue'),
    meta : {layout : 'auth'},
    beforeEnter: headerToken ,
  },
  //giỏ hàng
  {
    path: '/kt-mobile/shopping-cart',
    component: ()=>import('../components/wrapper/Cart.vue'),
    meta : {layout : 'auth'},
    beforeEnter: headerToken ,
  },

  //ADMIN
  {
    path: '/kt-mobile/admin/products',
    component: ()=>import('../components/wrapper/ADMIN/ProductAD.vue'),
    meta : {layout : 'admin'},
    beforeEnter: headerToken ,
  },
  {
    path: '/kt-mobile/admin/orders',
    component: ()=>import('../components/wrapper/ADMIN/OrdersAD.vue'),
    meta : {layout : 'admin'},
    beforeEnter: headerToken ,
  },
  {
    path: '/kt-mobile/admin/users',
    component: ()=>import('../components/wrapper/ADMIN/UsersAD.vue'),
    meta : {layout : 'admin'},
    beforeEnter: headerToken ,
  },
  {
    path: '/kt-mobile/admin/stock-receive',
    component: ()=>import('../components/wrapper/ADMIN/StockReceiveAD.vue'),
    meta : {layout : 'admin'},
    beforeEnter: headerToken ,
  },
  {
    path: '/kt-mobile/admin/reports',
    component: ()=>import('../components/wrapper/ADMIN/Reports.vue'),
    meta : {layout : 'admin'},
    beforeEnter: headerToken ,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});
// Kiểm tra trạng thái đăng nhập và thay đổi layout trong beforeEach
router.beforeEach((to, from, next) => {
  const isLoggedIn = localStorage.getItem('access_token');
  const isAdmin = localStorage.getItem('rule');
  
  // Kiểm tra và cập nhật layout dựa trên trạng thái đăng nhập
  if (isLoggedIn) {
    if(isAdmin === '1'){
      to.meta.layout = 'admin'; // Nếu đã đăng nhập tk admin, set layout là 'admin'
    } else {
      to.meta.layout = 'auth'; // Nếu đã đăng nhập, set layout là 'auth'
    }
  } else {
    to.meta.layout = 'default'; // Nếu chưa đăng nhập, giữ layout là 'default'
  }

  next(); // Tiến hành điều hướng
});

export default router;
