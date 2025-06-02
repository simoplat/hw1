<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

  <?php 
    // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT u.username, i.immagine_profilo
    FROM users u
    left JOIN immaginiutente i ON u.id=i.id_utente 
    WHERE id = $userid;";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);
    $username = $userinfo['username'];
    $profile_picture = $userinfo['immagine_profilo'];
    if (!$profile_picture) {
        $profile_picture = 'media/Portrait_Placeholder.png'; // Immagine di default se non è stata caricata
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
                        <input type="text" name="q" placeholder="Cerca" id="search-bar" required>
                        <button type="submit" id="search-button">
                            <img id="search-icon" src="media/search.svg" alt="Cerca"/>
                        </button>
                    </form>

                </div>

                <div class="nav-right">
                    <!-- <button>
                        <section>
                            <img id="cross-pic" src="media/cross.svg">
                            Crea                       
                        </section>
                    </button> -->
                    <button id="notify-button">
                        <img id="notify-pic" src="media/notifications-1.png"/>
                    </button>
                    <div class="notify-menu hidden"  id="notify-btn">
                        <h1>Notifiche</h1>
                    </div>
                    <button id="button-profile">
                        <img id="profpic" src="<?php echo htmlspecialchars($profile_picture); ?>" />
                    </button>
                    <div class="personal-menu hidden" >
                        <img id="profpic-menu" src="<?php echo htmlspecialchars($profile_picture); ?>" />
                            <h1> Benvenuto <?php echo $username; ?></h1>
                        <!-- <button class="menu-button" data-action="change-picture">
                            <p>Cambia immagine profilo</p>
                        </button>
                        <button class="menu-button" data-action="settings">
                            <p>Impostazioni</p>
                        </button> -->
                        <button class="menu-button" data-action="preferences">
                            <a href="user.php?user=<?php echo urlencode($username); ?>">Il tuo account</a>
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
                        <button id="button-home">
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
                    
                    <!-- <div class="sidebar-h">
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
                    </div> -->
                    
                    <h1 data-type="Tu">
                        <!-- TU   (old)-->
                        Sezione Personale
                        <img data-type="up" class="toggle" src="media/down-arrow.svg">
                    </h1>

                    <div class="sidebar-h" data-type="Tu">
                        <button id="buttonPreferiti">
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
                        <!-- <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/like.svg"/>
                                </div>
                                    <div class="sdbar-ins-txt" data-section="Mi-piace">
                                        <p>Mi piace</p>
                                    </div>
                            </div>
                        </button> -->
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
                        
                    <!-- contenuto dinamico -->
                    </nav>
                </div>
                
                <div class="video-layout">
                            <!-- conteunuto dinamico -->
                                                       
                </div>

            </div>

        </div>

        <div class="mobile-navbar">
            <button id="button-home-mobile">
                    <img class="svg-white" src="media/home.svg"/>
            </button>
                <button id="button-menu-mobile">
                    <img class="svg-white" src="media/library.svg"/>
                </button>
            <button id="button-profile-mobile">
                <img id="pic-nav-mobile" src="<?php echo htmlspecialchars($profile_picture); ?>" />
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