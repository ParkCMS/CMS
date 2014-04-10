parkAdmin.directive("templateSelector", ['PagesService', function(PagesService) {
    return {
        restrict: 'E',
        template: '<select ng-options="template.id as template.name for template in templates"><option value="">{{ description }}</option></select>',
        scope: {
            description: '@',
        },
        replace: true,
        link: function(scope, element, attributes) {
            scope.templates = [];

            PagesService.getTemplates().success(function(templates) {
                scope.templates = templates;
            });
        }
    };
}]);