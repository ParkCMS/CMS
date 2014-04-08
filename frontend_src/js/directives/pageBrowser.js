parkAdmin.directive("pageBrowser", ['$window', function($window) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pageBrowser',
        scope: {
            src: '='
        },
        link: function(scope, element, attributes) {
            var frame = element.find('iframe');

            scope.$emit('browser-load-start');
            scope.browserUrl = scope.src;

            frame.on('load', function(ev) {
                var frameURL = frame[0].contentWindow.location.href;
                var frameContent = angular.element(frame[0].contentWindow.document);

                var buttons = angular.element(frame[0].contentWindow.document.querySelectorAll('.pcms-edit-button'));

                buttons.css('display', 'block');

                scope.$apply(function() {
                    scope.$emit('browser-load-finish');
                });

                $window.addEventListener('message', function(event) {
                    var source = event.source.frameElement;
                    var data = event.data;
                    
                    if (event.data.task == 'edit') {
                        scope.$emit('add-editor', data);
                    }
                });
            });

            scope.$on('update-page-browser', function() {
                scope.$emit('browser-load-start');
                element.find('iframe')[0].contentWindow.location.reload(true);
            });

            scope.$on('browser-relocate', function(ev, url) {
                scope.$emit('browser-load-start');
                element.find('iframe')[0].contentWindow.location.href = url;

                ev.preventDefault();
            })
        }
    };
}]);