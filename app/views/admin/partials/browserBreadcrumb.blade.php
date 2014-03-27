<ol class="breadcrumb">
            <li><a href="#" ng-click="cd('/', $event)">{{ trans('admin_default.breadcrumb_root') }}</a></li>
            <li ng-repeat="dir in cwd track by $index" ng-class="{'active' : $last}"><a href="#" ng-if="!$last" ng-click="up($event, $index)">@{{ dir }}</a><span ng-if="$last">@{{ dir }}</span></li>
</ol>