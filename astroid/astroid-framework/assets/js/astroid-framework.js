var astroidFramework = angular.module('astroid-framework', ['ng-sortable', 'ngAnimate']);

// Directives

// Tooltip
astroidFramework.directive('tooltip', function () {
   return {
      restrict: 'A',
      link: function (scope, element, attrs) {
         $(element).hover(function () {
            $(element).tooltip('show');
         }, function () {
            $(element).tooltip('hide');
         });
      }
   };
});

astroidFramework.directive('astroidmediagallery', ['$http', function ($http) {
      return {
         restrict: 'A',
         scope: true,
         require: 'ngModel',
         link: function ($scope, $element, $attrs, ngModel) {
            $scope.gallery = {};
            $scope.back = '';
            $scope.folder = '';
            $scope.MEDIA_URL = SITE_URL + 'images/';
            $scope.iconsize = 130;
            $scope.getImageUrl = function () {
               if (ngModel.$modelValue == '' || typeof ngModel.$modelValue == 'undefined') {
                  $scope.clearImage();
                  return '';
               }
               return $scope.MEDIA_URL + ngModel.$modelValue;
            };
            $scope.getFileName = function () {
               if (ngModel.$modelValue == '' || typeof ngModel.$modelValue == 'undefined') {
                  $scope.clearImage();
                  return '';
               }
               return ngModel.$modelValue;
            };
            $scope.getImgUrl = function (_url) {
               return $scope.MEDIA_URL + _url;
            };
            $scope.clearImage = function (_id) {
               ngModel.$setViewValue('');
               //ngModel.$render();
               //$scope.$apply();
               try {
                  Admin.refreshScroll();
               } catch (e) {
               }
               ;
            };
            $scope.selectImage = function (_id, _value) {
               ngModel.$setViewValue(_value);
               //ngModel.$render();
               $scope.selectMedia = false;
               //$scope.$apply();
               try {
                  Admin.refreshScroll();
               } catch (e) {
               }
               ;
            };
            $scope.getLibrary = function (folder, tab) {
               $('a#' + tab).tab('show');
               $scope.loading = true;
               $scope.folder = folder;
               $scope.bradcrumb = [];
               $.ajax({
                  'method': 'GET',
                  'url': BASE_URL + 'index.php?option=com_ajax&astroid=media&action=library&folder=' + folder + '&asset=com_templates&author=',
                  success: function (response) {
                     if (response.status == 'error') {
                        $.notify(response.message, {
                           className: 'error',
                           globalPosition: 'bottom right',
                        });
                        $scope.selectMedia = false;
                        $scope.$apply();
                        return false;
                     }
                     $scope.gallery = response.data;
                     $scope.loading = false;

                     var folders = folder.split('/');
                     var bradcrumb = [];
                     var _url = [];

                     var _obj = {
                        'name': 'Library',
                        'url': ''
                     };
                     bradcrumb.push(_obj);

                     folders.forEach(function (_u, _i) {
                        _url.push(_u);
                        var _path = _url.join('/');
                        var _obj = {
                           'name': _path == '' ? 'Library' : _u,
                           'url': _path
                        };
                        bradcrumb.push(_obj);
                     });
                     $scope.bradcrumb = bradcrumb;
                     $scope.$apply();
                  }
               });
            };

            $scope.newFolder = function (_id) {
               var name = prompt(TPL_ASTROID_NEW_FOLDER_NAME_LBL, "");
               if (name === "") {
                  return false;
               } else if (name) {

                  var re = /^[a-zA-Z].*/;
                  if (!re.test(name) || (/\s/.test(name))) {
                     Admin.notify(TPL_ASTROID_NEW_FOLDER_NAME_INVALID, "error");
                     return false;
                  }


                  $scope.loading = true;
                  $.ajax({
                     'method': 'GET',
                     'url': BASE_URL + 'index.php?option=com_ajax&astroid=media&action=create-folder&dir=' + $scope.gallery.current_folder + '&name=' + name,
                     success: function (response) {
                        if (response.status == 'error') {
                           $.notify(response.message, {
                              className: 'error',
                              globalPosition: 'bottom right',
                           });
                        } else {
                           $.notify(response.data.message, {
                              className: 'success',
                              globalPosition: 'bottom right',
                           });
                           $scope.getLibrary(response.data.folder, _id);
                        }
                        $scope.loading = false;
                        $scope.$apply();
                     }
                  });
               } else {
                  return false;
               }
            }
         },

      };
   }]);


