parkAdmin.directive("browserBreadcrumb", ['FileBrowser', function(browser) {
    return {
        restrict: "A",
        templateUrl: 'admin/partials/browserBreadcrumb',
        link: function(scope, element, attrs) {
            scope.cwd = [];
            scope.$watch(function() {
                return browser.cwd(true);
            }, function(newVal) {
                newVal.splice(0,1);
                scope.cwd = newVal;
            });
        }
    };
}]);