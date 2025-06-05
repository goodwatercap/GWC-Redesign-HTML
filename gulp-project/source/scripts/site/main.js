$(window).on("load", function () {
  $("body").addClass("is-loaded");

  // menu open script starts here
  $(".js-menu").on("click", function (e) {
    e.preventDefault();
    $("body").toggleClass("is-navopen");
  });
  // menu open script ends here

  // Detect device type starts here
  $("body").addClass("os-" + $.browser.platform);
  $("body").addClass($.browser.name);
  if ($.browser.desktop == true) {
    $("body").removeClass("mobile").removeClass("ipad").addClass("desktop");
  }
  if ($.browser.mobile == true) {
    $("body").removeClass("desktop").removeClass("ipad").addClass("mobile");
  }
  if ($.browser.ipad == true) {
    $("body").removeClass("mobile").removeClass("desktop").addClass("ipad");
  }
  // Detect device type ends here

  // healthcare slider scripts starts here
  function historySlider() {
    $(".healthcare__cards").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: false,
      arrows: false,
      centerMode: false,
      autoplay: true,
      fade: true,
      adaptiveHeight: true,
    });
    $(".healthcare__arrow--prev").on("click", function () {
      $(".healthcare__cards").slick("slickPrev");
    });
    $(".healthcare__arrow--next").on("click", function () {
      $(".healthcare__cards").slick("slickNext");
    });
  }

  historySlider();
  // healthcare slider scripts ends here

  // model slider scripts starts here
  function modelSlider() {
    $(".model__slider").on(
      "beforeChange",
      function (event, slick, currentSlide, nextSlide) {
        $(".model__loop svg g").attr("class", "");
        $(".model__loop svg [data-nav=" + nextSlide + "]").attr(
          "class",
          "is-active"
        );
      }
    );
    $(".model__slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: ".model__title-slider",
      focusOnSelect: true,
      draggable: false,
      swipe: false,
      autoplay: false,
      autoplaySpeed: 3000,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            dots: true,
            autoplay: false,
          },
        },
      ],
    });

    $(".model__title-slider").slick({
      slidesToShow: 3,
      slidesToScroll: 3,
      dots: false,
      arrows: false,
      vertical: true,
      verticalSwiping: false,
      focusOnSelect: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      draggable: false,
      swipe: false,
      infinite: false,
      asNavFor: ".model__slider",
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            vertical: false,
            verticalSwiping: false,
            infinite: true,
            focusOnSelect: false,
          },
        },
      ],
    });
  }
  modelSlider();

  $(".model__title-slider").on("mouseenter", function () {
    $(".model__slider").slick("slickPause");
  });
  $(".model__title-slider").on("mouseleave", function () {
    $(".model__slider").slick("slickPlay");
  });
  // model slider scripts ends here

  // investment popup scripts starts here
  $(".investment__value").on("click", function (e) {
    $(this).children(".investment__count").addClass("open");
    $(".investment__seek").addClass("show");
    $(".investment__count-outer").addClass("remove");
    e.stopPropagation();
  });
  $(document).on("click", function (e) {
    if ($(e.target).is(".investment__value") === false) {
      $(".investment__seek").removeClass("show");
      $(".investment__count-outer").remove("remove");
      $(".investment__count").removeClass("open");
    }
  });
  $(".investment__count-close").on("click", function (e) {
    $(".investment__seek").removeClass("show");
    $(".investment__count-outer").remove("remove");
    $(".investment__count").removeClass("open");
    e.stopPropagation();
  });

  $(".banner__value").on("click", function (e) {
    $(this).children(".banner__count").addClass("open");
    $(".banner__seek").addClass("show");
    $(".banner__count-outer").addClass("remove");
    e.stopPropagation();
  });
  $(document).on("click", function (e) {
    if ($(e.target).is(".banner__value") === false) {
      $(".banner__seek").removeClass("show");
      $(".banner__count-outer").remove("remove");
      $(".banner__count").removeClass("open");
    }
  });
  $(".banner__count-close").on("click", function (e) {
    $(".banner__seek").removeClass("show");
    $(".banner__count-outer").remove("remove");
    $(".banner__count").removeClass("open");
    e.stopPropagation();
  });

  // investment popup scripts starts here

  // delivery slider scripts starts here

  function deliverySlider() {
    $(".delivery__slider").slick({
      slidesToShow: 1,
      dots: true,
      arrows: true,
      centerMode: true,
      centerPadding: "128px",
      autoplay: true,
      variableWidth: true,
      pauseOnFocus: false,
      pauseOnHover: true,
      draggable: true,
      pauseOnDotsHover: true,
      focusOnSelect: true,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            centerPadding: "80px",
            variableWidth: false,
          },
        },
        {
          breakpoint: 480,
          settings: {
            centerPadding: "40px",
            variableWidth: false,
            pauseOnHover: false,
            pauseOnDotsHover: false,
            dots: false,
          },
        },
      ],
    });
  }
  deliverySlider();

  // delivery slider scripts ends here

  //approach slider scripts starts here
  function approachSlider() {
    $(".approach__slider").slick({
      slidesToShow: 3,
      dots: false,
      arrows: false,
      centerMode: true,
      centerPadding: "196px",
      autoplay: true,
      variableWidth: true,
      pauseOnFocus: true,
      pauseOnHover: true,
      focusOnSelect: true,
      autoplaySpeed: 3000,
      draggable: true,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            centerPadding: "27px",
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            variableWidth: false,
            centerMode: false,
          },
        },
      ],
    });

    $(".approach__arrow--prev").on("click", function () {
      $(".approach__slider").slick("slickPrev");
    });
    $(".approach__arrow--next").on("click", function () {
      $(".approach__slider").slick("slickNext");
    });
  }

  approachSlider();
  //approach slider scripts endss here

  // filter scripts starts here
  $(".filter__tab .filter__tabup").on("click", function () {
    $(this).parent(".filter__tab").find(".filter__tab-collapse").slideToggle();
    $(this).toggleClass("arrow--rotate");
  });
  $(".js-filter").on("click", function () {
    $("body").find(".filter__search-mobile").slideToggle();
  });
  // filter scripts ends here

  //about hero accordion slider scripts starts here
  function aboutHeroAccordion() {
    $(".toggle__btn").on("click", function (e) {
      e.preventDefault();

      $(".hero__toggle-wrap").addClass("is-animating");
      var parent = $(this).closest(".hero__toggle-item");
      var me = $(this);
      if (!parent.hasClass("active")) {
        $(".hero__toggle-item").removeClass("active");
        $(".toggle__btn").removeClass("hid");
        parent.addClass("active");
        me.addClass("hid");

        setTimeout(function () {
          $(".hero__toggle-wrap").removeClass("is-animating");
        }, 800);
      }
      if ($(window).width() < 992) {
        $([document.documentElement, document.body]).animate(
          {
            scrollTop: $(".hero__toggle-item.active").offset().top - 60,
          },
          300
        );
      }
    });
    if ($(".theme__wrapper").hasClass("about")) {
      $("header").addClass("about-header");
    }
  }
  aboutHeroAccordion();
  AOS.init();
});
//about hero accordion slider scripts starts here

