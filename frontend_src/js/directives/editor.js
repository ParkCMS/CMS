parkAdmin.directive("editor", ['EditorService', '$dialogs', '$compile', function(EditorService, $dialogs, $compile) {
    return {
        restrict: 'E',
        //templateUrl: 'admin/partials/editor',
        scope: {
            data: '='
        },
        transclude: true,
        template: '<div ng-transclude></div>',
        link: function(scope, element, attributes) {
            scope.doLog = function(msg) {
                console.log(msg);
            }

            EditorService.loadAction(
                scope.data.type,
                scope.data.identifier,
                scope.data.page,
                'index'
            ).success(function(data) {
                var compiled = $compile(data);
                
                element.append( compiled(scope) );
            }).error(function(data) {
                $dialogs.error(data.title, data.message);
                scope.$emit('close-editor', scope.data.unique);
            });
        },
        controller: ['$scope', function($scope) {
            this.data = $scope.data;
        }]
    };
}]).directive('loadAction', [function() {
    return {
        restrict: 'A',
        require: '^editor',
        link: function (scope, element, attributes, editorCtrl) {
            element.attr('href', 'piep');
        }
    }
}]);