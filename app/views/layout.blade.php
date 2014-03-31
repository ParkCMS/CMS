<!DOCTYPE html>
<html lang="en">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <pcms-styles />
        
    	<title>ParkCMS</title>
	</head>
	<body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" pcms-nav="main" pcms-nav-class="nav navbar-nav">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="active"><a href="#">Action</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Admin</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="col-sm-3">
                <div style="background-color: #526486; height: 75px; color: white;">
                    <h5>Logo</h5>
                </div>
                <div style="background-color: #526486; height: 150px; color: white;">
                    <h5>Behandlung</h5>
                </div>
                <div style="background-color: #526486; height: 200px; color: white;">
                    <h5>Standorte</h5>
                </div>
                <div style="background-color: #526486; height: 150px; color: white;">
                    <h5>Kontakt</h5>
                </div>
                <div style="background-color: #526486; height: 350px; color: white;">
                    <h5>Aktuelles</h5>
                </div>
                <div style="background-color: #526486; height: 150px; color: white;">
                    <h5>Team</h5>
                </div>
            </div>
            <div class="col-sm-9">
        		@section('body')
        		  <h1>Body</h1>
        		@show
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div pcms-text="global-footer">
                    Footer...
                </div>
            </div>
        </footer>

        <pcms-scripts />
	</body>
</html>