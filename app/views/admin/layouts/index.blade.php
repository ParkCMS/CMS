<!doctype html>
<html lang="de" ng-app="parkAdmin">
<head>
    <meta charset="UTF-8">
    <title>Parkcms Administration</title>
    <link rel="stylesheet" href="{{ asset('admin_assets/css/main.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body flow-prevent-drop>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#pcms-admin-nav" ng-click="pcmsNavCollapse = !pcmsNavCollapse">
                    <span class="sr-only">{{ trans('admin_default.toggleNav') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <a class="navbar-brand" href="#">ParkCMS</a>
            </div>

            <div class="collapse navbar-collapse" id="pcms-admin-nav" collapse="!pcmsNavCollapse">
                <ul class="nav navbar-nav">
                    <li highlight-active="(.*)\/$"><a href="#">{{ trans('admin_default.dashboard') }}</a></li>
                    <li highlight-active="(.*)\/pages$"><a href="#/pages">{{ trans('admin_default.pages') }}</a></li>
                    <li highlight-active="(.*)\/files$"><a href="#/files">{{ trans('admin_default.files') }}</a></li>
                    <li highlight-active="(.*)\/users$"><a href="#/users">{{ trans('admin_default.users') }}</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $user->fullName() }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">{{ trans('admin_default.account_settings') }}</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('logout') }}">{{ trans('admin_default.logout') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="loading" loading-indicator>{{ trans('admin_default.loading') }}</div>
    <div class="container main-view" ng-view>
        @section('name')
        <h1>ParkCMS</h1>
        @show
    </div>
    <!-- Scripts -->
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script src="admin_assets/js/admin.js"></script>
    <script>
    angular.module('parkAdmin').constant('BASE_URL', '{{ url() }}');
    </script>
    <!-- Partials -->
    @include('admin.compiled')
</body>
</html>