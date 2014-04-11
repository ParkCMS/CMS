<!DOCTYPE html>
<html lang="en">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <pcms-styles />
        <link rel="stylesheet" type="text/css" href="{{ theme_path('css/scrollbar.css') }}">

    	<title>BEAULI &mdash; {{ $page->title }}</title>
	</head>
	<body>
        <div class="container">
            <div class="col-md-4">
                <div class="left-box logo">
                        <h1><a href="{{ url(current_lang()) }}">BEAULI</a></h1>
                </div>
                <div class="left-box treatment visible-md visible-lg">
                    <span class="header">BEAULI</span>
                    <table>
                        <tr>
                            <td>
                                <a href="{{ url(current_lang() . '/about') }}">
                                    <img src="{{ theme_path('images/shortcuts/about.png') }}" alt="face">
                                </a>
                            </td>
                            <td>
                                <a href="{{ url(current_lang() . '/workshop') }}">
                                    <img src="{{ theme_path('images/shortcuts/workshop2.png') }}" alt="breast">
                                </a>
                            </td>
                            <td>
                                <a href="{{ url(current_lang() . '/legal') }}">
                                    <img src="{{ theme_path('images/shortcuts/legal.png') }}" alt="body">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ url(current_lang() . '/about') }}">{{Lang::get('theme::layout.about')}}</a>
                            </td>
                            <td>
                                <a href="{{ url(current_lang() . '/workshop') }}">{{Lang::get('theme::layout.workshop')}}</a>
                            </td>
                            <td>
                                <a href="{{ url(current_lang() . '/legal') }}">{{Lang::get('theme::layout.legal')}}</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="left-box contact">
                    <span class="header">{{Lang::get('theme::layout.contact')}}</span>
                    <p class="phone">
                        <span style="white-space: nowrap;">Telefon: 03303-5134000-0</span>&nbsp;&nbsp;-&nbsp;&nbsp;<span style="white-space: nowrap;">Fax: 03303-5134000-90</span>
                    </p>
                    <table>
                        <tr>
                            <td>
                                <a href="https://www.terminland.de/birkenwerder/" target="_blank">
                                    <img src="{{ theme_path('images/contact/appointment.png') }}" alt="appointment">
                                </a>
                            </td>
                            <td>
                                <a href="{{ url(current_lang() . '/contact') }}">
                                    <img src="{{ theme_path('images/contact/mail.png') }}" alt="mail">
                                </a>
                            </td>
                            <td>
                                <a href="https://www.facebook.com/parkklinikbirkenwerder" target="_blank">
                                    <img src="{{ theme_path('images/contact/FB-f-Logo__white_1024.png') }}" alt="facebook">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://www.terminland.de/birkenwerder/" target="_blank">{{Lang::get('theme::layout.appointment')}}</a>
                            </td>
                            <td>
                                <a href="{{ url(current_lang() . '/contact') }}">{{Lang::get('theme::layout.contact')}}</a>
                            </td>
                            <td>
                                <a href="https://www.facebook.com/parkklinikbirkenwerder" target="_blank">Facebook</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="left-box news visible-md visible-lg" style="height: 350px;">
                    <span class="header">{{Lang::get('theme::layout.news')}}</span>
                    <div class="shoutbox" pcms-program="shoutbox" pcms-shoutbox="global-news">
                        <h3>1. AMEC DACH - Anti-Aging Medicine European Congress</h3>
                        <p>Am 20. und 21. Juni 2014 findet in Berlin der 1. AMEC statt.</p>
                        <a href="#">Hier finden Sie weitere Informationen und Registrierungs möglichkeiten</a>

                        <h3>Pressemitteilung-Focus</h3>
                        <p>
                            FOCUS präsentiert Deutschlands Top-Mediziner
                            2013 - Park-Klinik Birkenwerder erhielt gleich
                            zwei Urkunden... <a href="#">Zum ganzen Artikel</a>
                        </p>

                        <h3>Berlin-Grunewald ergänzt jetzt unser Angebot.</h3>
                        <p>Weitere Informationen zur Klinik, zu den Operationen und.... <a href="#">Zum ganzen Artikel</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="nav-container navbar">
                    <span>
                        <a class="{{ (current_lang() == 'de') ? 'lang-active': ''}}" href="{{ url('de') }}">DE</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="{{ (current_lang() == 'en') ? 'lang-active': ''}}" href="{{ url('en') }}">EN</a>
                    </span>
                    <a type="button" data-toggle="menu-toggle">
                        Menu
                        <span class="caret"></span>
                    </a>
                    <div class="main-navigation" role="navigation" pcms-program="nav" pcms-nav="menu" pcms-nav-class="menu nav"></div>
                </div>
                <div class="content-container">
        		  @section('body')
        		      <h1>Body</h1>
        		  @show
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="col-md-offset-4 col-md-8"><!-- pcms-program="text" pcms-text="global-footer"-->
                    <a href="{{ url(current_lang() . '/legal') }}">Impressum</a>
                </div>
            </div>
        </footer>

        <pcms-scripts />
        <script type="text/javascript" src="{{ theme_path('js/main.js') }}"></script>

        <script type="text/javascript">

        $(function() {
            $('.left-box.locations ul li').hoverIntent(function() {
                var $this = $(this);
                var $maps = $this.parent().parent().prev().find('.item');
                
                $maps.hide();
                $($maps[$(this).index()]).show();
            }, function() {});

            $('[data-toggle="slide"]').on('click', function(event) {
                event.preventDefault();

                var $this = $(this);
                var $menu = $this.parent().find('> .slide-menu');

                console.log(this);
                console.log($menu);

                $menu.slideToggle();
            });
        });

        </script>
	</body>
</html>