// filter components wrapping scripts starts here

function filterList() {
  $(".filter__items").each(function () {
    var t = $(this).find("li");
    for (var e = 0; e < t.length; e += 4)
      t.slice(e, e + 4).wrapAll("<li><ul class='clients__wrap'></ul></li>");
  });
}
filterList();
// filter components wrapping scripts ends here

// meet slider scripts starts here
function meetSlider() {
  $(".meet__cards").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    centerMode: false,
    autoplay: false,
    fade: true,
  });
  $(".meet__arrow--prev").on("click", function () {
    $(".meet__cards").slick("slickPrev");
  });
  $(".meet__arrow--next").on("click", function () {
    $(".meet__cards").slick("slickNext");
  });
}

$(window).on("load", function () {
  meetSlider();
});
// meet slider scripts ends here

// devcice detecting script starts here
$(document).ready(function () {
  var isAndroid = navigator.userAgent.toLowerCase().indexOf("android");
  if (isAndroid > -1) {
    $("body").addClass("android");
  }
});
// devcice detecting script ends here

//filter script for opening and closing starts here
$(window).click(function () {
  $(".filter__subnav").slideUp();
});
$(document).ready(function () {
  $(".filter__nav ul > li > .primary").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(".filter__subnav").not($(this).siblings(".filter__subnav")).slideUp();
    $(this).siblings(".filter__subnav").slideDown();
  });
  $(".filter__subnav a").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).parent("li").toggleClass("active");
  });
});
//filter script for opening and closing ends here

