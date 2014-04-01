parkAdmin.directive("editor", ['$window', function($window) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/editor',
        scope: {
            data: '='
        },
        link: function(scope, element, attributes) {
            console.log(scope.data);
        }
    };
}]);