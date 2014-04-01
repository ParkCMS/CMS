<script type="text/ng-template" id="loginform">
    <div class="modal-header">
        <h3>Login</h3>
    </div>
    <div class="modal-body">
        <form role="form">
            <div class="form-group">
                <label for="username">Benutzername: </label>
                <input type="text" name="username" ng-model="credentials.username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Passwort: </label>
                <input type="password" name="password" ng-model="credentials.password" class="form-control">
            </div>
        </form>
        <a href="#/forgotten-password">Passwort vergessen</a>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" ng-click="login()">Login</button>
    </div>
</script>