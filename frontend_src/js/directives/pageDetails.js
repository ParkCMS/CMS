parkAdmin.directive("pageDetails", ['$window', 'PagesService', function($window, PagesService) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pagedetails',
        scope: {
            page: '=',
            hideDetails: '=',
            onNavigate: '&',
            onCreate: '&',
            onDelete: '&'
        },
        link: function(scope, element, attributes) {

            scope.navigateBrowserTo = function (page, event) {
                scope.onNavigate({page: page.lang + '/' + page.alias});

                event.preventDefault();
            };

            scope.showCreate = function (page, type, event) {
                scope.onCreate({page: page, position: type});
                event.preventDefault();
            };

            scope.deletePage = function (page) {
                scope.onDelete({page: page});

                event.preventDefault();
            };
        }
    };
}]);