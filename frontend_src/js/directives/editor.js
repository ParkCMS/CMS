parkAdmin.directive("editor", ['EditorService', '$dialogs', '$compile', '$rootScope', 'growlNotifications', function(EditorService, $dialogs, $compile, $rootScope, growl) {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        transclude: true,
        template: '<div class="editor-messages" growl-notifications></div><div class="editor-content" ng-transclude>Loading...</div>',
        link: function(scope, element, attributes) {
            scope.form = {};

            var _loadSuccess = function(data, status, headers) {
                var header = headers();
                var template = data;
                if (header['content-type'].indexOf('json') !== -1) {
                    template = data.template
                }

                if (typeof data.data !== 'undefined') {
                    for (var field in data.data) {
                        scope.form[field] = data.data[field];
                    }
                }
                var compiled = $compile(template);

                element.find('.editor-content').html( compiled(scope) );
            }

            var _showNotification = function(data) {
                if (typeof data['error'] !== 'undefined') {
                    growl.add(data.error.message, 'danger', 3000);
                } else if (typeof data['success'] !== 'undefined') {
                    growl.add(data.success.message, 'success', 3000);
                }
            }

            EditorService.loadAction(
                scope.data.type,
                scope.data.identifier,
                scope.data.route,
                scope.data.lang,
                'index'
            ).success(_loadSuccess).error(function(data) {
                $dialogs.error(data.error.title, data.error.message);
                scope.$emit('close-editor', scope.data.unique);
            });

            scope.$on('updated-editor', function(ev, data) {
                _showNotification(data);

                if (typeof data['redirect'] !== 'undefined') {
                    scope.$emit('load-action', {action: data['redirect']});
                }
                if (!data['error']) {
                    $rootScope.$broadcast('update-page-browser');
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
                ).success(_loadSuccess).error(function(data) {
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
                    _showNotification(data);
                    if (typeof data['redirect'] !== 'undefined') {
                        scope.$emit('load-action', {action: data['redirect']});
                    }
                    if (!data['error']) {
                        $rootScope.$broadcast('update-page-browser');
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