astroidFramework.directive('astroidsocialprofiles', ['$http', function ($http) {
      return {
         restrict: 'A',
         scope: true,
         link: function ($scope, $element, $attrs) {
            $scope.getId = function (_title) {
               return _title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            };

            AstroidSocialProfiles.forEach(function (_sp) {
               _sp.id = $scope.getId(_sp.title);
            });

            $scope.astroidsocialprofiles = AstroidSocialProfiles;
            $scope.profiles = AstroidSocialProfilesSelected;
            $scope.addProfile = function () {
               var _profiles = $scope.astroidsocialprofiles;
               _profiles.push({'title': '', 'icon': '', 'link': '', 'id': $scope.getId()});
               $scope.astroidsocialprofiles = _profiles;
            }

            $scope.selectSocialProfile = function (_profile) {
               var _profiles = $scope.profiles;
               _profiles.push(angular.copy(_profile));
               $scope.profiles = _profiles;
            };

            $scope.removeSocialProfile = function (_index) {
               var _c = confirm("Are you sure?");
               if (_c) {
                  var _profiles = $scope.profiles;
                  _profiles.splice(_index, 1);
                  $scope.profiles = _profiles;
               }
            };

            $scope.refreshScroll = function (_this, profile) {
               profile.enabled = $('#' + _this).is(':checked');
               try {
                  $scope.setProfiles();
                  Admin.refreshScroll();
               } catch (e) {
               }
               ;
            };

            $scope.setProfiles = function () {
               var _profiles = [];
               $scope.astroidsocialprofiles.forEach(function (_profile) {
                  if (_profile.enabled) {
                     _profiles.push(_profile);
                  }
               });
               $scope.profiles = _profiles;
            };

            $scope.addCustomProfile = function () {
               var _profile = {
                  color: '#495057',
                  enabled: false,
                  icon: '',
                  icons: [],
                  id: "custom",
                  link: "#",
                  title: "Custom social profile"
               };
               var _profiles = $scope.profiles;
               _profiles.push(angular.copy(_profile));
               $scope.profiles = _profiles;
            };
         }
      };
   }
]);

astroidFramework.directive('dropzone', function () {
   return {
      restrict: 'A',
      link: function (scope, element, attrs) {
         var _id = $(element).data('dropzone-id');
         var _dir = $(element).data('dropzone-dir');
         var _media = $(element).data('media');
         $(element).dropzone({
            url: "index.php?option=com_ajax&astroid=media&action=upload&media=" + _media,
            clickable: true,
            success: function (file, response) {
               if (response.status == 'success') {
                  scope.getLibrary(response.data.folder, 'astroid-media-tab-library-' + _id);
               } else {
                  Admin.notify(response.message, 'error');
               }
               try {
                  Admin.refreshScroll();
               } catch (e) {
               }
               ;
            },
            complete: function (file) {
               this.removeAllFiles(true);
               try {
                  Admin.refreshScroll();
               } catch (e) {
               }
               ;
            },
            sending: function (file, xhr, formData) {
               if (_dir) {
                  formData.append('dir', $('#dropzone_folder_' + _id).val());
               } else {
                  formData.append('dir', '');
               }
            }
         });
      }
   }
});


astroidFramework.directive('rangeSlider', function () {
   return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {

         setTimeout(function () {
            ngModel.$setViewValue(parseFloat($(element).data('slider-value')));
            scope.$apply();
         }, 50);


         setTimeout(function () {
            $(element).slider(rangeConfig);
            //$(element).slider('setValue', parseFloat($(element).data('slider-value')));
         }, 100);


         setTimeout(function () {
            var _prefix = $(element).data('prefix');
            var _postfix = $(element).data('postfix');
            $(element).on('slide', function (e) {
               $(element).siblings('.range-slider-value').text(_prefix + e.value + _postfix);
            });
            $(element).siblings('.range-slider-value').text(_prefix + $(element).val() + _postfix);

            var setRange = function () {
               $(element).slider('setValue', ngModel.$modelValue);
            }

            scope.$watch(attrs['ngModel'], setRange);
         }, 200);

      },
   };
});

