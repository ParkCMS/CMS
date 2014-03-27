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

    $scope.refresh = function(ev) {
        $scope.cd(browser.cwd());

        if (typeof ev !== 'undefined') {
            ev.preventDefault();
        }
    };

    $scope.hideComplete = function(file) {
        return !file.isComplete();
    };

    $scope.fileAdded = function (event, flowFile) {
        flowFile.virtualPath = browser.cwd();
    };

    $scope.startUpload = function(event, files) {
        $scope.upload.flow.upload();
    }

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
