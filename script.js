
$(function(){

    console.log($(".carousel-inner").find('.active img').attr('id')); 


    $(".right.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "last") {
            nextImage = $('.carousel-inner').children().first().find('img').attr('id');
        } else {
            nextImage = activeSlide.next().find('img').attr('id');
        }
        console.log(nextImage);
    });

    $(".left.carousel-control").click(function(){

        var activeSlide = $('.active');

        if (activeSlide.find('img').attr('alt') === "first") {
            prevImage = $('.carousel-inner').children().last().find('img').attr('id');
        } else {
            prevImage = activeSlide.prev().find('img').attr('id');
        }
        console.log(prevImage);
    });
});
