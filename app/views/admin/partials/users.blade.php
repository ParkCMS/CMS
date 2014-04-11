<div>
    <div class="row">
        <div class="col-md-12">
            <div class="messages">
                <alert ng-if="message.error" type="danger" close="closeMessage()">@{{ message.error.message }}</alert>
                <alert ng-if="message.success" type="success" close="closeMessage()">@{{ message.success.message }}</alert>
            </div>
        </div>
    </div>
    <div class="row" ng-show="!editUser && !createUser">
        <div class="col-md-12">
            <nav class="navbar navbar-default toolbar" role="navigation">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li><a href="#" ng-click="create($event)"><i class="glyphicon glyphicon-file"></i>New User</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-Mail</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="user in users" ng-click="edit(user)">
                        <td>@{{ user.username }}</td>
                        <td>@{{ user.first_name }}</td>
                        <td>@{{ user.last_name }}</td>
                        <td>@{{ user.email }}</td>
                        <td>@{{ user.activated }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" ng-show="editUser || createUser">
        <div class="col-md-12">
            <form ng-submit="save()">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" ng-model="editData.username">
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" ng-model="editData.first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" ng-model="editData.last_name">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" ng-model="editData.email">
                </div>
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input type="password" class="form-control" ng-model="editData.password">
                </div>
                <div class="form-group">
                    <label for="email">Confirm password:</label>
                    <input type="password" class="form-control" ng-model="editData.password_confirmation">
                </div>
                <div class="form-group">
                    <label for="active">Can @{{ editData.username }} login?</label>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" ng-model="editData.activated" btn-radio="true">Yes</button>
                                <button type="button" class="btn btn-default" ng-model="editData.activated" btn-radio="false">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" ng-click="cancel($event)">Cancel</button>
            </form>
        </div>
    </div>
</div>