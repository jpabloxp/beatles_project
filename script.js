
$(function(){

    
    phpCall($(".carousel-inner").find('.active img').attr('id'), 1);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 2);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 3);

    $(".right.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "last") {
            nextAlbum = $('.carousel-inner').children().first().find('img').attr('id');
        } else {
            nextAlbum = activeSlide.next().find('img').attr('id');
        }
        console.log(nextAlbum);
        phpCall(nextAlbum, 1);
        phpCall(nextAlbum, 2);
    });

    $(".left.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "first") {
            prevAlbum = $('.carousel-inner').children().last().find('img').attr('id');
        } else {
            prevAlbum = activeSlide.prev().find('img').attr('id');
        }
        console.log(prevAlbum);
        phpCall(prevAlbum, 1);
        phpCall(prevAlbum, 2);

    });

    $(document).on ("click", ".song", function () {

        var activeSong = $(this).text();
        
        $(".songInfo").css({"border-top-color": "lightgrey", 
        "border-top-width":"2px", 
        "border-top-style":"solid"});

        $('.songInfo').empty();
        $('.songInfo').append("<h3>" + activeSong + "</h3>");
    });

    function phpCall(currentAlbum, option){

        var parameters = {
            'option': option,
            'album': currentAlbum
        };

        $.ajax({
            url: 'query.php',
            method:'POST',
            data: parameters,
            success: function(msg) {

                if(option == 1){

                    $('.titulo').empty();
                    $('.titulo').append(msg);
                }
                else if(option == 2){

                    $('.songList').empty();
                    $('.songList').append('<p class="trackHeader">Track list:</p>');
                    $('.songList').append(msg);
                }
                else if(option == 3){

                    $('.albumFooter').empty();
                    $('.albumFooter').append(msg);
                }
            }
        })

    }




    /* var parameters = { 
        'w': $('input[name="w"]').val(),
        'submit': $('input[name="submit"]').val()
      }; */

});
