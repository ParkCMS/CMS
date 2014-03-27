parkAdmin.controller('filesController',['$scope', '$modal', 'FileBrowser', function($scope, $modal, browser) {
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

    $scope.open_mkdir = function() {
        var modalInstance = $modal.open({
            templateUrl: 'admin/partials/mkdir_modal',
            controller: 'MkdirController',
            resolve: {
                cwd: function() {
                    return browser.cwd();
                }
            }
        });

        modalInstance.result.then(function (dirname) {
            browser.mkdir(browser.cwd(), dirname).success(function() {
                $scope.refresh();
            });
        })
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

parkAdmin.controller('MkdirController',['$scope', '$modalInstance', function($scope, $modalInstance) {
    $scope.fields = {};
    $scope.fields.dirname = "";
    $scope.ok = function() {
        console.log($scope.dirname);
        $modalInstance.close($scope.dirname);
    };

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    }
}]);