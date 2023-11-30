$(document).ready(function() {
    let selectedIDs = []; // Mảng để lưu trữ các ID được chọn

    // Lắng nghe sự kiện khi checkbox được chọn hoặc bỏ chọn
    $('.sub_chk').on('change', function() {
        let selectedID = $(this).data('id');
        if ($(this).is(':checked')) {
            selectedIDs.push(selectedID); // Thêm ID vào mảng nếu checkbox được chọn
        } else {
            selectedIDs = selectedIDs.filter(id => id !== selectedID); // Loại bỏ ID khỏi mảng nếu checkbox không được chọn
        }
        updateSelectedIDs(); // Cập nhật giá trị trường ẩn với các ID đã chọn
    });

    // Hàm cập nhật giá trị của trường ẩn 'selected_ids'
    function updateSelectedIDs() {
        $('#selected_ids').val(selectedIDs.join(',')); // Cập nhật giá trị trường ẩn
    }

    // Thêm chức năng "Check All"
    $('#master').on('change', function() {
        if ($(this).is(':checked')) {
            $('.sub_chk').prop('checked', true); // Check tất cả các checkbox con
            selectedIDs = $('.sub_chk').map(function() {
                return $(this).data('id');
            }).get(); // Lưu trữ tất cả ID vào mảng selectedIDs
        } else {
            $('.sub_chk').prop('checked', false); // Bỏ chọn tất cả các checkbox con
            selectedIDs = []; // Xóa tất cả ID trong mảng selectedIDs
        }
        updateSelectedIDs(); // Cập nhật giá trị trường ẩn với các ID đã chọn
    });
});
