(function ($) {
   // Functions
   var lastScrollTop = 0;
   var initLastScrollTop = function () {
      var st = $(window).scrollTop();
      lastScrollTop = st;
   };
   var isScrollDown = function () {
      var st = $(window).scrollTop();
      return (st > lastScrollTop);
   };
   var initMobileMenu = function () {
      $('.astroid-mobile-menu').astroidMobileMenu();
      $('#astroid-offcanvas').find('.nav.menu').astroidMobileMenu();
      $('.astroid-mobile-menu').removeClass('d-none');
   };
   var initDisplay = function () {
      setTimeout(function () {
         $('.d-init').removeClass('d-none');
      }, 100);
   };
   var initOffPageContent = function () {
      $('.off-page-content').each(function () {
         var _content = $(this);
         var _speed = 150;
         var _easing = 'swing';
         var _width = _content.width();
         var _overlay = $('<div class="off-page-overlay" />');
         var _close = $('<div class="off-page-close" />');
         var _inner = $('<div class="off-page-inner" />');
         var _body = $('body');
         var _animation = _content.data('off-page-animation');
         _content.removeClass('d-none');
         if (typeof _animation == 'undefined' || _animation == '' || _animation == null) {
            _animation = 'slide';
         }
         var _direction = _content.data('off-page-direction');
         if (typeof _direction == 'undefined' || _direction == '' || _direction == null) {
            _direction = 'left';
         }
         _content.wrapInner(_inner);
         _content.prepend(_overlay);
         _content.prepend(_close);

         _overlay.bind('click', function () {
            _content.animate({
               [_direction]: 0 - _width
            }, _speed, _easing, function () {
               _content.removeClass('opened');
            });
            _overlay.fadeOut(_speed);
            if (_animation == 'push') {
               _body.animate({
                  [_direction]: 0
               }, _speed, _easing, function () {
                  _body.removeClass('off-page-opened').removeClass('position-relative');
               });
            }
         });

         _close.bind('click', function () {
            _content.animate({
               [_direction]: 0 - _width
            }, _speed, _easing, function () {
               _content.removeClass('opened');
            });
            _overlay.fadeOut(_speed);
            if (_animation == 'push') {
               _body.animate({
                  [_direction]: 0
               }, _speed, _easing, function () {
                  _body.removeClass('off-page-opened').removeClass('position-relative');
               });
            }
         });
      });
      $('[data-off-page-content]').each(function () {
         var _this = $(this);
         var _content = $(_this.data('off-page-content'));
         var _overlay = _content.children('.off-page-overlay');
         var _animation = _content.data('off-page-animation');
         if (typeof _animation == 'undefined' || _animation == '' || _animation == null) {
            _animation = 'slide';
         }
         var _direction = _content.data('off-page-direction');
         if (typeof _direction == 'undefined' || _direction == '' || _direction == null) {
            _direction = 'left';
         }
         var _body = $('body');
         var _speed = 150;
         var _easing = 'swing';
         var _width = _content.width();
         _this.bind('click', function () {
            if (!_content.hasClass('opened')) {
               _content.animate({
                  [_direction]: 0
               }, _speed, _easing, function () {
                  _content.addClass('opened');
               });
               _overlay.fadeIn(_speed);
               if (_animation == 'push') {
                  _body.addClass('position-relative');
                  _body.animate({
                     [_direction]: _width
                  }, _speed, _easing, function () {
                     _body.addClass('off-page-opened');
                  });
               }
            } else {
               _content.animate({
                  left: 0 - _width
               }, _speed, _easing, function () {
                  _content.removeClass('opened');
               });
               _overlay.fadeOut(_speed);
               if (_animation == 'push') {
                  _body.animate({
                     left: 0
                  }, _speed, _easing, function () {
                     _body.removeClass('off-page-opened').removeClass('position-relative');
                  });
               }
            }
         });
      });
   };

   var initMegamenu = function () {
      $('.has-megamenu').hover(function () {
         var _this = this;
         $(_this).css('z-index', 3);
         var _megamenu = $(this).children('.megamenu-container');
         var _left = 0;
         var _center = ($(_this).offset().left) + ($(this).width() / 2);

         var _paddingx = parseInt(_megamenu.css('padding-left')) + parseInt(_megamenu.css('padding-right'));
         var _alignment = _megamenu.data('align');
         if (_megamenu.width() > $(window).width()) {
            _alignment = 'full';
         }
         var _space = 2;
         switch (_alignment) {
            case 'left':
               _left = 0;
               if (($(window).width() - _center) < (_megamenu.width() + _paddingx)) {
                  _left = 0 - ((_megamenu.width() + _paddingx) - (($(window).width() - _center) + (($(this).width() / 2) - 4)));
               }
               break;
            case 'right':
               _left = 0 - ((_megamenu.width() + _paddingx) - $(_this).width());
               if (_center < (_megamenu.width() + _paddingx)) {
                  _left = _left + ((_megamenu.width() + _paddingx) - _center) + 2 - ($(_this).width() / 2);
               }
               break;
            case 'center':
               _left = ($(_this).width() / 2) - (_megamenu.width() / 2);
               if (($(window).width() - _center) < (_megamenu.width() + _paddingx)) {
                  _left = 0 - ((_megamenu.width() + _paddingx) - (($(window).width() - _center) + (($(_this).width() / 2) - 4)));
               }
               break;
            case 'full':
               _megamenu.width($(window).width() - _paddingx - _space);
               _left = 0 - $(_this).offset().left;
               _left = _left;
               break;
         }

         if (ASTROID_MENU_ANIMATION == '') {
            _megamenu.stop(true, true).css('left', _left + 'px').slideDown(50);
            setTimeout(function () {
               $(_this).addClass('hovered');
            }, 25);
         } else {
            _megamenu.stop(true, true).css('left', _left + 'px').show().addClass('animated ' + ASTROID_MENU_ANIMATION);
            setTimeout(function () {
               if (_megamenu.hasClass('animated')) {
                  $(_this).addClass('hovered');
               }
            }, 1000);
         }
      }, function () {
         var _this = this;
         var _megamenu = $(this).children('.megamenu-container');
         if (ASTROID_MENU_ANIMATION == '') {
            setTimeout(function () {
               _megamenu.stop(true, true).slideUp(50);
               setTimeout(function () {
                  $(_this).removeClass('hovered');
                  $(_this).css('z-index', 0);
               }, 40);
            }, 50);
         } else {
            setTimeout(function () {
               _megamenu.stop(true, true).hide().removeClass('animated ' + ASTROID_MENU_ANIMATION);
               $(_this).removeClass('hovered');
               $(_this).css('z-index', 0);

            }, 50);
         }
      });
   };

   var initSubmenu = function () {
      $('.has-subnav').hover(function () {
         var _this = this;
         $(_this).css('z-index', 3);

         var _left = 0;
         var _subnav = $(this).children('.navbar-subnav');

         if (_subnav.width() > $(window).width()) {
            _subnav.width($(window).width() - 4);
         }

         var _center = ($(_this).offset().left) + ($(this).width() / 2);
         if (_subnav.hasClass('level-1')) {
            switch (_subnav.data('align')) {
               case 'left':
                  _left = 0;
                  if (($(window).width() - _center) < _subnav.width()) {
                     _left = 0 - (_subnav.width() - (($(window).width() - _center) + (($(_this).width() / 2) - 4)));
                  }
                  break;
               case 'right':
                  _left = 0 - (_subnav.width() - $(_this).width());
                  if (_center < _subnav.width()) {
                     _left = _left + (_subnav.width() - _center) + 2 - ($(_this).width() / 2);
                  }
                  break;
               case 'center':
                  _left = 0 - ((_subnav.width() / 2) - ($(_this).width() / 2));
                  if (_center < (_subnav.width() / 2)) {
                     _subnav.width() - _center;
                     _left = _left + ((_subnav.width() / 2) - _center) + 2;
                  }
                  break;
            }
         } else {
            _left = $(_this).offset().left + $(_this).width() + _subnav.width();
            if (_left >= $(window).width() - 10) {
               _left = 0 - (_subnav.width() + 4);
            } else {
               _left = $(_this).width();
            }
         }

         if (ASTROID_MENU_ANIMATION == '') {
            _subnav.stop(true, true).css('left', _left + 'px').slideDown(50);
            setTimeout(function () {
               $(_this).addClass('hovered');
            }, 25);
         } else {
            _subnav.stop(true, true).css('left', _left + 'px').show().addClass('animated ' + ASTROID_MENU_ANIMATION);
            setTimeout(function () {
               if (_subnav.hasClass('animated')) {
                  $(_this).addClass('hovered');
               }
            }, 1000);
         }

      }, function () {
         var _subnav = $(this).children('.navbar-subnav');
         var _this = this;
         if (ASTROID_MENU_ANIMATION == '') {
            setTimeout(function () {
               _subnav.stop(true, true).slideUp(50);
               setTimeout(function () {
                  $(_this).removeClass('hovered');
                  $(_this).css('z-index', 0);
               }, 40);
            }, 50);
         } else {
            setTimeout(function () {
               _subnav.stop(true, true).hide().removeClass('animated ' + ASTROID_MENU_ANIMATION);
               $(_this).removeClass('hovered');
               $(_this).css('z-index', 0);
            }, 50);
         }
      });
   };

   var initBackToTop = function () {
      $(window).scroll(function () {
         if ($(this).scrollTop() >= 200) {        // If page is scrolled more than 200px
            $('#astroid-backtotop').fadeIn(200);    // Fade in the arrow
         } else {
            $('#astroid-backtotop').fadeOut(200);   // Else fade out the arrow
         }
      });
      $('#astroid-backtotop').click(function () {      // When arrow is clicked
         $('body,html').animate({
            scrollTop: 0                       // Scroll to top of body
         }, 500);
      });
   };

   var initHeader = function () {
      var stickyHeader = $('#astroid-sticky-header');

      var _header = $('header');
      if (!_header.length) {
         return false;
      }

      var _headerTop = _header.offset().top;
      var _headerHeight = _header.height();
      var _headerBottom = _headerTop + _headerHeight;

      if (!stickyHeader.length) {
         return;
      }

      var _winScroll = $(window).scrollTop();

      var _breakpoint = deviceBreakpoint(true);

      if (_breakpoint == 'xl' || _breakpoint == 'lg') {
         if (stickyHeader.hasClass('header-sticky-desktop') && (_winScroll > _headerBottom)) {
            stickyHeader.removeClass('d-none');
            stickyHeader.addClass('d-flex');
         } else if (stickyHeader.hasClass('header-stickyonscroll-desktop') && (_winScroll > _headerBottom) && !isScrollDown()) {
            stickyHeader.removeClass('d-none');
            stickyHeader.addClass('d-flex');
         } else {
            stickyHeader.removeClass('d-flex');
            stickyHeader.addClass('d-none');
         }
      } else if (_breakpoint == 'sm' || _breakpoint == 'md') {
         if (stickyHeader.hasClass('header-static-tablet')) {
            return;
         }
         if (stickyHeader.hasClass('header-sticky-tablet') && (_winScroll > _headerBottom)) {
            stickyHeader.removeClass('d-none');
            stickyHeader.addClass('d-flex');
         } else if (stickyHeader.hasClass('header-stickyonscroll-tablet') && (_winScroll > _headerBottom) && !isScrollDown()) {
            stickyHeader.addClass('d-flex');
            stickyHeader.removeClass('d-none');
         } else {
            stickyHeader.addClass('d-none');
            stickyHeader.removeClass('d-flex');
         }
      } else {
         if (stickyHeader.hasClass('header-static-mobile')) {
            return;
         }
         if (stickyHeader.hasClass('header-sticky-mobile') && (_winScroll > _headerBottom)) {
            stickyHeader.addClass('d-flex');
            stickyHeader.removeClass('d-none');
         } else if (stickyHeader.hasClass('header-stickyonscroll-mobile') && (_winScroll > _headerBottom) && !isScrollDown()) {
            stickyHeader.addClass('d-flex');
            stickyHeader.removeClass('d-none');
         } else {
            stickyHeader.addClass('d-none');
            stickyHeader.removeClass('d-flex');
         }
      }
   };

   var initTooltip = function () {
      $('[data-toggle="tooltip"]').tooltip();
   };

   var initAnimations = function () {
      var bindAnimation = function () {
         $('[data-animation]').each(function () {
            var _animation = $(this).data('animation');
            if (_animation != '' && elementInViewport($(this)) && !$(this).hasClass('animation-done')) {
               var _this = this;
               $(_this).addClass('animated');
               $(_this).addClass(_animation);
               $(_this).addClass('animation-done');
               setTimeout(function () {
                  $(_this).removeClass('animated');
                  $(_this).removeClass(_animation);
               }, 1010);
            }
         });
      };

      $(window).on("scroll", function () {
         bindAnimation();
      });
      bindAnimation();
   };

   var elementInViewport = function (element) {
      var _this = element;
      var _this_top = _this.offset().top;
      return (_this_top <= window.pageYOffset + parseInt(window.innerHeight)) && (_this_top >= window.pageYOffset);
   };

   var deviceBreakpoint = function (_return) {
      if ($('.astroid-breakpoints').length == 0) {
         var _breakpoints = '<div class="astroid-breakpoints d-none"><div class="d-block d-sm-none device-xs"></div><div class="d-none d-sm-block d-md-none device-sm"></div><div class="d-none d-md-block d-lg-none device-md"></div><div class="d-none d-lg-block d-xl-none device-lg"></div><div class="d-none d-xl-block device-xl"></div></div>';
         $('body').append(_breakpoints);
      }
      var _sizes = ['xs', 'sm', 'md', 'lg', 'xl'];
      var _device = 'undefined';
      _sizes.forEach(function (_size) {
         var _visiblity = $('.astroid-breakpoints .device-' + _size).css('display');
         if (_visiblity == 'block') {
            _device = _size;
            return false;
         }
      });
      if (_return) {
         return _device;
      } else {
         $('body').removeClass('astroid-device-xs').removeClass('astroid-device-sm').removeClass('astroid-device-md').removeClass('astroid-device-lg').removeClass('astroid-device-xl');
         $('body').addClass('astroid-device-' + _device);
      }
   };

   var initPreloader = function () {
      $("#astroid-preloader").removeClass('d-flex').addClass('d-none');
   };

   // Events
   var docReady = function () {
      initDisplay();
      initMobileMenu();
      initMegamenu();
      initSubmenu();
      initBackToTop();
      initHeader();
      initTooltip();
      deviceBreakpoint(false);
   };

   var winLoad = function () {
      initAnimations();
      deviceBreakpoint(false);
      initPreloader();
   };

   var winResize = function () {
      deviceBreakpoint(false);
      initHeader();
   };

   var winScroll = function () {
      initHeader();
      initLastScrollTop();
      deviceBreakpoint(false);
   };

   $(docReady);
   $(window).on('load', winLoad);
   $(window).on('resize', winResize);
   $(window).on('scroll', winScroll);
   window.addEventListener("orientationchange", winResize);
})(jQuery);