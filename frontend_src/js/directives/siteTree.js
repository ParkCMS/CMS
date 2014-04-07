parkAdmin.directive("siteTree", ['$window', 'PagesService', function($window, PagesService) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/siteTree',
        replace: true,
        scope: {
            trees: '=model',
            onSelect: '&?'
        },
        link: function(scope, element, attributes) {
            scope.selected = 0;
            scope.expanded = [];

            scope.clickedPage = function(page, event) {
                scope.selected = page.id;

                scope.expanded[page.id] = true;

                if (typeof scope.onSelect !== 'undefined') {
                    scope.onSelect({page: page});
                }

                event.preventDefault();
            };

            scope.toggleSubtree = function(id) {
                scope.expanded[id] = !scope.expanded[id];
            }
        }
    };
}]);