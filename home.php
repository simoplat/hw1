<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>hw1</title>
    <link rel="stylesheet" href="home.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="home.js" defer></script>
</head>
  
<body>
    <div class="container">
        <header> 
            <nav class="navbar">
                <div class="nav-left">
                    <button id="button-menu">
                        <img id="menu-img" src="media/menu.svg"/>
                    </button>
                    <img id="logoimg" src="media/YouTube-logo.png"/>
                </div>

                <div class="nav-center">
                   <form id="search-form">
                        <input type="text" placeholder="Cerca" id="search-bar">
                        <button id="search-button">
                            <img id="search-icon" src="media/search.svg"/>
                        </button>
                        <!-- <button id="mic-button">
                            <img id="mic-img" src="media/microphone.png"/>
                        </button> -->
                    </form>
                </div>

                <div class="nav-right">
                    <button>
                        <section>
                            <img id="cross-pic" src="media/cross.svg">
                            Crea                       
                        </section>
                    </button>
                    <button id="notify-button">
                        <img id="notify-pic" src="media/notifications-1.png"/>
                    </button>
                    <div class="notify-menu hidden" >
                        <h1>Notifiche</h1>
                        <p>Bowser si è iscritto al tuo canale</p>
                        <p>Luigi ha messo mi piace al tuo video</p>
                    </div>
                    <button id="button-profile">
                        <img id="profpic" src="media/Portrait_Placeholder.png"/>
                    </button>
                    <div class="personal-menu hidden" >
                        <img id="profpic-menu" src="media/Portrait_Placeholder.png"/>
                        
                            <?php
                            if (isset($_SESSION['_agora_username'])) {
                                echo "<h1> Benvenuto, " . $_SESSION['_agora_username'] . "!</h1>";
                            }
                            ?>

                        <button class="menu-button" data-action="change-picture">
                            <p>Cambia immagine profilo</p>
                        </button>
                        <button class="menu-button" data-action="settings">
                            <p>Impostazioni</p>
                        </button>
                        <button class="menu-button" data-action="preferences">
                            <p>Preferenze account</p>
                        </button>
                        <button class="menu-button" data-action="contact">
                            <a href='logout.php'>Log out</a>
                        </button>
                    </div>
                    
                </div>

            </nav>
             
        </header>
      

        <div class="main-layout">
            <div class="left-sidebar">
                <div class="sidebar-content">
                    <div class="sidebar-h">
                        <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/home.svg"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="home">
                                <p>Home</p>
                                </div>
                            </div>
                        </button>
                    </div>
                    
                    <div class="sidebar-h">
                        <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/video-short.svg"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Shorts">
                                <p>Shorts</p>
                                </div>
                            </div>
                        </button>    
                    </div>
                    
                    <h1 data-type="Tu">
                        <!-- TU   (old)-->
                        Sezione Personale
                        <img data-type="up" class="toggle" src="media/down-arrow.svg">
                    </h1>

                    <div class="sidebar-h" data-type="Tu">
                        <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/heart_full.svg"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Preferiti">
                                <p>Preferiti</p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="sidebar-h" data-type="Tu">
                        <button id="buttonPlaylist">
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/library.svg"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Playlist">
                                <p>Playlist Musicale</p>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- <div class="sidebar-h" data-type="Tu">
                        <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/history.svg"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Cronologia">
                                <p>Cronologia</p>
                                </div>
                            </div>
                        </button>
                    </div> -->
                    <div class="sidebar-h" data-type="Tu">
                        <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/like.svg"/>
                                </div>
                                    <div class="sdbar-ins-txt" data-section="Mi-piace">
                                        <p>Mi piace</p>
                                    </div>
                            </div>
                        </button>
                    </div>
                    <h1 data-type="channel">
                        Le tue iscrizioni
                        <img data-type="up" class="toggle" src="media/down-arrow.svg">

                    </h1>
                    <div class="createChannels">
                        


                    </div>

                        
                    
                </div>
            </div>


            <div class="central-layout">

                <div class="categorie">
                    <nav class="nav-central">
                        <a class="button-link" data-type="all">Tutti</a>
                        <a class="button-link" data-type="games">Giochi</a>
                        <a class="button-link" data-type="Musica">Musica</a>
                        <a class="button-link" data-type="movies">Film</a>
                        <a class="button-link" data-type="sports">Sport</a>
                        <a class="button-link" data-type="recent-uploads">Caricamenti recenti</a>
                        <a class="button-link" data-type="news">Notizie</a>
                    </nav>
                </div>
                
                <div class="video-layout">
                            <div class="video-content">
                                <div class="video-thumbnail">
                                    <img src="Media/placeholder.jpg"/>
                                </div>
                                <div class="video-info">
                                    <img src="Media/Portrait_Placeholder.png"/>
                                    <div class="video-info-channel">
                                        <h1>Viaggio a New York: cosa vedere e consigli utili per conoscere la città</h1>
                                        <p>CHANNEL</p>
                                    </div>
                                </div>
                            </div>
                            <div class="video-content">
                                <div class="video-thumbnail">
                                    <img src="Media/placeholder.jpeg"/>
                                </div>
                                <div class="video-info">
                                    <img src="pf1.jpg"/>
                                    <div class="video-info-channel">
                                        <h1>Intelligenza artificale: risorsa o rischio?</h1>
                                        <p>CHANNEL</p>
                                    </div>
                                </div>
                            </div>
                            <div class="video-content">
                                <div class="video-thumbnail">
                                    <img src="Media/placeholder.jpg"/>
                                </div>
                                <div class="video-info">
                                    <img src="pf1.jpg"/>
                                    <div class="video-info-channel">
                                        <h1>Film da guardare al cinema</h1>
                                        <p>CHANNEL</p>
                                    </div>
                                </div>
                            </div>
                            <div class="video-content">
                                <div class="video-thumbnail">
                                    <img src="videogame.jpg"/>
                                </div>
                                <div class="video-info">
                                    <img src="pf3.jpg"/>
                                    <div class="video-info-channel">
                                        <h1>Gaming nuove uscite</h1>
                                        <p>CHANNEL</p>
                                    </div>
                                </div>
                            </div>
                            <div class="video-content">
                                <div class="video-thumbnail">
                                    <img src="concerto.jpg"/>
                                </div>
                                <div class="video-info">
                                    <img src="pf1.jpg"/>
                                    <div class="video-info-channel">
                                        <h1>Concerti estivi 2025</h1>
                                        <p>CHANNEL</p>
                                    </div>
                                </div>
                            </div>                            
                </div>

            </div>

        </div>

        <div class="mobile-navbar">
            <button>
                <img class="svg-white" src="media/home.svg"/>
            </button>
                <button id="button-menu-mobile">
                    <img class="svg-white" src="media/library.svg"/>
                </button>
            <button>
                <img id="pic-nav-mobile" src="media/pf1.jpg"/>
            </button>
        </div>

        <footer>
            <div class="footer-container">
                <div class="footer-links">
                    <a href="#">Informazioni</a>
                    <a href="#">Privacy</a>
                    <a href="#">Termini</a>
                    <a href="#">Contatti</a>
                </div>
            </div>
            <p class="footer-copyright">© 2025 Simone Platania. Tutti i diritti riservati.</p>
        </footer>
    </div>

</body>

</html>