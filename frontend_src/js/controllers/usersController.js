parkAdmin.controller('usersController',['$scope', 'UsersService', function($scope, users) {
    $scope.users = [];
    $scope.editUser = false;
    $scope.editData = {};
    $scope.createUser = false;

    $scope.message = {};
    $scope.closeMessage = function() {
        $scope.message = null;
    };

    $scope.refresh = function() {
        users.getUsers().success(function(data) {
            $scope.users = data;
        });
    };

    $scope.edit = function(user) {
        $scope.editUser = true;
        $scope.editData = user;
    }

    $scope.create = function(event) {
        $scope.createUser = true;
        $scope.editData = {};

        event.preventDefault();
    }

    $scope.save = function() {
        if ($scope.createUser) {
            users.create($scope.editData).success(function(data) {
                $scope.createUser = false;
                $scope.editData = {};
                $scope.message = data;
            }).error(function(data) {
                $scope.message = data;
            });
        } else {
            users.update($scope.editData);
        }
    }

    $scope.cancel = function(event) {
        $scope.editUser = false;
        $scope.createUser = false;
        event.preventDefault();
    }

    $scope.refresh();
}]);