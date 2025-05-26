<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Post</title>
    <link rel="stylesheet" href="post.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <script src="post.js" defer></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="top-navbar">
        <div class="nav-content">
            <a href="home.php" class="logo-link">
                <img src="Media/home.svg" alt="Home" class="logo-icon" />
                Torna alla home
            </a>
        </div>
    </nav>

    <div class="blog-container">
        <!-- Titolo sopra la copertina -->
        <div class="header-title">
            <h1 class="post-title">Titolo del Post del Blog</h1>
        </div>

        <!-- Copertina -->
        <header class="cover">
            <img src="Media/placeholder.jpg" alt="Copertina" class="cover-img" />
        </header>

        <!-- Autore -->
        <section class="author">
            <img src="media/Portrait_Placeholder.png" alt="Autore" class="author-img" />
            <div class="author-info">
                <p class="author-name">Simone Platania</p>
                <p class="author-username">@simone_pl</p>
            </div>
        </section>

        <!-- Contenuto del post -->
        <main id="post-content" class="post-content">
            <p>
                Benvenuti nel mio blog! Questo è un post di esempio dove parlo di cose interessanti. Il layout è stato
                pensato per essere leggibile, moderno e facilmente navigabile da dispositivi mobili e desktop.
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non sapien libero. Duis eget nisl arcu.
                Curabitur euismod ultrices lacus, in bibendum erat facilisis ut.
            </p>
            <p>
                Grazie per aver letto. Lascia un commento qui sotto!
            </p>
        </main>

        <section class="comments-section">
            <h2>Commenti</h2>

            <!-- Form per inviare il commento -->
            <form class="comment-box" action="salva-commento.php" method="post">
                <textarea name="commento" placeholder="Scrivi un commento..." required></textarea>
                <button type="submit">Invia</button>
            </form>

            <!-- Commenti statici di esempio -->
            <div class="comment">
                <p><span class="username">@utente123:</span> Ottimo articolo, complimenti!</p>
            </div>
            <div class="comment">
                <p><span class="username">@mario.rossi:</span> Interessante, aspetto altri post!</p>
            </div>
        </section>


        <!-- Footer -->
        <footer class="footer">
            <p>© 2025 Simone Platania. Tutti i diritti riservati.</p>
        </footer>
    </div>
</body>

</html>