// privacy policy scroll when clicking a tag scripts starts
$(document).ready(function () {
  $(".privacy-policy .standard-text a.link-to-same-page").on(
    "click",
    function (e) {
      e.preventDefault();
      $("html, body").animate(
        {
          scrollTop: $(this.hash).offset().top - 100,
        },
        500
      );
    }
  );
});
// privacy policy scroll when clicking a tag scripts ends

// detetct an element is on viewport scripts starts
function isScrolledIntoView(elem) {
  var docViewTop = $(window).scrollTop();
  var docViewBottom = docViewTop + $(window).height();

  var elemTop = $(elem).offset().top;
  var elemBottom = elemTop + $(elem).height();

  return elemBottom <= docViewBottom && elemTop >= docViewTop;
}
// detetct an element is on viewport scripts  ends here

// model slider sctipts starts here
$(window).scroll(function () {
  function modelSlider() {
    $(".model__slider").on(
      "beforeChange",
      function (event, slick, currentSlide, nextSlide) {
        $(".model__loop svg g").attr("class", "");
        $(".model__loop svg [data-nav=" + nextSlide + "]").attr(
          "class",
          "is-active"
        );
      }
    );
    $(".model__slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: ".model__title-slider",
      focusOnSelect: true,
      draggable: false,
      swipe: false,
      autoplay: false,
      autoplaySpeed: 3000,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            dots: true,
            autoplay: false,
          },
        },
      ],
    });

    $(".model__title-slider").slick({
      slidesToShow: 3,
      slidesToScroll: 3,
      dots: false,
      arrows: false,
      vertical: true,
      verticalSwiping: false,
      focusOnSelect: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      draggable: false,
      swipe: false,
      infinite: false,
      asNavFor: ".model__slider",
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            vertical: false,
            verticalSwiping: false,
            infinite: true,
            focusOnSelect: false,
          },
        },
      ],
    });
  }

  $(".gwc.model .model__wrap .model__title .model__head h2").each(function () {
    if (isScrolledIntoView(this) === true) {
      $(".model__slider").slick("slickPlay");
      $(".model__slider")[0].slick.refresh();
    }
  });
});
// model slider sctipts ends here

//accordion scripts starts here
$(".l-accordion__title ").on("click", function (e) {
  var accordion = $(this).parent(".l-accordion");
  if ($(accordion).hasClass("is-open")) {
    $(accordion).removeClass("is-open");
    $(".l-accordion__content").slideUp();
  } else {
    $(".l-accordion__content").slideUp();
    $(accordion).find(".l-accordion__content").slideDown();
    $(".l-accordion").removeClass("is-open");
    $(accordion).addClass("is-open");
  }
});
//accordion scripts ends here

