(function ($) {
   $.fn.JDDrop = function () {
      this.each(function () {
         var _this = $(this);
         var _action = _this.data('drop-action');
         _this.parent().css('position', 'relative');
         _this.css('position', 'relative');
         var _content = _this.data('jddrop');
         if (typeof _content == 'undefined' || _content == '' || typeof $('#' + _content) == 'undefined') {

            _content = _this.siblings('.jddrop-content');
            if (typeof _content == 'undefined' || _content == '' || _content.length < 1) {
               return;
            }
         }
         var content = $(_content);
         var _boundry = content.closest('.astroid-header')[0];
         if (content.closest('.astroid-header').hasClass('astroid-header-sticky')) {
            _boundry = content.closest('.astroid-header').children('.container')[0];
         }
         var _width = content.data('width');
         if (typeof _width != 'undefined' && _width != '') {
            if (_width == 'container') {
               content.addClass('width-container');
               _width = content.closest('.astroid-header').width();
               if (content.closest('.astroid-header').hasClass('astroid-header-sticky')) {
                  _width = content.closest('.astroid-header').children('.container').width();
                  if (_width == 100) {
                     _width = content.closest('.astroid-header').removeClass('d-none').addClass('d-flex').children('.container').width();
                     content.closest('.astroid-header').addClass('d-none').removeClass('d-flex');
                  }
               }
            }
            if (_width == '100vw') {
               content.addClass('width-window');
               _boundry = 'window';
            }
            content.css('width', _width);
            content.find('.jddrop-content').css('width', _width);
         }

         if (content.parent().closest('.jddrop-content').length) {
            _boundry = content.parent().closest('.jddrop-content')[0];
            if (!_boundry.hasClass('width-window') && !_boundry.hasClass('width-container')) {
               _boundry = content.closest('.astroid-header')[0];
               if (content.closest('.astroid-header').hasClass('astroid-header-sticky')) {
                  _boundry = content.closest('.astroid-header').children('.container')[0];
               }
            }
         }

         var _offset = _this.data('jddrop-offset');
         if (typeof _offset == 'undefined' || _offset == '') {
            _offset = 0;
         }

         var _align = _this.data('jddrop-align');
         if (typeof _align == 'undefined' || _align == '') {
            _align = 'center';
         }
         switch (_align) {
            case 'left':
               _align = '-end';
               break;
            case 'right':
               _align = '-start';
               break;
            case 'full':
            case 'center':
               _align = '';
               break;
         }

         var _position = _this.data('jddrop-position');
         if (typeof _position == 'undefined' || _position == '') {
            _position = 'bottom';
         }

         var _speed = _this.data('jddrop-speed');
         if (typeof _speed == 'undefined' || _speed == '') {
            _speed = 500;
         } else {
            _speed = parseInt(_speed);
         }

         var _effect = _this.data('jddrop-effect');
         if (typeof _effect == 'undefined' || _effect == '') {
            _effect = 'slide';
         }

         var _easing = _this.data('jddrop-ease');
         if (typeof _easing == 'undefined' || _easing == '') {
            _easing = 'linear';
         }

         var drop = _this;

         var popper = new Popper(drop, content, {
            placement: _position + _align,
            modifiers: {
               offset: {
                  enabled: true,
                  offset: '0,' + _offset
               },
               preventOverflow: {
                  priority: ['left', 'right'],
                  boundariesElement: _boundry,
                  padding: 0
               },
               flip: {
                  padding: 0
               }
            },
         });


         if (_action == 'click') {
            drop.click(function () {
               var open = $(this).data('click-open');
               if (open == '1') {
                  $(this).data('click-open', 0);
                  switch (_effect) {
                     case 'slide':
                        content.stop(true, true).slideUp({
                           duration: _speed,
                           easing: _easing,
                           complete: function () {
                              popper.update();
                           },
                           start: function () {
                              popper.update();
                           }
                        });
                        break;
                     case 'fade':
                        content.stop(true, true).fadeOut({
                           duration: _speed,
                           easing: _easing,
                           complete: function () {
                              popper.update();
                           },
                           start: function () {
                              popper.update();
                           }
                        });
                        break;
                     default:
                        content.stop(true, true).hide();
                        popper.update();
                        break;
                  }
               } else {
                  $(this).data('click-open', 1);
                  popper.update();
                  switch (_effect) {
                     case 'slide':
                        content.stop(true, true).slideDown({
                           duration: _speed,
                           easing: _easing,
                           complete: function () {
                              popper.update();
                           },
                           start: function () {
                              popper.update();
                           }
                        });
                        break;
                     case 'fade':
                        content.stop(true, true).fadeIn({
                           duration: _speed,
                           easing: _easing,
                           complete: function () {
                              popper.update();
                           },
                           start: function () {
                              popper.update();
                           }
                        });
                        break;
                     default:
                        content.stop(true, true).show();
                        popper.update();
                        break;

                  }
               }
            });
         } else {
            drop.hover(function () {
               popper.update();
               switch (_effect) {
                  case 'slide':
                     content.stop(true, true).slideDown({
                        duration: _speed,
                        easing: _easing,
                        complete: function () {
                           popper.update();
                        },
                        start: function () {
                           popper.update();
                        }
                     });
                     break;
                  case 'fade':
                     content.stop(true, true).fadeIn({
                        duration: _speed,
                        easing: _easing,
                        complete: function () {
                           popper.update();
                        },
                        start: function () {
                           popper.update();
                        }
                     });
                     break;
                  default:
                     content.stop(true, true).show();
                     popper.update();
                     break;

               }
            }, function () {
               setTimeout(function () {
                  if (!content.is(':hover')) {
                     switch (_effect) {
                        case 'slide':
                           content.stop(true, true).slideUp({
                              duration: _speed,
                              easing: _easing,
                              complete: function () {
                                 popper.update();
                              },
                              start: function () {
                                 popper.update();
                              }
                           });
                           break;
                        case 'fade':
                           content.stop(true, true).fadeOut({
                              duration: _speed,
                              easing: _easing,
                              complete: function () {
                                 popper.update();
                              },
                              start: function () {
                                 popper.update();
                              }
                           });
                           break;
                        default:
                           content.stop(true, true).hide();
                           popper.update();
                           break;
                     }
                  }
               }, 250);
            });

            content.hover(function () {}, function () {
               setTimeout(function () {
                  if (!drop.is(':hover')) {
                     switch (_effect) {
                        case 'slide':
                           content.stop(true, true).slideUp({
                              duration: _speed,
                              easing: _easing,
                              complete: function () {
                                 popper.update();
                              },
                              start: function () {
                                 popper.update();
                              }
                           });
                           break;
                        case 'fade':
                           content.stop(true, true).fadeOut({
                              duration: _speed,
                              easing: _easing,
                              complete: function () {
                                 popper.update();
                              },
                              start: function () {
                                 popper.update();
                              }
                           });
                           break;
                        default:
                           content.stop(true, true).hide();
                           popper.update();
                           break;
                     }
                  }
               }, 250);
            });
         }
      });
   }
}(jQuery));