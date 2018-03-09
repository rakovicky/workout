<html>

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="js/jquery-2.2.0.min.js"></script>

    <script src="js/dropdown.js"></script>

    <title>Street-workout</title>

    <meta name="viewport" content="width=device-width,initial-scale=1">

</head>

<body>

    <div class='all'>

        <div id="header">

            <div class="nav"> 

                <div class="logo">

                    <a href="index.php"><img src="img/WSWCF-logo3.png"></a>

                </div>

                <div class='menu'>

                    <ul>

                        <li><a href="index.php?page=o_nas">O NÁS</a></li>

                        <li><a href="index.php?page=galeria">GALÉRIA</a></li>

                        <li><a href="index.php?page=typy_a_triky">TYPY A TRIKY</a></li>

                        <li><a href="index.php?page=nase_miesta">NAŠE MIESTA</a></li>

                                <li class="non-border">|</li>

                                <div class="dropdown">

                                    <li onclick="myFunction()" class="dropbtn">Administrácia</li>

                                    <div id="myDropdown" class="dropdown-content">

                                        <a href="index.php?page=typy_a_triky">Upraviť články</a>

                                        <a href="index.php?page=add_article">Pridať článok</a>

                                        <a href="index.php?page=users">Správa uživateľov</a>

                                    </div>

                                </div>

                            <li class="non-border">|</li>

                        <li><a href="index.php?page=login/login">Prihlásenie</a></li>

                    </ul>

                </div>

                <script>

                    jQuery(document).ready(function($) {

                        $("#menu-icon").bind('click', function(event) {

                            $(".menu-responsive").toggle(400);

                        });

                    });

                </script>

                <div class="menu-icon" id="menu-icon"><img src="img/menu.png" alt=""></div>

           </div>

        </div>

        <div class="login">

            <div class="login_wrap">

            </div>

        </div>

        <div class="menu-responsive">

            <ul id="menu-responsive">

                <li><a href="index.php?page=o_nas">O NÁS</a></li>

                <li><a href="index.php?page=galeria">GALÉRIA</a></li>

                <li><a href="index.php?page=typy_a_triky">TYPY A TRIKY</a></li>

                <li><a href="index.php?page=nase_miesta">NAŠE MIESTA</a></li>

                        <li><a href="index.php?page=typy_a_triky">Upraviť články</a></li>

                        <li><a href="index.php?page=add_article">Pridať článok</a></li>

                        <li><a href="index.php?page=users">Správa uživateľov</a></li>

                <li><a href="index.php?page=login/login">PRIHLÁSENIE</a></li>

            </ul>

        </div>

        <div id="wrap_index">   

                <div class="container">

                    <div class="column column-one novinky">

                        <div class="novinky_main">Novinky<hr /></div>

                        <div class="novinky_back">

                        </div>

                    </div>

                    <div class="column column-two najnovsie_fotky">

                        <div class="najnovsie_main">Najnovšie fotky<hr /></div>

                        <img src="img/ac/1.jpg">

                        <img src="img/ac/5.jpg">

                        <img src="img/ac/3.jpg">

                    </div>

                    <div class="column column-three pocasie">

                    </div><!-- .pocasie -->

                    <div class="ankety">
                        <div class="btn"> <button>Zobraziť ankety</button> </div>

                        <script>

                            $(document).ready(function(){

                                $('.poc').hide();

                                $("button").click(function(){

                                    $(".poc").toggle(400).promise().done(function() {

                                        /*$("#footer").css({

                                            bottom: 0,

                                            position: 'absolute',

                                            marginTop: '40px'

                                        });*/

                                    });

                                });

                            }); 

                        </script>

                        <div class="poc">

                        </div>

                    
                    </div> <!-- .ankety -->
                </div><!-- .container -->

            </div> <!-- .wrap-index -->

            <div style="clear: both; display: block; height: 120px"></div>

        </div>

            <div id="wrap">   

             </div>

        <div id="footer">

                    © 2016 street-workout.sk | Všetky práva vyhradené

        </div>

</body>

</html>

