parkAdmin.directive("pageDetails", ['PagesService', '$dialogs', 'BASE_URL', function(PagesService, $dialogs, BASE_URL) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pagedetails',
        scope: {
            page: '=',
            hideDetails: '=',
            onNavigate: '&',
            onCreate: '&',
            onDelete: '&',
            onUpdate: '&'
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

            scope.preview = function(template, event) {
                if (typeof template !== 'undefined') {
                    $dialogs.create(BASE_URL + '/admin/partials/preview','previewController',{'template': template},{key: false});
                }
                event.preventDefault();
            };

            scope.updatePage = function() {
                scope.onUpdate({page: scope.page});
            }
        }
    };
}]);