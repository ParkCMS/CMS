parkAdmin.controller('filesController',['$scope', 'FileBrowser', function($scope, browser) {
    browser.getFilesInFolder('/').success(function(data) {
        console.log(data);
    });
}]);
