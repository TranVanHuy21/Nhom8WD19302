// Xác nhận xóa
function confirmDelete(form) {
    if (confirm('Bạn có chắc muốn xóa?')) {
        form.submit();
    }
    return false;
}

// Preview ảnh trước khi upload
function previewImage(input, preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(preview).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Format tiền
function formatMoney(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
} 