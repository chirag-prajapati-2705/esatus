$(document).ready(function($) {
    "use strict";

    // Anchor Smooth Scroll
    $('body').on('click', '.page-scroll', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    // Intro Slider
    $('#main-slider').flexslider({
        animation: "fade",
        slideshowSpeed: 3500,
        controlNav: false,
        directionNav: false
    });

    // Testimonial Slider
    var owl = $("#quote-slider");
    owl.owlCarousel({
        navigation: true,
        navigationText: [
              "Précèdent",
              "Suivant"
      ],
        singleItem: true,
        autoHeight : true,
        transitionStyle: "fade",
        autoPlay: 3000
    });

    //Expert Slider 
    $('.expert-slider').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 5,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });


    // Prettyphoto
    $("a[class^='prettyPhoto']").prettyPhoto({
        theme: 'pp_default'
    });

    // Countdown Timer
    var endDate = "August 20, 2015";
        $('.countdown.styled').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html("<div>" + this.leadingZeros(data.days, 2) + " <span>days</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>hrs</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>min</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>sec</span></div>");
          }
    });

    //flip card 
    $("#card").flip({
      axis: 'y',
      trigger: 'hover'
    });

    $("#card1").flip({
      axis: 'y',
      trigger: 'hover'
    });

    $("#card2").flip({
      axis: 'y',
      trigger: 'hover'
    });

    $("#card3").flip({
      axis: 'y',
      trigger: 'hover'
    });

     $("#card4").flip({
      axis: 'y',
      trigger: 'hover'
    });

      $("#card5").flip({
      axis: 'y',
      trigger: 'hover'
    });

});

// Custom Popup
$(".term-popup").on("click", function() {
    $(".terms").addClass("terms-active");
    $(".overlay-dark").addClass("active");
});

$(".t-close").on("click", function() {
    $(".terms").removeClass("terms-active");
    $(".overlay-dark").removeClass("active");
});

