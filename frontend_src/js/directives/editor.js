parkAdmin.directive("editor", ['EditorService', '$dialogs', '$compile', function(EditorService, $dialogs, $compile) {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        transclude: true,
        template: '<div ng-transclude></div>',
        link: function(scope, element, attributes) {

            EditorService.loadAction(
                scope.data.type,
                scope.data.identifier,
                scope.data.route,
                scope.data.lang,
                'index'
            ).success(function(data) {
                var compiled = $compile(data);
                
                element.append( compiled(scope) );
            }).error(function(data) {
                $dialogs.error(data.error.title, data.error.message);
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
}]).directive('editorAction', ['EditorService', function(EditorService) {
    return {
        restrict: 'A',
        scope: false,
        link: function(scope, element, attr) {
            element.on('submit', function(event) {
              scope.$apply(function() {
                var action = attr.editorAction;
                var method = attr.method;

                console.log(scope);
                event.preventDefault();
              });
            });
        }
    }
}]);