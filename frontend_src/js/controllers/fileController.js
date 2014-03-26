parkAdmin.controller('filesController',['$scope', 'FileBrowser', function($scope, browser) {
    $scope.files = [];
    // browser.getFilesInFolder('/').success(function(data) {
    //     $scope.files = data;
    // });
    
    $scope.cd = function(path) {
        browser.cd(path).success(function(data) {
           $scope.files = data; 
        });
    }

    $scope.cd('/');
}]);
