parkAdmin.service("EditorService", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/programs/editor';

    this.loadAction = function(type, identifier, page, action) {
        var params = {
            'type': type,
            'identifier': identifier,
            'page': page,
            'action': action
        };

        if (_isGlobalIdentifier(identifier)) {
            params = {
                'type': type,
                'identifier': identifier,
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