parkAdmin.directive("pageBrowser", [function() {
    return {
        restrict: 'E',
        templateUrl: 'admin/partials/pageBrowser',
        link: function(scope, element, attributes) {
            var frame = element.find('iframe');
            element.find('iframe').on('load', function(ev) {
                var frameURL = frame[0].contentWindow.location.href;
                var frameContent = angular.element(frame[0].contentWindow.document);

                var buttons = angular.element(frame[0].contentWindow.document.querySelectorAll('.pcms-edit-button'));

                buttons.css('display', 'block');
            });
        }
    };
}]);