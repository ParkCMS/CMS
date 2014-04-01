parkAdmin.directive("browserBreadcrumb", ['FileBrowser', function(browser) {
    return {
        restrict: "A",
        templateUrl: 'admin/partials/browserBreadcrumb',
        link: function(scope, element, attrs) {
            scope.cwd = [];
            scope.up = function (event, level) {
                var tmp = [];
                for (var i = 0; i <= level; i++) {
                    tmp.push(scope.cwd[i]);
                }
                scope.cd('/' + tmp.join('/'));

                event.preventDefault();
            }

            scope.buildToIndex = function (index) {
                var tmp = [];

                for (var i = 0; i <= index; i++) {
                    tmp.push(scope.cwd[i]);
                }

                return '/' + tmp.join('/');
            }

            scope.$watch(function() {
                return browser.cwd(true);
            }, function(newVal) {
                var copy = newVal.slice()
                copy.splice(0,1);
                scope.cwd = copy;
            });
        }
    };
}]);