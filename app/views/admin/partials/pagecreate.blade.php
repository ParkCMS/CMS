<div class="create-form" ng-show="visible">
    <h3 ng-if="position == 'child'">{{ trans('admin_pages.create_child') }}</h3>
    <h3 ng-if="position == 'after'">{{ trans('admin_pages.create_sibling_after') }}</h3>
    <h3 ng-if="position == 'before'">{{ trans('admin_pages.create_sibling_before') }}</h3>
    <form role="form" ng-submit="createPage()">
        <div class="form-group">
            <label for="title">{{ trans('admin_pages.page_title') }}</label>
            <input type="text" class="form-control" required ng-model="new.title" id="title" placeholder="Title" />
        </div>
        <div class="form-group">
            <label for="alias">{{ trans('admin_pages.page_alias') }}</label>
            <input type="text" class="form-control" required ng-model="new.alias" id="alias" placeholder="Alias" />
        </div>
        <div class="form-group">
            <label for="lang">{{ trans('admin_pages.page_language') }}</label>
            <input type="text" class="form-control" id="lang" ng-model="from.lang" disabled="disabled" />
        </div>
        <div class="form-group">
            <label for="template">{{ trans('admin_pages.page_template') }}</label>
            <div class="row">
              <div class="col-xs-10">
                <template-selector ng-model="new.template" class="form-control" description="Please choose a template!"></template-selector>
              </div>
              <div class="col-xs-2">
                <button class="btn btn-default" type="button" ng-click="preview(new.template, $event)">Preview</button>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label for="type">{{ trans('admin_pages.page_type') }}</label>
            <select name="type" id="type" class="form-control">
                <option value="page">Page</option>
            </select>
        </div>
        <div class="form-group">
            <label for="unpublished">{{ trans('admin_pages.page_state') }}</label>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="0" ng-model="new.unpublished" value="0" ng-checked="new.unpublished === 0">
                    {{ trans('admin_pages.state_published') }}
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="1" ng-model="new.unpublished" value="1" ng-checked="new.unpublished === 1">
                    {{ trans('admin_pages.state_hidden') }}
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="2" ng-model="new.unpublished" value="2" ng-checked="new.unpublished === 2">
                    {{ trans('admin_pages.state_unpublished') }}
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ trans('admin_default.submit') }}</button>
        <a href="#" class="btn btn-default" ng-click="cancelCreate($event)">{{ trans('admin_default.cancel') }}</a>
    </form>
</div>