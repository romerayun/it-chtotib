$('.delete').click(function(event) {
    var form =  $(this).closest("form");
    event.preventDefault();
    Swal.fire({
        title: 'Вы действительно хотите удалить запись? 🥺',
        text: "Это действие отменить невозможно!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#31ce36',
        cancelButtonColor: '#f25961',
        confirmButtonText: 'Удалить',
        cancelButtonText: 'Отмена',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
});

$('.js-example-basic-single').select2();


$("#status_id").change(function () {
    if ($(this).find(':selected').text() === 'Установлено') {
        $('.location_object').css('display', 'block');
    } else {
        $('.location_object').css('display', 'none');
    }
});

$("#location_id").change(function () {
    if ($("#status_id").find(':selected').text() === 'Установлено') {
        if ($(this).find(':selected').val() !== '') {
            let value = $(this).find(':selected').val();
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "/locationAjax",
                method: "POST",
                data : {
                    'value': value,
                    '_token': _token,
                },
                success: function(result) {
                    $("#location_object").html(result);
                    $('#location_object').select2();
                },

            });
        }
    } else {
        $('.location_object').css('display', 'none');
    }
});


$("#isAbbr").change(function () {
    let abbrP = $("#abbr").parent();
    if ($(this).is(":checked") === true) {
        if (abbrP.hasClass('d-none')) {
            abbrP.removeClass('d-none');
        }
    } else {
        if (!abbrP.hasClass('d-none')) {
            abbrP.addClass('d-none');
        }
        $("#abbr").val("");
    }
});

$("#isInvoice").change(function () {
    let abbrP = $("#invoice_id").parent();
    if ($(this).is(":checked") === true) {
        if (abbrP.hasClass('d-none')) {
            abbrP.removeClass('d-none');
            $("#invoice_id").select2();
        }
    } else {
        if (!abbrP.hasClass('d-none')) {
            abbrP.addClass('d-none');
        }
        // $("#invoice_id").val("").trigger("change");
    }
});

$("#checkAll").click(function(){
    $('input:checkbox').prop('checked', this.checked);
});


$("#filterQR").click(function (event) {
    event.preventDefault();

    // alert(123);
    let location_id = $("#location_id").val();
    let type_id = $("#type_id").val();

    let invoice_id = $("#invoice_id").val();
    let _token = $('input[name="_token"]').val();

    $.ajax({
        url: "/qr-code-generator-1",
        method: "GET",
        data : {
            'location_id': location_id,
            // 'invoice_id': invoice_id,
            'type_id': type_id,
            // '_token': _token,
        },
        success: function(result) {
            // console.log(result);

            $("#pills-container").html('');
            $("#pills-container").html(result);
            // $('#location_object').select2();
        },

    });
});


$("#filterWriteOff").click(function (event) {
    event.preventDefault();

    let location_id = $("#location_id").val();
    let type_id = $("#type_id").val();

    let invoice_id = $("#invoice_id").val();
    let _token = $('input[name="_token"]').val();

    $.ajax({
        url: "/write-off-filter",
        method: "GET",
        data : {
            'location_id': location_id,
            // 'invoice_id': invoice_id,
            'type_id': type_id,
            // '_token': _token,
        },
        success: function(result) {
            // console.log(result);

            $("#pills-container").html('');
            $("#pills-container").html(result);
            // $('#location_object').select2();
        },

    });
});

// filterWriteOff
