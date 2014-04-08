<!DOCTYPE html>
<html lang="en">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <pcms-styles />

    	<title>ParkCMS</title>
	</head>
	<body>
        <div class="container">
            <div class="col-md-12">
                <div class="nav-container navbar">
                    <a type="button" data-toggle="menu-toggle">
                        Menu
                        <span class="caret"></span>
                    </a>
                    <div class="main-navigation" role="navigation" pcms-program="nav" pcms-nav="menu" pcms-nav-class="menu nav"></div>
                </div>
        		@section('body')
        		  <h1>Body</h1>
        		@show
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div pcms-program="text" pcms-text="global-footer">
                    Footer...
                </div>
            </div>
        </footer>

        <pcms-scripts />
	</body>
</html>