// goal animation for desktop starts here
$(window).on("load", function () {
  ScrollTrigger.normalizeScroll(true);

  let normalizer = ScrollTrigger.normalizeScroll();
  if (window.matchMedia("(min-width: 992px)").matches) {
    let gwcLogoPos = {};
    let gwcLogoWidth = 0;
    let subslides = document.querySelectorAll(".goal__subslide");
    gwcLogoPos = $(".goal__head img").offset();
    gwcLogoWidth = $(".goal__head img").width();

    if ($(".gwc.goal")[0]) {
      gsap.registerPlugin(ScrollTrigger);
      const goalAnimate = gsap.timeline({
        scrollTrigger: {
          trigger: ".gwc.goal",
          pin: ".gwc.goal",
          scrub: 1,
          start: "-=10%",
          end: "+=300%",
        },
      });

      goalAnimate
        .to('[data-slide="1"] .goal__subhead', {
          opacity: 0,
          duration: 1.5,
        })
        .to(
          '[data-slide="1"] span img',
          {
            opacity: 1,
            duration: 1,
          },
          "<"
        )
        .to('[data-slide="1"] span img', {
          opacity: 0,
          duration: 0.01,
        })
        .from(
          '[data-slide="2"] .goal__thumb svg',
          {
            width: gwcLogoWidth,
            top: gwcLogoPos.top,
            left: gwcLogoPos.left,
            duration: 1,
          },
          "<"
        )
        .from(
          '[data-slide="2"] .goal__thumb img',
          {
            width: gwcLogoWidth,
            top: gwcLogoPos.top,
            left: gwcLogoPos.left,
            duration: 1,
          },
          "<"
        );

      subslides.forEach((target) => {
        goalAnimate
          .from(target, {
            opacity: 0,
            duration: 1,
          })
          .to(target, {
            opacity: 0,
            duration: 1,
          });
      });

      goalAnimate
        .from(".goal__nav", {
          opacity: 0,
          duration: 1,
        })
        .from(
          ".goal__points",
          {
            opacity: 0,
            duration: 1,
          },
          "<"
        )
        .to(
          "#infy-initial",
          {
            opacity: 0,
            duration: 1,
          },
          "<"
        )
        .to(
          "#infy-genesis",
          {
            opacity: 1,
            duration: 1,
          },
          "<"
        )
        .to(
          ".goal__pwrap",
          {
            pointerEvents: "all",
            duration: 0.01,
          },
          "<"
        )

        .add(function () {
          $(".goal__link").removeClass("is-hover");
          $(".goal__link--1").addClass("is-hover");
          $(".goal__pwrap--gen").addClass("is-hover");
          $(".goal__link--gen").addClass("is-hover");
        }, "<");
    }

    $(".goal__link").click(function () {
      $(".goal__link").removeClass("is-hover");
      $(".goal__pwrap").removeClass("is-hover");
      var dataType = $(this).attr("data-type");
      $(".goal__pwrap[data-type = " + dataType + "]").addClass("is-hover");
      $(this).addClass("is-hover");
      $(".goal__thumb svg g").attr("class", "");
      $(".goal__thumb svg [data-type=" + dataType + "]").attr(
        "class",
        "is-active"
      );
    });

    $(".goal__pwrap").click(function () {
      $(".goal__link").removeClass("is-hover");
      $(".goal__pwrap").removeClass("is-hover");
      var dataType = $(this).attr("data-type");
      $(".goal__link[data-type = " + dataType + "]").addClass("is-hover");
      $(this).addClass("is-hover");
      $(".goal__thumb svg g").attr("class", "");
      $(".goal__thumb svg [data-type=" + dataType + "]").attr(
        "class",
        "is-active"
      );
    });
  }
});
// goal animation for desktop ends here

// goal slider slider(mobile) starts here
function goalSlider() {
  $(".goal__slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".goal__slider-values",
    focusOnSelect: true,
    draggable: false,
    swipe: false,
    autoplay: false,
    autoplaySpeed: 3000,
    dots: false,
  });

  $(".goal__slider-values").slick({
    pauseOnHover: true,
    draggable: true,
    swipe: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    vertical: false,
    verticalSwiping: false,
    infinite: true,
    focusOnSelect: false,
    asNavFor: ".goal__slider",
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          vertical: false,
          verticalSwiping: false,
          infinite: true,
          focusOnSelect: false,
        },
      },
    ],
  });
  $(".goal__arrow--prev").on("click", function () {
    $(".goal__slider-values").slick("slickPrev");
  });
  $(".goal__arrow--next").on("click", function () {
    $(".goal__slider-values").slick("slickNext");
  });
}
goalSlider();
// goal slider slider(mobile) ends here


//goal slider desktop
$(function() {
  $('.gwc.goal .goal__slider__desktop').slick({
    autoplay: true,
    fade: true,
    pauseOnHover: true,
  });

  $('.gwc.goal .goal__selection__area').on('click', function (e) {
    var selection = $(this).data('selection');
    $('.gwc.goal .goal__slider__desktop').slick('slickGoTo', selection - 1);
  })

  $('.gwc.goal .goal__selection__area').on('mouseenter',function (e) {
    var selection = $(this).data('selection');
    $(`.gwc.goal .goal__point.point-${selection}`).addClass('hover');
    $(`.gwc.goal .goal__selection > [data-selection="${selection}"]`).addClass('hover');
  });
  $('.gwc.goal .goal__selection__area').on('mouseleave',function (e) {
    var selection = $(this).data('selection');
    $(`.gwc.goal .goal__point.point-${selection}`).removeClass('hover');
    $(`.gwc.goal .goal__selection > [data-selection="${selection}"]`).removeClass('hover');
  });
});
//