<div class="row">
    <div class="col-md-4">
        <site-tree model="trees" on-select="select(page)"></site-tree>
    </div>
    <div class="col-md-8">
        <page-details hide-details="status.showCreatePage" on-create="createPage(page, position)" on-navigate="navigate(page)" on-delete="deletePage(page)" on-update="updatePage(page)" page="page"></page-details>
        <page-create visible="status.showCreatePage" from="create.page" position="create.position" on-success="reload()"></page-create>
    </div>
</div>