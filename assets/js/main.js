/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. Back To Top Js
03. sticky header
04. Add tag 
05. Common Js
06. Mobile Menu Js
07. Add hover class
08. Offcanvas Js
09. Body overlay Js
10. One Page Scroll Js
11. Nice Select Js
12. MagnificPopup
15. Password Toggle Js
17. Wow Js
18. Counter Js
19. Filter Show
****************************************************/

(function ($) {
  "use strict";

  var windowOn = $(window);

  ////////////////////////////////////////////////////
  // 01. PreLoader Js
  windowOn.on("load", function () {
    $("#loading").fadeOut(500);
  });

  ////////////////////////////////////////////////////
  // 02. Back To Top Js
  function back_to_top() {
    var btn = $("#back_to_top");
    var btn_wrapper = $(".back-to-top-wrapper");

    windowOn.scroll(function () {
      if (windowOn.scrollTop() > 300) {
        btn_wrapper.addClass("back-to-top-btn-show");
      } else {
        btn_wrapper.removeClass("back-to-top-btn-show");
      }
    });

    btn.on("click", function (e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "300");
    });
  }
  back_to_top();

  ////////////////////////////////////////////////////
  // 03. sticky header
  function tp_pinned_header() {
    var lastScrollTop = 0;

    windowOn.on("scroll", function () {
      var currentScrollTop = $(this).scrollTop();

      if (currentScrollTop > lastScrollTop) {
        $(".tp-int-menu").removeClass("tp-header-pinned");
      } else if ($(this).scrollTop() <= 500) {
        $(".tp-int-menu").removeClass("tp-header-pinned");
      } else {
        // Scrolling up, remove the class
        $(".tp-int-menu").addClass("tp-header-pinned");
      }
      lastScrollTop = currentScrollTop;
    });
  }
  tp_pinned_header();

  ////////////////////////////////////////////////////
  // 04. Common Js
  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url( " + $(this).attr("data-background") + "  )"
    );
  });

  $("[data-width]").each(function () {
    $(this).css("width", $(this).attr("data-width"));
  });

  $("[data-bg-color]").each(function () {
    $(this).css("background-color", $(this).attr("data-bg-color"));
  });

  $("[data-text-color]").each(function () {
    $(this).css("color", $(this).attr("data-text-color"));
  });

  ////////////////////////////////////////////////////
  // 05. Mobile Menu Js
  var tpMenuWrap = $(".tp-mobile-menu-active > ul").clone();
  var tpSideMenu = $(".tp-offcanvas-menu nav");
  tpSideMenu.append(tpMenuWrap);
  if ($(tpSideMenu).find(".sub-menu, .tp-mega-menu").length != 0) {
    $(tpSideMenu)
      .find(".sub-menu, .tp-mega-menu")
      .parent()
      .append(
        '<button class="tp-menu-close"><i class="fas fa-chevron-right"></i></button>'
      );
  }

  var sideMenuList = $(
    ".tp-offcanvas-menu nav > ul > li button.tp-menu-close, .tp-offcanvas-menu nav > ul li.has-dropdown > a"
  );
  $(sideMenuList).on("click", function (e) {
    e.preventDefault();
    if (!$(this).parent().hasClass("active")) {
      $(this).parent().addClass("active");
      $(this).siblings(".sub-menu, .tp-mega-menu").slideDown();
    } else {
      $(this).siblings(".sub-menu, .tp-mega-menu").slideUp();
      $(this).parent().removeClass("active");
    }
  });

  ////////////////////////////////////////////////////
  // 06. Offcanvas Js
  $(".offcanvas-open-btn").on("click", function () {
    $(".offcanvas__area").addClass("offcanvas-opened");
    $(".body-overlay").addClass("opened");
  });
  $(
    ".offcanvas-close-btn ,.tp-main-menu-mobile .tp-onepage-menu li a  > *:not(button)"
  ).on("click", function () {
    $(".offcanvas__area").removeClass("offcanvas-opened");
    $(".body-overlay").removeClass("opened");
  });

  ////////////////////////////////////////////////////
  // 07. Body overlay Js
  $(".body-overlay").on("click", function () {
    $(".offcanvas__area").removeClass("offcanvas-opened");
    $(".tp-search-area").removeClass("opened");
    $(".cartmini__area").removeClass("cartmini-opened");
    $(".body-overlay").removeClass("opened");
  });

  ////////////////////////////////////////////////////
  // 08. One Page Scroll Js
  function scrollNav() {
    $(".tp-onepage-menu li a").click(function () {
      $(".tp-onepage-menu li a.active").removeClass("active");
      $(this).addClass("active");

      $("html, body")
        .stop()
        .animate(
          {
            scrollTop: $($(this).attr("href")).offset().top - 100,
          },
          300
        );
      return false;
    });
  }
  scrollNav();

  ///////////////////////////////////////////////
  // 09. header search
  $(document).ready(function () {
    if ($("#tp-header-search").length > 0) {
      $(document).on("click", function (e) {
        if (
          $("#tp-header-search").is(e.target) ||
          $("#tp-header-search").has(e.target).length
        ) {
          $(".tp-header-search-input").toggleClass("active");
        } else {
          $(".tp-header-search-input").removeClass("active");
        }
      });
    }
  });

  ////////////////////////////////////////////////////
  // Service Slider Active
  if ($(".tp-service-active").length > 0) {
    var slider = new Swiper(".tp-service-active", {
      slidesPerView: 3,
      spaceBetween: 24,
      loop: true,
      freeMode: true,
      breakpoints: {
        1400: {
          slidesPerView: 3,
        },
        1200: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 2,
        },
        576: {
          slidesPerView: 1,
        },
        0: {
          slidesPerView: 1,
        },
      },
    });
  }

  ////////////////////////////////////////////////////
  // Portfolio Slider Active
  if ($(".tp-portfolio-active").length > 0) {
    var slider = new Swiper(".tp-portfolio-active", {
      slidesPerView: 4,
      spaceBetween: 30,
      loop: true,
      speed: 1000,
      autoplay: true,
      freeMode: true,
      breakpoints: {
        1400: {
          slidesPerView: 4,
        },
        1200: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 2,
        },
        576: {
          slidesPerView: 1,
        },
        0: {
          slidesPerView: 1,
        },
      },
    });
  }

  ////////////////////////////////////////////////////
  // Portfolio Slider Active
  if ($(".tp-portfolio-3-active").length > 0) {
    var slider = new Swiper(".tp-portfolio-3-active", {
      slidesPerView: 4,
      spaceBetween: 30,
      loop: true,
      speed: 1000,
      autoplay: true,
      freeMode: true,
      breakpoints: {
        1400: {
          slidesPerView: 4,
        },
        1200: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 2,
        },
        576: {
          slidesPerView: 1,
        },
        0: {
          slidesPerView: 1,
        },
      },
      navigation: {
        nextEl: ".tp-portfolio-next",
        prevEl: ".tp-portfolio-prev",
      },
    });
  }

  ////////////////////////////////////////////////////
  // Portfolio Slider Active
  if ($(".tp-portfolio-4-active").length > 0) {
    var slider = new Swiper(".tp-portfolio-4-active", {
      slidesPerView: 3,
      spaceBetween: 30,
      loop: true,
      speed: 1000,
      autoplay: true,
      freeMode: true,
      breakpoints: {
        1400: {
          slidesPerView: 3,
        },
        1200: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 2,
        },
        576: {
          slidesPerView: 1,
        },
        0: {
          slidesPerView: 1,
        },
      },
      navigation: {
        nextEl: ".tp-portfolio-next",
        prevEl: ".tp-portfolio-prev",
      },
    });
  }

  ////////////////////////////////////////////////////
  // Testimonial slide active
  var slider = new Swiper(".tp-testimonial-active", {
    slidesPerView: 1,
    speed: 1500,
    loop: true,
    spaceBetween: 30,
    navigation: {
      nextEl: ".tp-testimonial-next",
      prevEl: ".tp-testimonial-prev",
    },
    autoplay: {
      delay: 4000,
    },
  });

  ////////////////////////////////////////////////////
  // Testimonial slide active
  var slider = new Swiper(".tp-testimonial-4-active", {
    slidesPerView: 2,
    speed: 1500,
    loop: true,
    spaceBetween: 30,
    navigation: {
      nextEl: ".tp-testimonial-next",
      prevEl: ".tp-testimonial-prev",
    },
    breakpoints: {
      1200: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      576: {
        slidesPerView: 1,
      },
      0: {
        slidesPerView: 1,
      },
    },
    autoplay: {
      delay: 4000,
    },
  });

  //////////////////////////////////
  // tp-testimonial-content-active
  var slider = new Swiper(".tp-testimonial-content-active", {
    slidesPerView: 1,
    centeredSlides: true,
    loop: true,
    loopedSlides: 3,
    // Navigation arrows
    navigation: {
      nextEl: ".tp-testimonial-next",
      prevEl: ".tp-testimonial-prev",
    },
  });
  var thumbs = new Swiper(".tp-testimonial-thumb-active", {
    slidesPerView: 3,
    spaceBetween: 10,
    centeredSlides: true,
    loop: true,
    slideToClickedSlide: true,
  });
  slider.controller.control = thumbs;
  thumbs.controller.control = slider;

  //////////////////////////////////////////////////
  // tp-brand-slide-active
  var brand = new Swiper(".tp-brand-slide-active", {
    loop: true,
    spaceBetween: 0,
    speed: 2000,
    autoplay: true,
    breakpoints: {
      1200: {
        slidesPerView: 6,
      },
      992: {
        slidesPerView: 5,
      },
      768: {
        slidesPerView: 4,
      },
      576: {
        slidesPerView: 3,
      },
      0: {
        slidesPerView: 2,
      },
    },
  });

  ////////////////////////////////////////////////////
  // Blog Active
  if ($(".tp-blog-post-active").length > 0) {
    var slider = new Swiper(".tp-blog-post-active", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      // Navigation arrows
      navigation: {
        nextEl: ".tp-blog-next-1",
        prevEl: ".tp-blog-prev-1",
      },
    });
  }

  ////////////////////////////////////////////////////
  /* 11. MagnificPopup img view */
  $(".popup-image").magnificPopup({
    type: "image",
    gallery: {
      enabled: true,
    },
  });

  /* magnificPopup video view */
  $(".popup-video").magnificPopup({
    type: "iframe",
  });

  //////////////////////////////////////////////////
  // 12. Hover to Active
  $(".tp-feature-item").on("mouseenter", function () {
    $(this)
      .addClass("active")
      .parent()
      .siblings()
      .find(".tp-feature-item")
      .removeClass("active");
  });

  ///////////////////////////////////////
  // 14. Wow Js
  new WOW().init();

  ///////////////////////////////////////
  // 15. Counter Js
  new PureCounter();

  // 16. For header lang //
  if ($("#tp-header-lang-toggle").length > 0) {
    window.addEventListener("click", function (e) {
      if (document.getElementById("tp-header-lang-toggle").contains(e.target)) {
        $(".tp-lang-list").toggleClass("tp-lang-list-open");
      } else {
        $(".tp-lang-list").removeClass("tp-lang-list-open");
      }
    });
  }

  //////////////////////////////
  // 17. For pricing tab //
  function tabtable_active() {
    const $elements = {
      monthly: $("#tp-nav-monthly"),
      yearly: $("#tp-nav-yearly"),
      switcher: $("#tp-switcher-input"),
      tabMonthly: $("#tp-tab-monthly"),
      tabYearly: $("#tp-tab-yearly"),
    };

    const setActive = (isMonthly) => {
      $elements.switcher.prop("checked", isMonthly);
      $elements.monthly.toggleClass("is-active", isMonthly);
      $elements.yearly.toggleClass("is-active", !isMonthly);
      $elements.tabMonthly.toggleClass("tp-tab-hide", !isMonthly);
      $elements.tabYearly.toggleClass("tp-tab-hide", isMonthly);
    };

    [$elements.monthly, $elements.yearly].forEach(($el) =>
      $el.on("click", () => setActive($el.is($elements.monthly)))
    );

    $elements.switcher.on("click", () =>
      setActive(!$elements.monthly.hasClass("is-active"))
    );
  }
  if ($("#tp-nav-monthly").length) tabtable_active();

  /////////////////////////////////
  // 18. For accordion add class
  $(document).ready(function () {
    $(".accordion-header").on("click", function () {
      $(".accordion-item").removeClass("active");
      $(this).closest(".accordion-item").addClass("active");
    });
  });

  /////////////////////////////////
  // 19. Smoth scroll
  function smoothSctoll() {
    $(".smooth a").on("click", function (event) {
      var target = $(this.getAttribute("href"));
      if (target.length) {
        event.preventDefault();
        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: target.offset().top - 120,
            },
            1500
          );
      }
    });
  }
  smoothSctoll();

  // tp_ecommerce
  function tp_ecommerce() {
    $(".tp-cart-minus").on("click", function () {
      var $input = $(this).parent().find("input");
      var count = parseInt($input.val()) - 1;
      count = count < 1 ? 1 : count;
      $input.val(count);
      $input.change();
      return false;
    });

    $(".tp-cart-plus").on("click", function () {
      var $input = $(this).parent().find("input");
      $input.val(parseInt($input.val()) + 1);
      $input.change();
      return false;
    });

    //  tpReturnCustomerLoginForm //
    $(".tp-checkout-login-form-reveal-btn").on("click", function () {
      $("#tpReturnCustomerLoginForm").slideToggle(400);
    });

    //  Show Coupon Toggle Js //
    $(".tp-checkout-coupon-form-reveal-btn").on("click", function () {
      $("#tpCheckoutCouponForm").slideToggle(400);
    });

    // Create An Account Toggle Js //
    $("#cbox").on("click", function () {
      $("#cbox_info").slideToggle(900);
    });

    // Shipping Box Toggle Js //
    $("#ship-box").on("click", function () {
      $("#ship-box-info").slideToggle(1000);
    });
  }
  tp_ecommerce();
})(jQuery);
