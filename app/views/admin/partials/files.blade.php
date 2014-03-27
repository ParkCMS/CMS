<div flow-init="{target:'/admin/files/uploader', 'query':queryBuild}"
     flow-name="upload.flow"
     flow-file-added="fileAdded($event, $file)"
     flow-upload-started="console.log('Upload')">
    <div class="row toolbar">
        <div class="col-md-2">
            <div class="btn-group">
                <button class="btn btn-default" title="Upload">
                    <span class="glyphicon glyphicon-arrow-up"></span>
                </button>
                <button class="btn btn-default" title="New Directory">
                    <span class="glyphicon glyphicon-folder-close"></span>
                </button>
                <button class="btn btn-default" title="Archive">
                    <span class="glyphicon glyphicon-envelope"></span>
                </button>
            </div>
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-default" title="Up" ng-click="cd('..')">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                </button>
            </div>
        </div>
        <div class="col-md-10" browser-breadcrumb>
    
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 filelist" ng-class="{'dragging': dragging}" flow-drop flow-drag-enter="dragging=true" flow-drag-leave="dragging=false">
            <div class="row">
                <div class="col-sm-6 col-md-2 file" ng-repeat="file in files">
                    <div class="thumbnail" ng-if="file.isDir" ng-click="cd(file.path)">
                        <p>
                            <i style="font-size: 300%" class="glyphicon glyphicon-folder-open"></i>
                        </p>
                        <p>@{{ file.filename }}</p>
                    </div>
                    <div class="thumbnail" ng-if="file.isFile" ng-click="preview(file)">
                        <p>
                            <i style="font-size: 300%" class="glyphicon glyphicon-picture"></i>
                        </p>
                        <p>@{{ file.filename }}</p>
                    </div>
                </div>
                <div class="no-files" ng-if="files.length === 0">
                    <h3>No files available!</h3>
                    <p>Drag files from your computer here or click the Upload button!</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" browser-sidebar>
    
        </div>
    </div>
    <div class="row uploads">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-11">
                    <h3>Uploads</h3>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-default" flow-btn>Upload</button>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Path</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="file in upload.flow.files">
                        <td>@{{file.name}}</td>
                        <td>@{{ file.virtualPath }}</td>
                        <td>@{{file.size | bytes }}</td>
                        <td>@{{file.getType()}}</td>
                        <td><progressbar max="100" value="90" type="warning">@{{ file.timeRemaining() }}</progressbar></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>