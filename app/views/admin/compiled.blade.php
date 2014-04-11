<script type="text/ng-template" id="admin/partials/browserBreadcrumb"><ol class="breadcrumb">
    <li><a href="#" ui-on-drop="onDrop({$data: $data, path: {path: '/'}})" ng-click="up($event, -1)">{{ trans('admin_default.breadcrumb_root') }}</a></li>
    <li ng-repeat="dir in cwd track by $index" ng-class="{'active' : $last}">
        <a href="#" ui-on-drop="onDrop({$data: $data, path: {path: buildToIndex($index)}})" ng-if="!$last" ng-click="up($event, $index)">@{{ dir }}</a>
        <span ng-if="$last" ui-on-drop="onDrop({$data: $data, path: {path: buildToIndex($index)}})">@{{ dir }}</span>
    </li>
</ol></script><script type="text/ng-template" id="admin/partials/browserSidebar"><div class="sidebar-info" ng-if="file">
    <div ng-if="file.isFile">
        <h3>File: @{{ file.filename }}</h3>

        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <div class="btn-group" style="margin: auto;">
                    <a ng-href="@{{ file.url }}" type="button" class="btn btn-default">{{ trans('admin_default.download_action') }}</a>
                    <button ng-click="deleteFile($event, file.path)" type="button" class="btn btn-default">{{ trans('admin_default.delete_action') }}</button>
                    <button ng-click="rename($event, file)" type="button" class="btn btn-default">{{ trans('admin_default.rename_action') }}</button>
                </div>
            </div>
        </div>

        <div class="row" ng-if="file.type.indexOf('image') === 0">
            <div class="col-md-12 preview">
                <img class="thumbnail" ng-src="@{{file.url}}" style="max-width: 80%; margin: auto;">
            </div>
        </div>
    </div>
    <div ng-if="file.isDir">
        <h3>Directory: @{{ file.filename }}</h3>

        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <div class="btn-group" style="margin: auto;">
                    <a ng-href="@{{ file.url }}" type="button" class="btn btn-default">{{ trans('admin_default.archive_action') }}</a>
                    <button ng-click="deleteFolder($event, file.path)" type="button" class="btn btn-default">{{ trans('admin_default.delete_action') }}</button>
                    <button ng-click="rename($event, file)" type="button" class="btn btn-default">{{ trans('admin_default.rename_action') }}</button>
                </div>
            </div>
        </div>
    </div>
</div></script><script type="text/ng-template" id="admin/partials/dashboard"><h1>ParkCMS</h1>
<p>Please choose an action in the menu at the top!</p></script><script type="text/ng-template" id="admin/partials/editor"><div>
    <h1>Editor</h1>
    <div class="content">
        <a load-action="index">Link</a>
    </div>
</div></script><script type="text/ng-template" id="admin/partials/filebrowser"><div collapse="toggle">
    <div class="row">
        <div class="col-md-12 col-lg-12" browser-breadcrumb on-change="cd(path)"></div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 15px;">
    <div class="filelist">
        <div class="row">
            <div class="col-sm-6 col-md-2 file" ng-repeat="file in files |bytype:types">
                <div ui-draggable="enableDragDrop" drag="file" ui-on-drop="move($data, file)" class="thumbnail" ng-class="{'selected': selected == file.path}" ng-if="file.isDir" ng-click="preview(file)" ng-dblclick="cd(file.path)">
                    <p>
                        <i style="font-size: 300%" class="glyphicon glyphicon-folder-open"></i>
                    </p>
                    <p>@{{ file.filename }}</p>
                </div>
                <div ui-draggable="enableDragDrop" drag="file" class="thumbnail" ng-class="{'selected': selected == file.path}" ng-if="file.isFile" ng-click="preview(file)">
                    <p>
                        <i style="font-size: 300%" class="glyphicon glyphicon-picture"></i>
                    </p>
                    <p>@{{ file.filename }}</p>
                </div>
            </div>
            <div class="no-files" ng-if="files.length === 0">
                <h3>{{ trans('admin_default.no_files') }}</h3>
                <p>{{ trans('admin_default.no_files_desc') }}</p>
            </div>
        </div>
    </div>
    </div>
    </div>
