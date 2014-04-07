parkAdmin.directive("pageManager", ['$window', 'PagesService', function($window, PagesService) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pageManager',
        scope: {
            onNavigate: '&'
        },
        link: function(scope, element, attributes) {
            scope.page = false;

            scope.create = {};

            scope.status = {};

            scope.status.showCreatePage = false;

            scope.showCreatePage = false;

            scope.select = function(page) {
                scope.page = page;
            };

            scope.navigate = function (page, event) {
                scope.onNavigate({page: page});
            };

            scope.createPage = function (page, position) {
                scope.status.showCreatePage = true;
                scope.create.page = page;
                scope.create.position = position;
            }

            PagesService.getPageTree().success(function(data) {
                scope.trees = data;
            });
        }
    };
}]);