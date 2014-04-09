parkAdmin.directive("fileBrowser", ['FileBrowser', '$dialogs', function(BrowserService, $dialogs) {
    return {
        restrict: 'E',
        require: 'ngModel',
        scope: {
            onSelect: '&',
            selectDirectories: '=',
            selectFiles: '=?',
            enableDragDrop: '=',
            toggle: '='
        },
        templateUrl: 'admin/partials/filebrowser',
        link: function(scope, element, attributes, ngModelController) {
            if (typeof scope.selectFiles === 'undefined') {
                scope.selectFiles = true;
            }
            scope.files = [];
            ngModelController.$render = function() {
                // ngModelController.$viewValue === path
                if (typeof ngModelController.$viewValue !== undefined) {
                    var path = BrowserService.dirname(ngModelController.$viewValue);
                    if (path == '') {
                        scope.cd('/');
                    } else {
                        scope.cd(path);
                    }
                } else {
                    scope.cd('/');
                }
            };

            scope.cd = function(path, ev) {
                BrowserService.cd(path).success(function(data) {
                   scope.files = data;
                });

                if (typeof ev !== 'undefined') {
                    ev.preventDefault();
                }
            };

            scope.preview = function(file, $event) {
                if ((file.isFile && scope.selectFiles) || (file.isDir && scope.selectDirectories)) {
                    scope.onSelect(file);
                    ngModelController.$setViewValue(file.path);
                }
                scope.selected = file.path;

                if (typeof ev !== 'undefined') {
                    $event.preventDefault();
                }
            };
        }
    };
}]);