<div ng-show="!page">
    <h3>{{ trans('admin_pages.please_choose_page') }}</h3>
</div>
<div ng-show="page">
    <h3>{{ trans('admin_pages.page') }}: @{{ page.title }} ({{ trans('admin_pages.page_language') }}: @{{ page.lang }})</h3>
    <form ng-submit="updatePage()">
        <div class="form-group">
            <label for="edit-title">{{ trans('admin_pages.page_title') }}</label>
            <input class="form-control" type="text" id="edit-title" name="edit-title" ng-model="page.title" />
        </div>
        <div class="form-group">
            <label for="edit-alias">{{ trans('admin_pages.page_alias') }}</label>
            <input class="form-control" type="text" id="edit-alias" name="edit-alias" ng-model="page.alias" disabled />
        </div>
        <div class="form-group">
            <label for="edit-page-type">{{ trans('admin_pages.page_type') }}</label>
            <input class="form-control" type="text" id="edit-page-type" name="edit-page-type" ng-model="page.type" disabled />
        </div>
        <div class="form-group">
            <label for="edit-template">{{ trans('admin_pages.page_template') }}</label>
            <div class="row">
              <div class="col-xs-10">
                <template-selector ng-model="page.template" class="form-control" description="Please choose a template!"></template-selector>
              </div>
              <div class="col-xs-2">
                <button class="btn btn-default" type="button" ng-click="preview(page.template, $event)">Preview</button>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label for="unpublished">{{ trans('admin_pages.page_state') }}</label>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="0" ng-model="page.unpublished" value="0" ng-checked="page.unpublished === 0">
                    {{ trans('admin_pages.state_published') }}
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="1" ng-model="page.unpublished" value="1" ng-checked="page.unpublished === 1">
                    {{ trans('admin_pages.state_hidden') }}
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="2" ng-model="page.unpublished" value="2" ng-checked="page.unpublished === 2">
                    {{ trans('admin_pages.state_unpublished') }}
                </label>
            </div>
        </div>
    <div class="row" ng-show="page.type != 'lang'">
        <button type="submit" class="btn btn-primary">{{ trans('admin_pages.update_page') }}</button>
        <a href="#" class="btn btn-warning" ng-click="navigateBrowserTo(page, $event)">{{ trans('admin_pages.edit_page') }}</a>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Create <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" ng-click="showCreate(page, 'child', $event)">{{ trans('admin_pages.create_child_btn') }}</a></li>
                <li class="divider"></li>
                <li><a href="#" ng-click="showCreate(page, 'before', $event)">{{ trans('admin_pages.create_before_btn') }}</a></li>
                <li><a href="#" ng-click="showCreate(page, 'after', $event)">{{ trans('admin_pages.create_after_btn') }}</a></li>
            </ul>
        </div>
        <a href="#" class="btn btn-danger" ng-click="deletePage(page)">{{ trans('admin_pages.delete_page_btn') }}</a>
    </div>
    <div class="row" ng-show="page.type == 'lang'">
        <a href="#" class="btn btn-danger">{{ trans('admin_pages.delete_lang_btn') }}</a>
    </div>
    </form>
</div>