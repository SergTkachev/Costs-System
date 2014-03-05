(function(ng, $) {
    var app = ng.module('app', []);

    var MainCtrl = function($scope, $http) {
        $http.get('api/costs').success(function(data) {
            $scope.costs = data.costs;
            $scope.pager = data.pager; // Array.apply(null, Array(data.pager)).map(function (_, i) { return i + 1; });
            $scope.page = 1;
            $scope.pageSize = data.pageSize;
            $scope.pages = [1];
        });

        $scope.addCost = function(cost) {
            cost = {
                type: cost.type || '',
                value: cost.value || '',
                description: cost.description || ''
            };
            $http.post('api/costs', cost).success(function(data) {
                $scope.costs.unshift(data);
                $scope.cost = null;
            }).error(function(e) {
                console.log(e);
            });
        };

        $scope.goPage = function(page) {
            $scope.page = page;
            if ($scope.pages.indexOf(page) < 0) {
                $http.get('api/costs?page=' + page).success(function(data) {
                    $scope.costs = $scope.costs.concat(data.costs);
                    $scope.pages.push(page);
                });
            }
        }
    };

    MainCtrl.$inject = ['$scope', '$http'];

    app.controller('MainCtrl', MainCtrl);

    app.directive('mainController', function() {
        return {
            restrict: 'C',
            controller: 'MainCtrl'
        };
    });

    /**
     * Filter for paging.
     */
    app.filter('startFrom', function() {
        return function(input, start) {
            start = typeof start === 'undefined' ? 0 : start;
            input = typeof input === 'undefined' ? [] : input;
            return input.slice(start);
        }
    });

    /*
     * Interaction design based on:
     * http://dribbble.com/shots/1254439--GIF-Mobile-Form-Interaction?list=users
     */
    $(document).ready(function(){
        // Test for placeholder support
        $.support.placeholder = (function(){
            var i = document.createElement('input');
            return 'placeholder' in i;
        })();

        // Hide labels by default if placeholders are supported
        if($.support.placeholder) {
            $('.form li').each(function(){
                $(this).addClass('js-hide-label');
            });

            // Code for adding/removing classes here
            $('.form li').find('input, textarea').on('keyup blur focus', function(e){

                // Cache our selectors
                var $this = $(this),
                    $parent = $this.parent();

                if (e.type == 'keyup') {
                    if( $this.val() == '' ) {
                        $parent.addClass('js-hide-label');
                    } else {
                        $parent.removeClass('js-hide-label');
                    }
                }
                else if (e.type == 'blur') {
                    if( $this.val() == '' ) {
                        $parent.addClass('js-hide-label');
                    }
                    else {
                        $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                    }
                }
                else if (e.type == 'focus') {
                    if( $this.val() !== '' ) {
                        $parent.removeClass('js-unhighlight-label');
                    }
                }
            });
        }
    });

})(angular, jQuery);