astroidFramework.directive('colorPicker', function ($parse) {
   return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {
         if (typeof $ == 'undefined') {
            var $ = jQuery;
         }
         if ($(element).hasClass('color-picker-lg')) {
            var spectrumConfigExtend = angular.copy(spectrumConfig);
            spectrumConfigExtend.replacerClassName = 'color-picker-lg';
            $(element).spectrum(spectrumConfigExtend);
         } else {
            $(element).spectrum(spectrumConfig);
         }

         $(element).on('move.spectrum', function (e, tinycolor) {
            $(element).spectrum("set", tinycolor.toRgbString());
         });

         var setColor = function () {
            $(element).spectrum("set", ngModel.$modelValue);
         };
         setTimeout(function () {
            var _value = $(element).val();
            $(element).spectrum("set", _value);
            scope.$watch(attrs['ngModel'], setColor);
         }, 200);
      },
   };
});

astroidFramework.directive('animationSelector', function () {
   return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {
         setTimeout(function () {
            $(element).addClass('astroid-animation-selector');
            $(element).astroidAnimationSelector();
         }, 100);
      },
   };
});

astroidFramework.directive('selectUi', function () {
   return {
      restrict: 'A',
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {
         if (typeof $ == 'undefined') {
            var $ = jQuery;
         }
         setTimeout(function () {
            var _placeholder = $(element).data('placeholder');
            _placeholder = typeof _placeholder == 'undefined' ? false : _placeholder;
            $(element).addClass('astroid-select-ui search selection').dropdown({placeholder: _placeholder, fullTextSearch: true});
         }, 200);
      },
   };
});

astroidFramework.directive('selectUiDiv', function () {
   return {
      restrict: 'A',
      link: function (scope, element, attrs, ngModel) {
         if (typeof $ == 'undefined') {
            var $ = jQuery;
         }
         setTimeout(function () {
            $(element).dropdown({placeholder: false, fullTextSearch: true});
         }, 200);
      },
   };
});

astroidFramework.directive('astroidSwitch', function () {
   return {
      restrict: 'A',
      transclude: true,
      replace: false,
      require: 'ngModel',
      link: function ($scope, $element, $attr, require) {

         if (typeof $ == 'undefined') {
            var $ = jQuery;
         }

         var ngModel = require;
         // update model from Element
         var updateModelFromElement = function (checked) {
            if (checked && ngModel.$viewValue != 1) {
               ngModel.$setViewValue(1);
               $scope.$apply();
            } else if (!checked && ngModel.$viewValue != 0) {
               ngModel.$setViewValue(0);
               $scope.$apply();
            } else if (ngModel.$viewValue != 0 && ngModel.$viewValue != 1) {
               ngModel.$setViewValue(0);
            }
            try {
               Admin.refreshScroll();
            } catch (e) {
            }
            ;
         };
         // Update input from Model
         var updateElementFromModel = function () {
            if (ngModel.$viewValue == 1) {
               $element.siblings('.custom-toggle').children('.custom-control-input').prop('checked', true);
               $element.val(1);
            } else {
               $element.siblings('.custom-toggle').children('.custom-control-input').prop('checked', false);
               $element.val(0);
            }
         };

         // Update input from Model
         var initElementFromModel = function () {
            if ($element.val() == 1) {
               $element.siblings('.custom-toggle').children('.custom-control-input').prop('checked', true);
               ngModel.$setViewValue(1);
            } else {
               $element.siblings('.custom-toggle').children('.custom-control-input').prop('checked', false);
               ngModel.$setViewValue(0);
            }
         };

         // Observe: ngModel for changes
         $scope.$watch($attr['ngModel'], updateElementFromModel);



         // Initialise BootstrapToggle

         var _id = $element.attr('id');
         $element.attr('id', '');
         $element.wrap('<div/>');
         var _container = $element.parent('div');

         $(_container).append('<div class="custom-control custom-toggle"><input type="checkbox" id="' + _id + '" class="custom-control-input" /><label class="custom-control-label" for="' + _id + '"></label></div>');

         $(_container).find('.custom-control-input').bind('change', function (e) {
            var _checked = $(this).is(':checked');
            updateModelFromElement(_checked);
         });
         setTimeout(function () {
            initElementFromModel();
         }, 250);
      },
   };
});


