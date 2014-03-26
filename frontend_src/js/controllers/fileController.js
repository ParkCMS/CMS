parkAdmin.controller('filesController',['$scope', 'FileBrowser', function($scope, browser) {
    $scope.files = [];
    // browser.getFilesInFolder('/').success(function(data) {
    //     $scope.files = data;
    // });
    
    $scope.cd = function(path, ev) {
        browser.cd(path).success(function(data) {
           $scope.files = data; 
        });

        if (typeof ev !== 'undefined') {
            ev.preventDefault();
        }
    }

    $scope.cd('/');
}]);
