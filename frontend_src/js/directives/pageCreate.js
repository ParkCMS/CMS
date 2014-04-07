parkAdmin.directive("pageCreate", ['PagesService', function(PagesService) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pagecreate',
        scope: {
            page: '=',
            from: '=',
            position: '='
        },
        link: function(scope, element, attributes) {
            //scope.page = false;
        }
    };
}]);