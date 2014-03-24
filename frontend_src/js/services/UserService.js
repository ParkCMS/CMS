angular.module('parkAdmin').factory('UserService', [function() {
    return {
        isLoggedIn: false,
        username: '',
        group: {
            id: 0,
            name: '',
            abbreviation: ''
        },

        reset: function() {
            this.isLoggedIn = false;
            this.username = '';
            this.group = {
                id: 0,
                name: '',
                abbreviation: ''
            }
        }
    };
}]);