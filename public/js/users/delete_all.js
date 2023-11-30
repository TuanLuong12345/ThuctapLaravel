$(document).ready(function(){
    $('#master').on('click',function (e) {
        if ($(this).is(':checked',true)) {
            $('.sub_chk').prop('checked',true)
        }else {
            $('.sub_chk').prop('checked',false)
        }
    });
    $('.delete_all').on('click',function (e) {
        var allVals = [];
        $('.sub_chk:checked').each(function () {
            allVals.push($(this).attr('data-id'));
        });

        if (allVals.length <= 0) {
            alert("Hãy chọn ô để xóa");
        }else {
            var check = confirm("Bạn có chắc chắn muốn xóa những ô đã chọn");
            if (check == true) {
                var join_selected_values = allVals.join(",");

                $.ajax({
                    url: $(this).data('url'),
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:'ids='+join_selected_values,
                    success:function (data) {
                        console.log(data);
                        (data['success'])
                        $(".sub_chk:checked").each(function () {
                            $(this).parents("tr").remove();
                            location.reload();
                        });
                        alert("Đã xóa thành công những người dùng là user");
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
                $.each(allVals, function( index, value ){
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                    location.reload();
                });
            }
        }
    });
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function (event, element) {
            element.trigger('confirm');
        }
    });
    $(document).on('confirm', function (e) {
        var ele = e.target;
        e.preventDefault();
        $.ajax({
            url: ele.href,
            type: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                data['success']
                $("#" + data['tr']).slideUp("slow");
                alert(data['success']);
            },
            error: function (data) {
                alert(data.responseText);
            }
        });

        return false;

    });

});
