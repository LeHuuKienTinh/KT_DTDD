
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default function (to, from, next) {
    axios
        .post('http://127.0.0.1:8000/api/kt-be/token/check-login', {}, {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('access_token')
            }
        })
        .then((res) => {
            if(res.data.status) {
                next(); // Được phép đi qua
            } else {
                next({
                    path: '/kt-mobile/login',
                    // query: { redirect: encodeURIComponent(from.fullPath) }
                });
                toaster.error('Thông báo<br>' + res.data.message);
            }
        })
        .catch(() => {
            next('/kt-mobile/login');
            toaster.error("Bạn phải đăng nhập nhé!");
        });
}