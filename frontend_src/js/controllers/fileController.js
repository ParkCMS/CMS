parkAdmin.controller('filesController',['$scope', 'FileBrowser', function($scope, browser) {
    $scope.files = [];
    browser.getFilesInFolder('/').success(function(data) {
        $scope.files = data;
    });

    browser.cd('/piep/piep');

    $scope.testCd = function(ev) {
        browser.cd('folder1/subfolder');

        return false;
    }
}]);
