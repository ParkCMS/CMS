parkAdmin.directive("pageManager", ['$window', 'PagesService', '$dialogs', function($window, PagesService, $dialogs) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pageManager',
        scope: {
            onNavigate: '&'
        },
        link: function(scope, element, attributes) {

            scope.select = function(page) {
                scope.page = page;
                scope.status.showCreatePage = false;
            };

            scope.navigate = function (page, event) {
                scope.onNavigate({page: page});
            };

            scope.createPage = function (page, position) {
                scope.status.showCreatePage = true;
                scope.create.page = page;
                scope.create.position = position;
            };

            scope.deletePage = function (page) {
                var dlg = $dialogs.confirm(attributes.deletePageTitle, attributes.deletePageDescription);
                dlg.result.then(function() {
                    PagesService.deletePage(page).success(function() {
                        scope.reload();
                    });
                });
            }

            scope.updatePage = function (page) {
                PagesService.updatePage(page);
            }

            scope.reload = function() {
                scope.page = false;

                scope.create = {};

                scope.status = {};

                scope.status.showCreatePage = false;
                
                PagesService.getPageTree().success(function(data) {
                    scope.trees = data;
                });
            };

            scope.reload();
        }
    };
}]);