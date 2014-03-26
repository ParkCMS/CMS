parkAdmin.controller('filesController',['$scope', 'FileBrowser', function($scope, browser) {
    $scope.files = [];
    
    $scope.cd = function(path, ev) {
        browser.cd(path).success(function(data) {
           $scope.files = data; 
        });

        if (typeof ev !== 'undefined') {
            ev.preventDefault();
        }
    }

    $scope.preview = function(file) {
        $scope.$broadcast('file-clicked', file);
    }

    $scope.cd('/');
}]);
