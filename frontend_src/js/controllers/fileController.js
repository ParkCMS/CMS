parkAdmin.controller('filesController',['$scope', 'FileBrowser', function($scope, browser) {
    $scope.files = [];
    $scope.upload = {};
    $scope.upload.flow = null;
    
    $scope.cd = function(path, ev) {
        browser.cd(path).success(function(data) {
           $scope.files = data; 
        });

        if (typeof ev !== 'undefined') {
            ev.preventDefault();
        }
    }

    $scope.fileAdded = function (event, flowFile) {
        //event.preventDefault();//prevent file from uploading
        flowFile.virtualPath = browser.cwd();
        //$scope.upload.flow.upload();
        flowFile.flowObj.upload();
        console.log(flowFile.flowObj.files);
        //console.log($scope.upload.flow.files);
        //console.log($scope);
    };

    $scope.queryBuild = function(flowFile, flowChunk) {
        return {'virtualPath': flowFile.virtualPath};
        //console.log(flowFile.name);
    };
    $scope.$on('flow::fileAdded', function (event, $flow, flowFile) {
        console.log(flowFile.name);//prevent file from uploading
    });

    $scope.preview = function(file) {
        $scope.$broadcast('file-clicked', file);
    }

    $scope.cd('/');
}]);
