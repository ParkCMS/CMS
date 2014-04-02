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

    var _isGlobalIdentifier = function(identifier) {
        return identifier.indexOf('global-') === 0;
    };

    this.isGlobalIdentifier = _isGlobalIdentifier;
}]);