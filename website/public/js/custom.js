// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});








// Owl Carousel End..................


//HomePage Contact form handle with axios

$('#contactFormSubmit').click(function(){

    let name = $('#nameId').val();
    let phone = $('#phoneId').val();
    let email = $('#emailId').val();
    let message = $('#messageId').val();


    if( name.length == 0){

        $('#contactFormSubmit').html('Please Fill Out Name');
        
    }else if( phone.length == 0){
        $('#contactFormSubmit').html('Please Fill Out Phone');

    }else if(email.length == 0){
        $('#contactFormSubmit').html('Please Fill Out Email');

    }else if(message.length == 0){
        $('#contactFormSubmit').html('Please Fill Out Message');

    }else{

        $('#contactFormSubmit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');


        axios.post('/homeContact', {

            name:name,
            phone:phone,
            email:email,
            message:message

        })
        .then(function(response){

            if(response.status == 200){

                if(response.data == 1){

                    $('#contactFormSubmit').html('Your Data Successfully Sent!');

                }else{
                    $('#contactFormSubmit').html('Failed! Try again!');
                }

            }else{

                $('#contactFormSubmit').html('Failed! Try again!');

            }

        })
        .catch(function(error){
            $('#contactFormSubmit').html('Something Wrong! Try again!');

        })
    }
});