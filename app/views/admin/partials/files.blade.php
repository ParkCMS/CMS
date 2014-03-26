<div class="row toolbar">
    <div class="col-md-2">
        <div class="btn-group">
            <!-- <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-cog"></span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Upload</a></li>
                    <li class="divider"></li>
                    <li><a ng-click="cd('/folder1/subfolder')">New Directory</a></li>
                    <li><a href="#">Archive</a></li>
                </ul>
            </div> -->

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
    <div class="col-md-8 filelist">
        <div class="row">
            <div class="col-sm-6 col-md-4 file" ng-repeat="file in files">
                <div class="thumbnail" ng-if="file.isDir" ng-click="cd(file.path)">
                    <p>
                        <i style="font-size: 780%" class="glyphicon glyphicon-folder-open"></i>
                    </p>
                    <p>@{{ file.filename }}</p>
                </div>
                <div class="thumbnail" ng-if="file.isFile" ng-click="preview(file)">
                    <p>
                        <i style="font-size: 780%" class="glyphicon glyphicon-picture"></i>
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