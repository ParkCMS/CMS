parkAdmin.service("EditorService", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/programs/editor';

    this.loadAction = function(type, identifier, page, lang, action) {
        var params = {
            'type': type,
            'identifier': identifier,
            'page': page,
            'lang': lang,
            'action': action
        };

        if (_isGlobalIdentifier(identifier)) {
            params = {
                'type': type,
                'identifier': identifier,
                'lang': lang,
                'action': action,
                'global': 'global'
            };
        }

        return $http.get(serviceBackend, {
            params: params
        });
    };

    this.update = function(options) {
        
        if (_isGlobalIdentifier(options.program.identifier)) {
            options.program = {
                'type': options.program.type,
                'identifier': options.program.identifier,
                'lang': options.program.lang,
                //'action': options.program.action,
                'global': 'global'
            };
        }

        return $http({
            method: options.method,
            url: serviceBackend,
            params: angular.extend(options.program, {'action': options.action}),
            data: options.data
        });
    }

    var _isGlobalIdentifier = function(identifier) {
        return identifier.indexOf('global-') === 0;
    };

    this.isGlobalIdentifier = _isGlobalIdentifier;
}]);