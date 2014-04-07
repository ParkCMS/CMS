parkAdmin.directive("pageDetails", ['$window', 'PagesService', function($window, PagesService) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pagedetails',
        scope: {
            page: '=',
            onNavigate: '&',
            onCreate: '&'
        },
        link: function(scope, element, attributes) {
            //scope.page = false;

            scope.navigateBrowserTo = function (page, event) {
                scope.onNavigate({page: page.lang + '/' + page.alias});

                event.preventDefault();
            };

            scope.showCreate = function (page, type, event) {
                scope.onCreate({page: page, position: type});
                event.preventDefault();
            }
        }
    };
}]);