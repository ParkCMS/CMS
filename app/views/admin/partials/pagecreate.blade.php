<div class="create-form">
    <h3 ng-if="position == 'child'">Create child of <code>@{{ from.alias }}</code></h3>
    <h3 ng-if="position == 'after'">Create sibling after <code>@{{ from.alias }}</code></h3>
    <h3 ng-if="position == 'before'">Create sibling before <code>@{{ from.alias }}</code></h3>
    <form role="form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="alias">Alias</label>
            <input type="Text" class="form-control" id="alias">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>