import './bootstrap';
import '../css/app.css';
import 'flowbite';

// ✅ SWIPER CORE + MODULE
import Swiper from 'swiper';
import { Autoplay, Pagination, EffectFade } from 'swiper/modules';

// ✅ SWIPER CSS
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';


// ================= MODAL =================
window.openDetail = function (title, location, date, time, desc) {
    document.getElementById('detailTitle').innerText = title;
    document.getElementById('detailLocation').innerText = location;
    document.getElementById('detailDate').innerText = date;
    document.getElementById('detailTime').innerText = time;
    document.getElementById('detailDesc').innerText = desc;

    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailModal').classList.add('flex');
}

window.closeDetail = function () {
    document.getElementById('detailModal').classList.add('hidden');
}

window.openApprove = function () {
    document.getElementById('approveModal').classList.remove('hidden');
    document.getElementById('approveModal').classList.add('flex');
}

window.closeApprove = function () {
    document.getElementById('approveModal').classList.add('hidden');
}

window.openReject = function () {
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}

window.closeReject = function () {
    document.getElementById('rejectModal').classList.add('hidden');
}


// ================= SWIPER =================
document.addEventListener('DOMContentLoaded', function () {
    const el = document.querySelector('.myHeroSwiper');
    if (!el) return;

    new Swiper(el, {
        modules: [Autoplay, Pagination, EffectFade],

        loop: true,

        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        effect: 'fade',
        speed: 800,
    });
});
