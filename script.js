
$(function(){

    
    phpCall($(".carousel-inner").find('.active img').attr('id'));

    $(".right.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "last") {
            nextAlbum = $('.carousel-inner').children().first().find('img').attr('id');
        } else {
            nextAlbum = activeSlide.next().find('img').attr('id');
        }
        console.log(nextAlbum);
        phpCall(nextAlbum);
    });

    $(".left.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "first") {
            prevAlbum = $('.carousel-inner').children().last().find('img').attr('id');
        } else {
            prevAlbum = activeSlide.prev().find('img').attr('id');
        }
        console.log(prevAlbum);
        phpCall(prevAlbum);

    });

    function phpCall(currentAlbum){

        var parameters;
    
        if(currentAlbum === "let_it_be"){
    
            parameters = { 
                'album': 14,
            };
        }
        else if(currentAlbum === "abbey_road"){
    
            parameters = { 
                'album': 11,
            };
        }
        else if(currentAlbum === "white_album"){
    
            parameters = { 
                'album': 9,
            };
        }
        else if(currentAlbum === "magical_mystery_tour"){
    
            parameters = { 
                'album': 6,
            };
        }
        else if(currentAlbum === "sgt_peppers"){
    
            parameters = { 
                'album': 4,
            };
        }

        $.ajax({
            url: 'query.php',
            method:'POST',
            data: parameters,
            success: function(msg) {
                $('.titulo').empty();
                $('.titulo').append(msg);
            }
        })

    }




    /* var parameters = { 
        'w': $('input[name="w"]').val(),
        'submit': $('input[name="submit"]').val()
      }; */

});
