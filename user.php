<!DOCTYPE html>
<html>

<head>
    <title>hw1</title>
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="user.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="home.js" defer></script>
    <script src="user.js" defer></script>
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar">
                <div class="nav-left">
                    <button id="button-menu">
                        <img id="menu-img" src="media/menu.svg" />
                    </button>
                    <img id="logoimg" src="media/YouTube-logo.png" />
                </div>

                <div class="nav-center">
                    <form id="search-form">
                        <input type="text" placeholder="Cerca" id="search-bar">
                        <button id="search-button">
                            <img id="search-icon" src="media/search.svg" />
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
                        <img id="notify-pic" src="media/notifications-1.png" />
                    </button>
                    <div class="notify-menu hidden">
                        <h1>Notifiche</h1>
                        <p>Bowser si è iscritto al tuo canale</p>
                        <p>Luigi ha messo mi piace al tuo video</p>
                    </div>
                    <button id="button-profile">
                        <img id="profpic" src="media/Portrait_Placeholder.png" />
                    </button>
                    <div class="personal-menu hidden">
                        <img id="profpic-menu" src="media/Portrait_Placeholder.png" />

                        <?php
                        session_start();
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
                                    <img src="media/home.svg" />
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
                                    <img src="media/video-short.svg" />
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
                                    <img src="media/heart_full.svg" />
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
                                    <img src="media/library.svg" />
                                </div>
                                <div class="sdbar-ins-txt" data-section="Playlist">
                                    <p>Playlist</p>
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
                                    <img src="media/like.svg" />
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
                <div class="profile-header">
                    <img src="Media/placeholder.jpg" alt="Copertina" class="cover-photo" />
                    <div class="profile-info">
                        <img src="Media/Portrait_Placeholder.png" alt="Profilo" class="profile-pic" />
                        <div class="user-details">
                            <h2 class="username">Yosshi</h2>
                            <p class="user-tag">@yosshi123</p>
                        </div>
                    </div>
                </div>

                <div class="profile-content">
                    <h3>Post recenti</h3>
                    <div class="post">
                        <h4>Titolo post 1</h4>
                        <p>Contenuto del post. Testo di esempio per mostrare il layout.</p>
                    </div>
                    <div class="post">
                        <h4>Titolo post 2</h4>
                        <p>Altro contenuto interessante pubblicato dall’utente.</p>
                    </div>
                    <!-- Aggiungi altri post qui -->
                </div>

            </div>

        </div>

        <div class="mobile-navbar">
            <button>
                <img class="svg-white" src="media/home.svg" />
            </button>
            <button id="button-menu-mobile">
                <img class="svg-white" src="media/library.svg" />
            </button>
            <button>
                <img id="pic-nav-mobile" src="media/pf1.jpg" />
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