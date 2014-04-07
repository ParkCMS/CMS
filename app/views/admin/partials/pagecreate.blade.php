<div class="create-form" ng-show="visible">
    <h3 ng-if="position == 'child'">Create child of <code>@{{ from.lang }}/@{{ from.alias }}</code></h3>
    <h3 ng-if="position == 'after'">Create sibling after <code>@{{ from.lang }}/@{{ from.alias }}</code></h3>
    <h3 ng-if="position == 'before'">Create sibling before <code>@{{ from.lang }}/@{{ from.alias }}</code></h3>
    <form role="form" ng-submit="createPage()">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" required ng-model="new.title" id="title" placeholder="Title" />
        </div>
        <div class="form-group">
            <label for="alias">Alias</label>
            <input type="text" class="form-control" required ng-model="new.alias" id="alias" placeholder="Alias" />
        </div>
        <div class="form-group">
            <label for="lang">Language</label>
            <input type="text" class="form-control" id="lang" ng-model="from.lang" disabled="disabled" />
        </div>
        <div class="form-group">
            <label for="template">Template</label>
            <input type="text" class="form-control" required ng-model="new.template" id="template" ng-model="from.template" />
        </div>
        <div class="form-group">
            <label for="unpublished">Publish State</label>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="0" ng-model="new.unpublished" value="0" ng-checked="new.unpublished === 0">
                    Published
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="1" ng-model="new.unpublished" value="1" ng-checked="new.unpublished === 1">
                    Hidden in Menu, but accessable via Link
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="unpublished" ng-true-value="2" ng-model="new.unpublished" value="2" ng-checked="new.unpublished === 2">
                    Unpublished (i.e. not accessable via link or menu)
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="#" class="btn btn-default" ng-click="cancelCreate($event)">Cancel</a>
    </form>
</div>