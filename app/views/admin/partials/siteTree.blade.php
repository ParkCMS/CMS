<div class="site-tree">
    <script type="text/ng-template"  id="tree_item_renderer.html">
        <i class="expand" ng-show="data.children && !expanded[data.id]" ng-click="toggleSubtree(data.id)">E</i>
        <i class="expanded" ng-show="data.children && expanded[data.id]" ng-click="toggleSubtree(data.id)">O</i>
        <i class="page" ng-show="!data.children">P</i>
        <a ng-class="{'selected': data.id == selected}" href="#" ng-click="clickedPage(data, $event)">@{{data.title}} (@{{data.lang}})</a>
        <ul ng-show="data.children && expanded[data.id]" ng-init="tmp_lang = data.lang">
            <li ng-init="data.lang = tmp_lang" ng-repeat="data in data.children | orderObjectBy:'lft'" ng-include="'tree_item_renderer.html'"></li>
        </ul>
    </script>
    <ul ng-repeat="tree in trees">
        <li ng-init="data.lang = data.title" ng-class="{'selected': data.id == selected}" ng-repeat="data in tree" ng-include="'tree_item_renderer.html'"></li>
    </ul>
</div>