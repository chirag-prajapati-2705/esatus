Stripe.setPublishableKey(public_key);
$(function () {
    setInterval(function () {
        check_calling_status();
    }, 5000);
    function check_calling_status() {
        $(".disconnect_button").each(function (index) {
            if (!$(this).hasClass('hidden')) {
                var $this = $(this);
                var call_id = $(this).attr('data-call-id');
                $.ajax({
                    type: "POST",
                    url: url + "/index.php/services/get_calling_status",
                    data: {'call_id': call_id},
                    success: function (response) {
                        var response = $.parseJSON(response);
                        if (typeof response != 'undefined' && response.success) {
                            $this.addClass('hidden');
                            $this.next().removeClass('hidden').text('Appeler');
                        }
                    },
                    error: function (e_html) {
                    }
                });
            }
        });
    }
    $(document).on('click', '.h-modal', function (e) {
        alert();
        if(user_id !=null && user_id !=''){
            $('#adviser_detail').modal('show');
        }else{
            window.location.href = url+'/index.php/connexion';
        }
    });
    $(".submit-payment").click(function (e) {
        var form_id=$(this).parents(".payment-info").attr('id');
        var $form = $('#' + form_id);
        if($form.valid()){
            Stripe.card.createToken($form, stripeResponseHandler);
        }
        e.preventDefault();
        e.stopPropagation();
    })

    function stripeResponseHandler(status,response) {
        var modal_container_id=$('.form-modal[style*="block"]').prev().attr('id');
        var form_id = $('.form-modal[style*="block"]').find('.payment-info').attr('id');
        var $form = $('#' + form_id);
        if (response.error) {
            $("#adviser_detail").prev().html(response.error.message);
            $form.find('.submit-payment').prop('disabled', false); // Re-enable submission
        } else {
            var token = response.id;
            $form.append($('<input type="hidden" name="stripeToken">').val(token));
            var form_data = $form.serialize();
            set_payment(form_data);
        }
        return false;
    }

    function set_payment(form_data) {
        $.ajax({
            type: "POST",
            url:url+"/index.php/calls/payment",
            data: form_data,
            beforeSend: function () {
                $.blockUI({message: "S'il vous plaît, attendez", css: {height: '37px', padding: '6px'}});
            },
            success: function (response) {
                var response = $.parseJSON(response);
                if (typeof response != 'undefined' && response.charge_id != "") {
                    $(".form-modal").modal('hide');
                    $(".disconnect_button").removeClass('hidden').attr('data-charge-id', response.charge_id);
                    $(".disconnect_button").removeClass('hidden').attr('data-call-id', response.call_id);
                    $(".call_button").addClass('hidden');
                } else {
                    $("#adviser_detail").prev().html("quelque chose s'est mal passé");
                }
                $.unblockUI();
            },
            error: function (response) {
                $.unblockUI();
                $("#adviser_detail").prev().html("quelque chose s'est mal passé");
            }
        });
    }



});
