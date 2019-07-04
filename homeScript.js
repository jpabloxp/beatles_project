
$(function(){

    //UPDATE INSTRUMENT INFORMATION OF EACH BEATLE FOR THE GIVEN ALBUM
    phpCall($(".carousel-inner").find('.active img').attr('id'), 95);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 96);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 97);
    phpCall($(".carousel-inner").find('.active img').attr('id'), 98);

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

                //UPDATE INSTRUMENT INFORMATION OF EACH BEATLE FOR THE GIVEN ALBUM
                if(option == 95){

                    $('.homeLennon').empty();
                    $('.homeLennon').append(msg);
                }
                else if(option == 96){

                    $('.homeMacca').empty();
                    $('.homeMacca').append(msg);
                }
                else if(option == 97){

                    $('.homeHarrison').empty();
                    $('.homeHarrison').append(msg);
                }
                else if(option == 98){

                    $('.homeRingo').empty();
                    $('.homeRingo').append(msg);
                }
            }
        })

    }

});
