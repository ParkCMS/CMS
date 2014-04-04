parkAdmin.directive("fileBrowser", ['FileBrowser', '$dialogs', function(BrowserService, $dialogs) {
    return {
        restrict: 'E',
        require: 'ngModel',
        scope: {
            onSelect: '&',
            selectDirectories: '=',
            enableDragDrop: '=',
            toggle: '='
        },
        templateUrl: 'admin/partials/filebrowser',
        link: function(scope, element, attributes, ngModelController) {
            scope.files = [];
            ngModelController.$render = function() {
                // ngModelController.$viewValue === path
                if (typeof ngModelController.$viewValue !== undefined && ngModelController.$viewValue !== '') {
                    scope.cd(ngModelController.$viewValue);
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
                if (file.isFile || (file.isDir && scope.selectDirectories)) {
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