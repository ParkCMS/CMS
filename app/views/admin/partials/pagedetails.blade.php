<div ng-show="!page">
                <h3>Please choose a page!</h3>
            </div>
            <div ng-show="page">
                <h3>Page: @{{ page.title }}</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Title</td>
                            <td>@{{ page.title }}</td>
                        </tr>
                        <tr>
                            <td>Alias</td>
                            <td>@{{ page.alias }}</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>@{{ page.type }}</td>
                        </tr>
                        <tr>
                            <td>Template</td>
                            <td>@{{ page.template }}</td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td>@{{ page.lang }}</td>
                        </tr>
                        <tr>
                            <td>Publish State</td>
                            <td>@{{ page.unpublished }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row" ng-show="page.type != 'lang'">
                    <a href="#" class="btn btn-primary" ng-click="navigateBrowserTo(page, $event)">Edit Page Contents</a>
                    <a href="#" class="btn btn-default" ng-click="showCreate(page, 'child', $event)">Create Child</a>
                    <a href="#" class="btn btn-default" ng-click="showCreate(page, 'before', $event)">Create Page Before</a>
                    <a href="#" class="btn btn-default" ng-click="showCreate(page, 'after', $event)">Create Page After</a>
                    <a href="#" class="btn btn-danger">Delete Page</a>
                </div>
                <div class="row" ng-show="page.type == 'lang'">
                    <a href="#" class="btn btn-danger">Delete Language</a>
                </div>
            </div>