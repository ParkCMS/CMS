parkAdmin.directive("pageCreate", ['PagesService', '$dialogs', 'BASE_URL', function(PagesService, $dialogs, BASE_URL) {
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
            };

            scope.preview = function(template, event) {
                if (typeof template !== 'undefined') {
                    $dialogs.create(BASE_URL + '/admin/partials/preview','previewController',{'template': template.id},{key: false});
                }
                event.preventDefault();
            };
        }
    };
}]).controller('previewController', ['$scope', '$modalInstance', 'data', 'BASE_URL', function($scope,$modalInstance,data, BASE_URL) {
    console.log($modalInstance);

    $scope.getIframeSrc = function() {
        return BASE_URL + '/admin/preview/template/' + data.template;
    };

    $scope.ok = function() {
        $modalInstance.dismiss('Closed');
    };
}]);