astroidFramework.directive('draggable', function () {
   return {
      restrict: 'A',
      link: function (scope, element, attrs) {
         if (typeof $ == 'undefined') {
            var $ = jQuery;
         }
         $(element).draggable({revert: "invalid", helper: "clone", cursor: "move"});
      }
   };
});

astroidFramework.directive('droppable', function () {
   return {
      restrict: 'A',
      link: function (scope, element, attrs) {
         if (typeof $ == 'undefined') {
            var $ = jQuery;
         }
         $(element).droppable({
            classes: {
               "ui-droppable-active": "has-module",
               "ui-droppable-hover": "hovered"
            },
            drop: function (event, ui) {
               var _id = $(ui.draggable).data('module-id');
               var _title = $(ui.draggable).data('module-title');
               var _name = $(ui.draggable).data('module-name');
               var _colIndex = $(this).data('col');
               var _rowIndex = $(this).data('row');
               scope.rows[_rowIndex].cols[_colIndex].module.id = _id;
               scope.rows[_rowIndex].cols[_colIndex].module.title = _title;
               scope.rows[_rowIndex].cols[_colIndex].module.name = _name;
               scope.$apply();
            }
         });
      }
   };
});

astroidFramework.directive('popover', function () {
   return {
      restrict: 'A',
      link: function (scope, element, attrs) {
         if (typeof $ == 'undefined') {
            var $ = jQuery;
         }
         setTimeout(function () {
            $(element).popover();
         }, 100);
      }
   };
});


astroidFramework.directive('convertToNumber', function () {
   return {
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {
         ngModel.$parsers.push(function (val) {
            return val != null ? parseInt(val, 10) : null;
         });
         ngModel.$formatters.push(function (val) {
            return val != null ? '' + val : null;
         });
      }
   };
});

astroidFramework.directive('convertToString', function () {
   return {
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {
         ngModel.$parsers.push(function (val) {
            return val != null ? val + '' : null;
         });
         ngModel.$formatters.push(function (val) {
            return val != null ? '' + val : null;
         });
      }
   };
});

astroidFramework.directive('astroidresponsive', ['$http', function ($http) {
      return {
         restrict: 'A',
         scope: true,
         require: 'ngModel',
         link: function ($scope, $element, $attrs, ngModel) {
            if (typeof $ == 'undefined') {
               var $ = jQuery;
            }
            $($element).parent('.astroidresponsive').append($('#column-responsive-field-template').html());

            var bindFields = function () {
               $($element).parent('.astroidresponsive').find('.responsive-field').bind('change', function () {
                  var _params = [];
                  $('.responsive-field').each(function () {
                     var _param = {};
                     _param.name = $(this).data('name');
                     if ($(this).hasClass('jd-switch')) {
                        _param.value = $(this).is(':checked') ? 1 : 0;
                     } else {
                        _param.value = $(this).val();
                     }
                     _params.push(_param);
                  });
                  var _params = JSON.stringify(_params);
                  ngModel.$setViewValue(_params);
                  $($element).val(_params);
                  $scope.$apply();
               });
            };

            var _initValue = false;
            var setValue = function () {
               if (!_initValue) {
                  _initValue = true;
                  if (typeof ngModel.$modelValue != 'undefined') {
                     try {
                        var _params = JSON.parse(ngModel.$modelValue);
                     } catch (e) {
                        var _params = [];
                     }
                  } else {
                     var _params = [];
                  }
                  _params.forEach(function (_param) {
                     var _field = $($element).parent('.astroidresponsive').find('.responsive-field[data-name="' + _param.name + '"]');
                     if (_field.hasClass('jd-switch')) {
                        if (_param.value) {
                           _field.prop('checked', true);
                        } else {
                           _field.prop('checked', false);
                        }
                     } else {
                        _field.val(_param.value);
                     }
                  });
                  setTimeout(function () {
                     bindFields();
                  }, 50);
               }
            };
            setTimeout(function () {
               setValue()
            }, 100);
         }
      };
   }]);