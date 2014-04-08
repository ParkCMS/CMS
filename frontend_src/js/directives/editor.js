parkAdmin.directive("editor", ['EditorService', '$dialogs', '$compile', function(EditorService, $dialogs, $compile) {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        transclude: true,
        template: '<div class="editor-messages"><alert ng-if="message.message" type="message.type" close="message.close()">{{ message.message }}</alert></div><div class="editor-content" ng-transclude>Loading...</div>',
        link: function(scope, element, attributes) {

            EditorService.loadAction(
                scope.data.type,
                scope.data.identifier,
                scope.data.route,
                scope.data.lang,
                'index'
            ).success(function(data) {
                var compiled = $compile(data);

                element.find('.editor-content').append( compiled(scope) );
            }).error(function(data) {
                $dialogs.error(data.error.title, data.error.message);
                scope.$emit('close-editor', scope.data.unique);
            });

            scope.message = {};
            scope.message.close = function() {
                scope.message.message = null;
            };

            scope.$on('updated-editor', function(ev, data) {
                if (typeof data['message'] !== 'undefined') {
                    scope.message.type = data['type'];
                    scope.message.message = data['message'];

                    if (typeof data['redirect'] !== 'undefined') {
                        scope.$emit('load-action', {action: data['redirect']});
                    }
                    scope.$emit('update-page-browser');
                }
            });

            scope.$on('load-action', function(ev, action) {
                EditorService.loadAction(
                    scope.data.type,
                    scope.data.identifier,
                    scope.data.route,
                    scope.data.lang,
                    action.action,
                    action.params
                ).success(function(data) {
                    var compiled = $compile(data);

                    element.find('.editor-content').html( compiled(scope) );
                }).error(function(data) {
                    $dialogs.error(data.error.title, data.error.message);
                    if (action.action === 'index') {
                        scope.$emit('close-editor', scope.data.unique);
                    } else {
                        scope.$emit('load-action', {'action': 'index'});
                    }
                });
                event.preventDefault();
            });

            scope.$on('call-action', function(ev, action) {
                EditorService.loadAction(
                    scope.data.type,
                    scope.data.identifier,
                    scope.data.route,
                    scope.data.lang,
                    action.action,
                    action.params
                ).success(function(data) {
                    if (typeof data['message'] !== 'undefined') {
                        scope.message.type = data['type'];
                        scope.message.message = data['message'];

                        if (typeof data['redirect'] !== 'undefined') {
                            scope.$emit('load-action', {action: data['redirect']});
                        }
                        scope.$emit('update-page-browser');
                    }
                }).error(function(data) {
                    $dialogs.error(data.error.title, data.error.message);
                    if (action.action === 'index') {
                        scope.$emit('close-editor', scope.data.unique);
                    } else {
                        scope.$emit('load-action', {'action': 'index'});
                    }
                });
                // event.preventDefault();
            });
        }
    };
}]).directive('loadAction', [function() {
    return {
        restrict: 'A',
        scope: {
            loadParams: '='
        },
        link: function (scope, element, attributes) {
            element.attr('href', '#');
            element.bind('click', function(event) {
                scope.$emit('load-action', {'action': attributes.loadAction, 'params': scope.loadParams});
                event.preventDefault();
            });
        }
    }
}]).directive('callAction', [function() {
    return {
        restrict: 'A',
        scope: {
            loadParams: '='
        },
        link: function (scope, element, attributes) {
            element.attr('href', '#');
            element.bind('click', function(event) {
                scope.$emit('call-action', {'action': attributes.callAction, 'params': scope.loadParams});
                event.preventDefault();
            });
        }
    }
}]).directive('confirmAction', ['$dialogs', function($dialogs) {
    return {
        restrict: 'A',
        scope: {
            loadParams: '='
        },
        link: function (scope, element, attributes) {
            element.attr('href', '#');
            element.bind('click', function(event) {
                $dialogs.confirm(attributes.title, attributes.confirmMessage).result.then(function(btn) {
                    scope.$emit('call-action', {'action': attributes.confirmAction, 'params': scope.loadParams});
                });
                event.preventDefault();
            });
        }
    }
}]).directive('editorAction', ['EditorService', function(EditorService) {
    return {
        restrict: 'A',
        scope: false,
        link: function(scope, element, attr) {
            element.on('submit', function(event) {
              scope.$apply(function() {
                var action = attr.editorAction;
                var method = attr.method;

                var formData = scope.form;

                EditorService.update({
                    'action': action,
                    'method': method,
                    'program': scope.data,
                    'data': {'form': formData}
                }).success(function(data) {
                    scope.$emit('updated-editor', data);
                });

                event.preventDefault();
              });
            });
        }
    }
}]);