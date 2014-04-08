parkAdmin.directive("pageCreate", ['PagesService', '$dialogs', function(PagesService) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pagecreate',
        scope: {
            page: '=',
            from: '=',
            position: '=',
            visible: '=',
            onSuccess: '&'
        },
        link: function(scope, element, attributes) {
            scope.new = {};
            scope.$watch(function() {
                return scope.from;
            }, function() {
                if (scope.position === 'child' && scope.from.unpublished > 0) {
                    scope.new.unpublished = 1;
                } else if (scope.position != 'child' && typeof scope.from !== 'undefined') {
                    scope.new.unpublished = scope.from.unpublished;
                } else {
                    scope.new.unpublished = 2;
                }
            });

            scope.createPage = function() {
                PagesService.createPage(scope.new, scope.position, scope.from.id).success(function(data) {
                    scope.onSuccess(data);
                }).error(function(data) {

                });
            };

            scope.cancelCreate = function(event) {
                var unpublished = scope.new.unpublished;
                scope.new = {};
                scope.new.unpublished = unpublished;
                scope.visible = false;

                event.preventDefault();
            }
        }
    };
}]);