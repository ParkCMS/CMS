<i class="expand" ng-show="data.children && !expanded[data.id]" ng-click="toggleSubtree(data.id)"></i>
    <i class="expanded" ng-show="data.children && expanded[data.id]" ng-click="toggleSubtree(data.id)"></i>
    <i class="page glyphicon glyphicon-file" ng-show="!data.children"></i>
    <a ng-class="{'selected': data.id == selected}" href="#" ng-click="clickedPage(data, $event)">@{{data.title}} (@{{data.lang}})</a>
    <ul ng-show="data.children && expanded[data.id]" ng-init="tmp_lang = data.lang">
        <li ng-init="data.lang = tmp_lang" ng-repeat="data in data.children | orderObjectBy:'lft'" ng-include="'admin/partials/tree_item_renderer'"></li>
    </ul>