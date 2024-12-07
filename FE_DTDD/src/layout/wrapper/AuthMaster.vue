<template>
    <div class="header-wrapper">
        <div class="top-wrapper">
            <Top></Top>
        </div>
        <div class="menu-wrapper">
            <Menu></Menu>
        </div>
    </div>

    <body>
        <div class="page-wrapper">
            <div class="page-content">
                <router-view></router-view>
            </div>
        </div>
    </body>
    <footer>
        <div class="footer-wrapper">
            <Footer></Footer>
        </div>
    </footer>
</template>

<script>
import Top from '../components/TopAuth.vue'
import Menu from '../components/MenuAuth.vue'
import Footer from '../components/Footer.vue'
export default {
    name: 'app',
    components: {
        Top, Menu, Footer
    }
}
</script>
<style>
@import url("https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css");
@import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css");
@import '../../assets/css/top.css';
@import '../../assets/css/menu.css';
@import '../../assets/css/footer.css';
@import '../../assets/css/trangchu.css';
@import '../../assets/css/login.css';
@import '../../assets/css/register.css';
@import '../../assets/css/categorypage.css';
@import 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css';

body {
    display: grid;
    grid-template-rows: auto 1fr auto;
    min-height: 90vh;
    margin: 0;
}

footer {
    background-color: #f5a623;
    padding: 10px;
    text-align: center;
}
</style>
