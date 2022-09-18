jQuery('.play-button').on('click', function () {
    jQuery(this).hide();
    jQuery(this).parent().fadeOut();
    jQuery(this).parent().siblings('.slider-video')[0].play();
});

jQuery('.slider-video').on('play', function () {
    jQuery(this).attr('controls', '1');
});

// Additionnal code for the slider
/*var pos = 0,
    slides = jQuery('.slide'),
    numOfSlides = slides.length;

function nextSlide(){
    stopCurrentVideo();
    slides.eq(pos).animate({left:'-100%'},500);
    pos = pos >= numOfSlides-1 ? 0 : ++pos;
    slides.eq(pos).css({left:'100%'}).animate({left:0},500);
}

function previousSlide(){
    stopCurrentVideo();
    slides.eq(pos).animate({left:'100%'},500);
    pos = pos == 0 ? numOfSlides-1 : --pos;
    slides.eq(pos).css({left:'-100%'}).animate({left:0},500);
}

function stopCurrentVideo(){
    jQuery('.slider-video:eq('+pos+')').load().removeAttr('controls')
    .siblings('.overlay-content').show().find('.play-button').show();
}

jQuery('.left').click(previousSlide);
jQuery('.right').click(nextSlide);*/