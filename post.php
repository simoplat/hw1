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

            <!-- contenuto del post -->

        </main>

        <button id="preferito-btn" data-set="NO">
            Preferito
            <img src="Media/heart_full.svg" alt="Preferito" class="icon" />
        </button>


        <section class="comments-section">
            <h2>Commenti</h2>

            <!-- Form per inviare il commento -->
            <form id="comment-form" class="comment-box" method="post">
                <textarea name="commento" placeholder="Scrivi un commento..." required></textarea>
                <button type="submit">Invia</button>
            </form>

            <!-- Commenti statici di esempio -->
           
        </section>


        <!-- Footer -->
        <footer class="footer">
            <p>© 2025 Simone Platania. Tutti i diritti riservati.</p>
        </footer>
    </div>
</body>

</html>