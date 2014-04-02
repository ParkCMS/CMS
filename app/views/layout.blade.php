<!DOCTYPE html>
<html lang="en">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <pcms-styles />
        
    	<title>ParkCMS</title>
	</head>
	<body>
        <div class="container">
            <div class="col-md-3">
                <div class="left-box" style="height: 75px; color: white;">
                    <span class="header">Logo</span>
                </div>
                <div class="left-box visible-md visible-lg" style="height: 150px;">
                    <span class="header">Behandlung</span>
                </div>
                <div class="left-box locations" style="height: 200px;">
                    <span class="header">Unsere Standorte</span>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="maps">
                                <div class="item"></div>
                                <div class="item"></div>
                                <div class="item"></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <ul class="links">
                                <li>Park-Klinik Birkenwerder</li>
                                <li>Berlin Mitte Praxis</li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="left-box visible-md visible-lg" style="height: 150px;">
                    <span class="header">Kontakt</span>
                </div>
                <div class="left-box visible-md visible-lg" style="height: 350px;">
                    <span class="header">Aktuelles</span>
                </div>
                <div class="left-box visible-md visible-lg" style="height: 150px;">
                    <span class="header">Team</span>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-container navbar">
                    <a type="button" data-toggle="menu-toggle">
                        Dropdown
                        <span class="caret"></span>
                    </a>
                    <div class="main-navigation" role="navigation" pcms-nav="menu" pcms-nav-class="menu nav"></div>
                    <!--
                    <div class="main-navigation" role="navigation">
                        <div class="col-md-4">
                            adsf
                        </div>
                        <div class="col-md-4">
                            qwer
                        </div>
                        <div class="col-md-4">
                            yxcv
                        </div>
                    </div>
                    -->
                </div>
        		@section('body')
        		  <h1>Body</h1>
        		@show
            </div>
        </div>

        <div class="rating" itemscope="itemscope" itemtype="http://schema.org/LocalBusiness">
            <span itemprop="name">ParkCMS</span>
            <div itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating">        
                <div class="num">
                    <span class="rating" itemprop="ratingValue">4,9</span>
                </div>
                <div class="num">
                    <span class="count" itemprop="reviewCount">
                        65
                    </span>
                </div>
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