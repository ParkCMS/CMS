<div class="site-tree">
    <ul ng-repeat="tree in trees">
        <li ng-init="data.lang = data.title" ng-class="{'selected': data.id == selected}" ng-repeat="data in tree" ng-include="'admin/partials/tree_item_renderer'"></li>
    </ul>
</div>