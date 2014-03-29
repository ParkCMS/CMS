parkAdmin.directive("browserSidebar", ['FileBrowser', '$rootScope', '$dialogs', function(browser, $root, $dialogs) {
    return {
        restrict: "A",
        templateUrl: 'admin/partials/browserSidebar',
        link: function(scope, element, attrs) {
            scope.file = [];
            scope.deleteFile = function($event, path) {
                var dlg = $dialogs.confirm(attrs.deleteModalTitle, _format(attrs.deleteFileText, path));
                dlg.result.then(function() {
                    browser.deleteFile(path).success(function () {
                        scope.$emit('browser-needs-refresh');
                    });
                });

                $event.preventDefault();
            };

            scope.deleteFolder = function($event, path) {
                var dlg = $dialogs.confirm(attrs.deleteModalTitle, _format(attrs.deleteDirectoryText, path));
                dlg.result.then(function() {
                    browser.deleteFolder(path).success(function() {
                        scope.$emit('directory-deleted', path);
                    });
                });
            };

            var _format = function(input) {
                var formatted = input;
                for (var i = 1; i < arguments.length; i++) {
                    var regexp = new RegExp('\\{'+(i-1)+'\\}', 'gi');
                    formatted = formatted.replace(regexp, arguments[i]);
                }
                return formatted;
            };

            scope.$on('file-clicked', function(ev, file) {
                scope.file = file;
            });
        }
    };
}]);