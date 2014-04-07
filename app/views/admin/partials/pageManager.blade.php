<div class="row">
    <div class="col-md-4">
        <site-tree model="trees" on-select="select(page)"></site-tree>
    </div>
    <div class="col-md-8">
        <page-details on-create="createPage(page, position)" on-navigate="navigate(page)" page="page"></page>
        <page-create ng-if="status.showCreatePage" from="create.page" position="create.type"></page-create>
    </div>
</div>