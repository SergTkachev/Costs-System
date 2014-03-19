(function (ng, $) {
  var app = ng.module('app', []);

  var MainCtrl = function ($scope, $http) {
    $scope.addCost = function (cost) {
      cost = {
        type: cost.type || '',
        value: cost.value || '',
        description: cost.description || ''
      };
      $http.post('api/costs', cost).success(function (data) {
        $scope.costs.unshift(data);
        $scope.cost = null;
      }).error(function (e) {
        console.log(e);
      });
    };

    $scope.goPage = function (page) {
      $scope.goFilter({ page: page });
    }

    $scope.goFilter = function (filter) {
      filter = filter || {};
      $http.get('api/costs', { params: filter }).success(function (data) {
        ng.extend($scope, {
          costs: data.costs,
          pager: data.pager,
          page: data.page,
          pageSize: data.pageSize
        });
      }).error(function (e) {
        console.log(e);
      });
    }

    $scope.goFilter();
  };

  MainCtrl.$inject = ['$scope', '$http'];

  app.controller('MainCtrl', MainCtrl);

  app.directive('mainController', function () {
    return {
      restrict: 'C',
      controller: 'MainCtrl'
    };
  });

  /**
   * Filter for paging.
   */
  app.filter('startFrom', function () {
    return function (input, start) {
      start = typeof start === 'undefined' ? 0 : start;
      input = typeof input === 'undefined' ? [] : input;
      return input.slice(start);
    }
  });

  /*
   * Interaction design based on:
   * http://dribbble.com/shots/1254439--GIF-Mobile-Form-Interaction?list=users
   */
  $(document).ready(function () {
    // Test for placeholder support
    $.support.placeholder = (function () {
      var i = document.createElement('input');
      return 'placeholder' in i;
    })();

    // Hide labels by default if placeholders are supported
    if ($.support.placeholder) {
      $('.form li').each(function () {
        $(this).addClass('js-hide-label');
      });

      // Code for adding/removing classes here
      $('.form li').find('input, textarea').on('keyup blur focus', function (e) {

        // Cache our selectors
        var $this = $(this),
          $parent = $this.parent();

        if (e.type == 'keyup') {
          if ($this.val() == '') {
            $parent.addClass('js-hide-label');
          } else {
            $parent.removeClass('js-hide-label');
          }
        }
        else if (e.type == 'blur') {
          if ($this.val() == '') {
            $parent.addClass('js-hide-label');
          }
          else {
            $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
          }
        }
        else if (e.type == 'focus') {
          if ($this.val() !== '') {
            $parent.removeClass('js-unhighlight-label');
          }
        }
      });
    }
  });

})(angular, jQuery);