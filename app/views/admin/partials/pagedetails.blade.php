<div ng-show="!page">
                <h3>{{ trans('admin_pages.please_choose_page') }}</h3>
            </div>
            <div ng-show="page">
                <h3>{{ trans('admin_pages.page') }}: @{{ page.title }}</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>{{ trans('admin_pages.page_title') }}</td>
                            <td>@{{ page.title }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('admin_pages.page_alias') }}</td>
                            <td>@{{ page.alias }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('admin_pages.page_type') }}</td>
                            <td>@{{ page.type }}</td>
                        </tr>
                        <tr ng-hide="hideDetails">
                            <td>{{ trans('admin_pages.page_template') }}</td>
                            <td>@{{ page.template }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('admin_pages.page_language') }}</td>
                            <td>@{{ page.lang }}</td>
                        </tr>
                        <tr ng-hide="hideDetails">
                            <td>{{ trans('admin_pages.page_state') }}</td>
                            <td>@{{ page.unpublished }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row" ng-show="page.type != 'lang'">
                    <a href="#" class="btn btn-primary" ng-click="navigateBrowserTo(page, $event)">{{ trans('admin_pages.edit_page') }}</a>
                    <a href="#" class="btn btn-default" ng-click="showCreate(page, 'child', $event)">{{ trans('admin_pages.create_child_btn') }}</a>
                    <a href="#" class="btn btn-default" ng-click="showCreate(page, 'before', $event)">{{ trans('admin_pages.create_before_btn') }}</a>
                    <a href="#" class="btn btn-default" ng-click="showCreate(page, 'after', $event)">{{ trans('admin_pages.create_after_btn') }}</a>
                    <a href="#" class="btn btn-danger" ng-click="deletePage(page)">{{ trans('admin_pages.delete_page_btn') }}</a>
                </div>
                <div class="row" ng-show="page.type == 'lang'">
                    <a href="#" class="btn btn-danger">{{ trans('admin_pages.delete_lang_btn') }}</a>
                </div>
            </div>