import './bootstrap';
import '../css/app.css';
import 'flowbite';

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

// ================= APPROVE =================
window.openApprove = function () {
    document.getElementById('approveModal').classList.remove('hidden');
    document.getElementById('approveModal').classList.add('flex');
}

window.closeApprove = function () {
    document.getElementById('approveModal').classList.add('hidden');
}


// ================= REJECT =================
window.openReject = function () {
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejectModal').classList.add('flex');
}

window.closeReject = function () {
    document.getElementById('rejectModal').classList.add('hidden');
}
