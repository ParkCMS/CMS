parkAdmin.directive("editor", ['EditorService', '$compile', function(EditorService, $compile) {
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
            });
            console.log(scope.data);
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