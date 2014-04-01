parkAdmin.directive("pageBrowser", ['$window', function($window) {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pageBrowser',
        link: function(scope, element, attributes) {
            var frame = element.find('iframe');

            //scope.editors = [];
            element.find('iframe').on('load', function(ev) {
                var frameURL = frame[0].contentWindow.location.href;
                var frameContent = angular.element(frame[0].contentWindow.document);

                var buttons = angular.element(frame[0].contentWindow.document.querySelectorAll('.pcms-edit-button'));

                buttons.css('display', 'block');

                $window.addEventListener('message', function(event) {
                    var source = event.source.frameElement;
                    var data = event.data;
                    if (event.data.task == 'edit') {
                        scope.$emit('add-editor', data);
                    }
                });
            });
        }
    };
}]);