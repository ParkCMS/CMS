parkAdmin.service("FileBrowser", ['$http', 'BASE_URL', function($http, BASE_URL) {
    var serviceBackend = BASE_URL + '/admin/files/';

    var currentPath = [''];

    this.getFilesInFolder = function(folder) {
        return $http.get(serviceBackend + 'list/', {
            params: {
                'path': folder
            }
        });
    };

    /**
     * Changes into the subdir
     * @param  {[type]} subdir [description]
     * @return {[type]}        [description]
     */
    this.cd = function(subdir) {
        var newPath = this.makeAbsolute(subdir);

        currentPath = newPath;
    };

    this.makeAbsolute = function(path) {
        if (path == '/') {
            return [''];
        }

        if (path[0] == '/') {
            // Absolute path
            return path.split('/');
        } else {
            // Relative path
            var components = path.split('/');

            // Copy current path array
            var workingPath = currentPath.slice();

            for (var i = 0; i < components.length; i++) {
                if (components[i] == '..') {
                    workingPath.pop();
                } else if(components[i] != '.') {
                    workingPath.push(components[i]);
                }
            }

            return workingPath;
        }
    }

    /**
     * Returns the currently loaded path
     * The root level is always '/'
     * @return {string} The path
     */
    this.cwd = function(stacked) {
        stacked = (typeof stacked == 'undefined' ? false : stacked);

        if (stacked) {
            return currentPath;
        }

        var path = currentPath.join('/');
        if (path === '') {
            return '/';
        }
        return path;
    }
}]);