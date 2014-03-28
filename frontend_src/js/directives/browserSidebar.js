parkAdmin.directive("browserSidebar", ['FileBrowser', '$rootScope', '$dialogs', function(browser, $root, $dialogs) {
    return {
        restrict: "A",
        templateUrl: 'admin/partials/browserSidebar',
        link: function(scope, element, attrs) {
            scope.file = [];
            scope.deleteFile = function($event, path) {
                var dlg = $dialogs.confirm("Are you sure?","Do you really want to delete " + path + "?");
                dlg.result.then(function() {
                    browser.deleteFile(path).success(function () {
                        scope.$emit('browser-needs-refresh');
                    });
                });

                $event.preventDefault();
            }

            scope.deleteFolder = function($event, path) {
                var dlg = $dialogs.confirm("Are you sure?","Do you really want to delete " + path + " and all it's contents?");
                dlg.result.then(function() {
                    browser.deleteFolder(path).success(function() {
                        scope.$emit('directory-deleted', path);
                    })
                })
            }

            scope.$on('file-clicked', function(ev, file) {
                scope.file = file;
            });
        }
    };
}]);