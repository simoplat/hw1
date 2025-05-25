

<!DOCTYPE html>
<html>

<head>
    <title>hw1</title>
    <link rel="stylesheet" href="user.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="user.js" defer></script>
</head>

<body>
    <div class="container">

        <div class="main-layout">
            <a href="home.php" class="logo-link">
                <img src="Media/home.svg" alt="Logo" class="logo" />
                Torna alla home
            </a>
         
            <div class="central-layout">
                <div class="profile-header">
                    <img src="Media/placeholder.jpg" alt="Copertina" class="cover-photo" />
                    <div class="profile-info">
                        <img src="Media/Portrait_Placeholder.png" alt="Profilo" class="profile-pic" />
                        <div class="user-details">
                            <h2 class="username">
                                <?php
                                    if (isset($_GET['user'])) {
                                        echo htmlspecialchars($_GET['user']);
                                    } else {
                                        echo 'Utente sconosciuto';
                                    }
                                ?>
                            </h2>
                            <p class="user-tag">@<?php
                                    if (isset($_GET['user'])) {
                                        echo htmlspecialchars($_GET['user']);
                                    } else {
                                        echo 'Utente sconosciuto';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div id="profile-content">
                    <!-- <h3>Post recenti</h3>
                    <div class="post">
                        <h4>Titolo post 1</h4>
                        <p>Contenuto del post. Testo di esempio per mostrare il layout.</p>
                    </div>
                    <div class="post">
                        <h4>Titolo post 2</h4>
                        <p>Altro contenuto interessante pubblicato dall’utente.</p>
                    </div> -->
                    
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
                <img id="pic-nav-mobile" src="Media/Portait_Placehoder.png" />
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