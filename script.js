
$(function(){

    
    //UPDATE THE TITLE, SONGS AND METADATA FOR THE GIVEN ALBUM
    phpCall($(".carousel-inner").find('.active img').attr('id'), 1);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 2);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 3);
    
    //UPDATE INSTRUMENT INFORMATION OF EACH BEATLE FOR THE GIVEN ALBUM
    phpCall($(".carousel-inner").find('.active img').attr('id'), 91);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 92);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 93);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 94);

    $(".right.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "last") {
            nextAlbum = $('.carousel-inner').children().first().find('img').attr('id');
        } else {
            nextAlbum = activeSlide.next().find('img').attr('id');
        }
        console.log(nextAlbum);
        //UPDATE THE TITLE, SONGS AND METADATA FOR THE GIVEN ALBUM
        phpCall(nextAlbum, 1);
        phpCall(nextAlbum, 2);
        phpCall(nextAlbum, 3);

        //UPDATE INSTRUMENT INFORMATION OF EACH BEATLE FOR THE GIVEN ALBUM
        phpCall(nextAlbum, 91);
        phpCall(nextAlbum, 92);
        phpCall(nextAlbum, 93);
        phpCall(nextAlbum, 94);
    });

    $(".left.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "first") {
            prevAlbum = $('.carousel-inner').children().last().find('img').attr('id');
        } else {
            prevAlbum = activeSlide.prev().find('img').attr('id');
        }
        console.log(prevAlbum);
        //UPDATE THE TITLE, SONGS AND METADATA FOR THE GIVEN ALBUM
        phpCall(prevAlbum, 1);
        phpCall(prevAlbum, 2);
        phpCall(prevAlbum, 3);

        //UPDATE INSTRUMENT INFORMATION OF EACH BEATLE FOR THE GIVEN ALBUM
        phpCall(prevAlbum, 91);
        phpCall(prevAlbum, 92);
        phpCall(prevAlbum, 93);
        phpCall(prevAlbum, 94);

    });

    $(document).on ("click", ".song", function () {

        var activeSong = $(this).text();
        
        $(".songInfo").css({"border-top-color": "lightgrey", 
        "border-top-width":"2px", 
        "border-top-style":"solid"});

        $('.songInfo').empty();
        $('.songInfo').append("<h3>" + activeSong + "</h3>");
        
        phpCall(activeSong, 4);
    });

    function phpCall(currentItem, option){

        var parameters = {
            'option': option,
            'item': currentItem
        };

        $.ajax({
            url: 'query.php',
            method:'POST',
            data: parameters,
            success: function(msg) {

                //UPDATE THE TITLE, SONGS AND METADATA FOR THE GIVEN ALBUM
                if(option == 1){

                    $('.titulo').empty();
                    $('.titulo').append(msg);
                }
                else if(option == 2){

                    $('.songList').empty();
                    $('.songList').append(msg);
                }
                else if(option == 3){

                    $('.albumFooter').empty();
                    $('.albumFooter').append(msg);
                }
                else if(option == 4){

                    $('.songInfo').append(msg);
                }
                
                //UPDATE INSTRUMENT INFORMATION OF EACH BEATLE FOR THE GIVEN ALBUM
                else if(option == 91){

                    $('.albumLennon').empty();
                    $('.albumLennon').append(msg);
                }
                else if(option == 92){

                    $('.albumMacca').empty();
                    $('.albumMacca').append(msg);
                }
                else if(option == 93){

                    $('.albumHarrison').empty();
                    $('.albumHarrison').append(msg);
                }
                else if(option == 94){

                    $('.albumRingo').empty();
                    $('.albumRingo').append(msg);
                }
            }
        })

    }

});