</div></script><script type="text/ng-template" id="admin/partials/files"><div flow-init="{target:'{{ url() }}/admin/files/upload', 'query':queryBuild}"
     flow-name="upload.flow"
     flow-file-added="fileAdded($event, $file)"
     flow-files-submitted="startUpload($event, $files)"
     flow-complete="uploadComplete()">
    <div class="row toolbar">
        <div class="col-md-3 col-lg-2">
            <div class="btn-group">
                <button class="btn btn-default" title="{{ trans('admin_default.upload_action') }}" flow-btn>
                    <span class="glyphicon glyphicon-arrow-up"></span>
                </button>
                <button class="btn btn-default" title="{{ trans('admin_default.new_dir_action') }}" ng-click="open_mkdir()">
                    <span class="glyphicon glyphicon-folder-close"></span>
                </button>
                <button class="btn btn-default" title="{{ trans('admin_default.archive_action') }}">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
            </div>
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-default" title="{{ trans('admin_default.up') }}" ng-click="cd('..')">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                </button>
            </div>
        </div>
        <div class="col-md-9 col-lg-10" browser-breadcrumb on-change="cd(path)" on-drop="move($data, path)">

        </div>
    </div>
    <div class="row">
        <div class="col-md-8 filelist" ng-class="{'dragging': dragging}" flow-drop flow-drag-enter="dragging=true" flow-drag-leave="dragging=false">
            <div class="row">
                <div class="col-sm-6 col-md-2 file" ng-repeat="file in files">
                    <div ui-draggable="true" drag="file" ui-on-drop="move($data, file)" class="thumbnail" ng-class="{'selected': selected == file.path}" ng-if="file.isDir" ng-click="preview(file)" ng-dblclick="cd(file.path)">
                        <p>
                            <i style="font-size: 300%" class="glyphicon glyphicon-folder-open"></i>
                        </p>
                        <p>@{{ file.filename }}</p>
                    </div>
                    <div ui-draggable="true" drag="file" class="thumbnail" ng-class="{'selected': selected == file.path}" ng-if="file.isFile" ng-click="preview(file)">
                        <p>
                            <i style="font-size: 300%" class="glyphicon glyphicon-picture"></i>
                        </p>
                        <p>@{{ file.filename }}</p>
                    </div>
                </div>
                <div class="no-files" ng-if="files.length === 0">
                    <h3>{{ trans('admin_default.no_files') }}</h3>
                    <p>{{ trans('admin_default.no_files_desc') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" browser-sidebar
            delete-modal-title="{{ trans('admin_default.are_you_sure') }}"
            delete-file-text="{{ trans('admin_default.delete_file_text') }}"
            delete-directory-text="{{ trans('admin_default.delete_directory_text') }}">

        </div>
    </div>
    <div class="row uploads">
        <div class="col-md-12">
            <h3>{{ trans('admin_default.uploads') }}</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('admin_default.tbl_filename') }}</th>
                        <th>{{ trans('admin_default.tbl_path') }}</th>
                        <th>{{ trans('admin_default.tbl_filesize') }}</th>
                        <th>{{ trans('admin_default.tbl_filetype') }}</th>
                        <th>{{ trans('admin_default.tbl_upload_status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="file in upload.flow.files" ng-class="{'error': file.error, 'completed': file.isComplete()}">
                        <td>@{{file.name}}</td>
                        <td>@{{ file.virtualPath }}</td>
                        <td>@{{file.size | bytes }}</td>
                        <td>@{{file.getType()}}</td>
                        <td ng-switch="file.isComplete()">
                            <span ng-switch-when="false">
                                <progressbar max="100" value="file.progress() * 100" type="warning">@{{ file.progress() | percentage }} %</progressbar>
                            </span>
                            <span ng-switch-default>{{ trans('admin_default.done') }}</span>
                        </td>
                    </tr>
                    <tr ng-if="upload.flow.files.length === 0">
                        <td colspan="5" class="no-files">{{ trans('admin_default.no_uploads') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div></script><script type="text/ng-template" id="admin/partials/mkdir_modal"><div class="modal-header">
            <h3>{{ trans('admin_default.create_folder') }}</h3>
        </div>
        <div class="modal-body">
            <p>{{ trans('admin_default.create_folder_desc') }}</p>
            <input type="text" class="form-control" ng-keyup="hitEnter($event)" placeholder="{{ trans('admin_default.folder_name_placeholder') }}" ng-model="fields.dirname" />
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">{{ trans('admin_default.ok') }}</button>
            <button class="btn btn-warning" ng-click="cancel()">{{ trans('admin_default.cancel') }}</button>
        </div></script><script type="text/ng-template" id="admin/partials/pageBrowser"><div class="browser-container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="back($event)"><span class="glyphicon glyphicon-arrow-left"></span></button>
                        <button type="button" class="btn btn-default" ng-click="forward($event)"><span class="glyphicon glyphicon-arrow-right"></span></button>
                        <button type="button" class="btn btn-default" ng-click="refresh($event)"><span class="glyphicon glyphicon-refresh"></span></button>
                    </div>
                    <input type="text" class="form-control" ng-model="browserUrl" disabled>
                </div>
            </div>
        </div>
    </div>
    <iframe frameborder="0" style="width: 100%"></iframe>
</div></script><script type="text/ng-template" id="admin/partials/pagecreate"><div class="create-form" ng-show="visible">
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
</div></script><script type="text/ng-template" id="admin/partials/pagedetails"><div ng-show="!page">
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
</div></script><script type="text/ng-template" id="admin/partials/pageManager"><div class="row">
    <div class="col-md-4">
        <site-tree model="trees" on-select="select(page)"></site-tree>
    </div>
    <div class="col-md-8">
        <page-details hide-details="status.showCreatePage" on-create="createPage(page, position)" on-navigate="navigate(page)" on-delete="deletePage(page)" on-update="updatePage(page)" page="page"></page-details>
        <page-create visible="status.showCreatePage" from="create.page" position="create.position" on-success="reload()"></page-create>
    </div>
</div></script><script type="text/ng-template" id="admin/partials/pages"><div class="row pages">
    <div class="col-md-12">
	    <tabset>
			<tab active="status.browserActive">
				<tab-heading>
					<img ng-if="status.browserLoading" style="margin-top: 2px; margin-left: 5px;" class="pull-right" src="{{ url('admin_assets/img/ajax-loader.gif') }}" alt="Loading..." />
					<span>{{ trans('admin_pages.page_browser') }}</span>
				</tab-heading>
				<page-browser class="page-browser" src="browserSource"></page-browser>
			</tab>
			<tab>
				<tab-heading>
					{{ trans('admin_pages.page_manager') }}
				</tab-heading>
				<page-manager on-navigate="navigateTo(page)" delete-page-title="Delete page" delete-page-description="Do you really want to delete the page?"></page-manager>
			</tab>
			<tab class="slide" ng-repeat="editor in tabs.editors track by editor.unique" active="editor.active">
				<tab-heading>
					<a ng-click="editorClose($index, $event)"><i class="glyphicon glyphicon-remove"></i></a>
					{{ trans('admin_pages.edit') }} @{{ editor.lang }}<span ng-if="!editor.global">-@{{ editor.route }}</span>/<strong>@{{ editor.identifier }}</strong> (@{{ editor.type }})
				</tab-heading>
				<editor data="editor"></editor>
			</tab>
	    </tabset>
    </div>
</div></script><script type="text/ng-template" id="admin/partials/preview"><div class="modal-header">
    <h4 class="modal-title"><span class="glyphicon glyphicon-star"></span> {{ trans('admin_pages.preview_template') }}</h4>
</div>
<div class="modal-body">
    <iframe src="@{{getIframeSrc()}}" style="width: 100%; height: 100%" frameborder="0"></iframe>
</div>
<div class="modal-footer">
    <a ng-href="@{{getIframeSrc()}}" class="btn btn-default" target="_blank">{{ trans('admin_pages.enlarge') }}</a>
    <button type="button" class="btn btn-primary" ng-click="ok()">{{ trans('admin_default.ok') }}</button>
</div></script><script type="text/ng-template" id="admin/partials/rename"><div class="modal-header">
    <h4 class="modal-title"><span class="glyphicon glyphicon-star"></span> {{ trans('admin_default.rename_file') }}</h4>
</div>
<div class="modal-body">
    <ng-form name="nameDialog" novalidate role="form">
        <div class="form-group input-group-lg">
            <label class="control-label" for="course">{{ trans('admin_default.new_name') }}:</label>
            <input type="text" class="form-control" name="destPath" id="destPath" ng-model="file.dest" ng-keyup="hitEnter($event)" required>
            <span class="help-block">{{ trans('admin_default.rename_help') }}</span>
        </div>
    </ng-form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" ng-click="cancel()">{{ trans('admin_default.cancel') }}</button>
    <button type="button" class="btn btn-primary" ng-click="save()">{{ trans('admin_default.submit') }}</button>
</div></script><script type="text/ng-template" id="admin/partials/siteTree"><div class="site-tree">
    <ul ng-repeat="tree in trees">
        <li ng-init="data.lang = data.title" ng-class="{'selected': data.id == selected}" ng-repeat="data in tree" ng-include="'admin/partials/tree_item_renderer'"></li>
    </ul>
</div></script><script type="text/ng-template" id="admin/partials/tree_item_renderer"><i class="expand" ng-show="data.children && !expanded[data.id]" ng-click="toggleSubtree(data.id)"></i>
    <i class="expanded" ng-show="data.children && expanded[data.id]" ng-click="toggleSubtree(data.id)"></i>
    <i class="page glyphicon glyphicon-file" ng-show="!data.children"></i>
    <a ng-class="{'selected': data.id == selected}" href="#" ng-click="clickedPage(data, $event)">@{{data.title}} (@{{data.lang}})</a>
    <ul ng-show="data.children && expanded[data.id]" ng-init="tmp_lang = data.lang">
        <li ng-init="data.lang = tmp_lang" ng-repeat="data in data.children | orderObjectBy:'lft'" ng-include="'admin/partials/tree_item_renderer'"></li>
    </ul></script><script type="text/ng-template" id="admin/partials/users"><div>
    <div class="row">
        <div class="col-md-12">
            <div class="messages">
                <alert ng-if="message.error" type="danger" close="closeMessage()">@{{ message.error.message }}</alert>
                <alert ng-if="message.success" type="success" close="closeMessage()">@{{ message.success.message }}</alert>
            </div>
        </div>
    </div>
    <div class="row" ng-show="!editUser && !createUser">
        <div class="col-md-12">
            <nav class="navbar navbar-default toolbar" role="navigation">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li><a href="#" ng-click="create($event)"><i class="glyphicon glyphicon-file"></i>New User</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-Mail</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="user in users" ng-click="edit(user)">
                        <td>@{{ user.username }}</td>
                        <td>@{{ user.first_name }}</td>
                        <td>@{{ user.last_name }}</td>
                        <td>@{{ user.email }}</td>
                        <td>@{{ user.activated }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" ng-show="editUser || createUser">
        <div class="col-md-12">
            <form ng-submit="save()">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" ng-model="editData.username">
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" ng-model="editData.first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" ng-model="editData.last_name">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" ng-model="editData.email">
                </div>
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input type="password" class="form-control" ng-model="editData.password">
                </div>
                <div class="form-group">
                    <label for="email">Confirm password:</label>
                    <input type="password" class="form-control" ng-model="editData.password_confirmation">
                </div>
                <div class="form-group">
                    <label for="active">Can @{{ editData.username }} login?</label>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" ng-model="editData.activated" btn-radio="true">Yes</button>
                                <button type="button" class="btn btn-default" ng-model="editData.activated" btn-radio="false">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" ng-click="cancel($event)">Cancel</button>
            </form>
        </div>
    </div>
</div></script>