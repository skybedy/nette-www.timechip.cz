$(function(){

    $('#testbutton').click(function(){
        $.getJSON('/testy/test-socket',function(xhr){
            $('#testbox').html(xhr.neco);
        });
    });

    $(".twee").twitter_autolink();
    
    $('.bxslider').bxSlider({
        auto:true,
        mode:'fade',
        pager:false,
        controls:false,
        speed:5000,
        useCSS:false,
        randomStart:true
    });


    $('form').validate({
        rules: {
            jmeno: {
                minlength: 2,
                maxlength: 50,
                required: true
            },
            telefon: {
                minlength: 9,
                maxlength: 30,
                required: true
            },
            email: {
                required: true,
                email: true,
                minlength: 5,
                maxlength: 100
            },
            zprava: {
                minlength: 5,
                required: true
            }
        },


        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    




});