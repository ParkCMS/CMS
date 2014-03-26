parkAdmin.directive("browserSidebar", ['FileBrowser', function(browser) {
    return {
        restrict: "A",
        templateUrl: 'admin/partials/browserSidebar',
        link: function(scope, element, attrs) {
            scope.file = [];
            scope.$on('file-clicked', function(ev, file) {
                scope.file = file;
            });
        }
    };
}]);