parkAdmin.directive("pageCreate", ['PagesService', function(PagesService) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pagecreate',
        scope: {
            page: '=',
            from: '=',
            position: '=',
            visible: '=?'
        },
        link: function(scope, element, attributes) {
            console.log('loaded');
        }
    };
}]);