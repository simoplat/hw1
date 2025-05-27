function fetchPost() {
    const urlParams = new URLSearchParams(window.location.search);
    const id_post = urlParams.get('id_post');

    if (!id_post) {
        console.error('ID del post mancante nella URL');
        return;
    }

    fetch('fetchPost.php?id_post=' + encodeURIComponent(id_post))
        .then(Onresponse)
        .then(onJson);
}

function Onresponse(response) {
    console.log('Response received');
    if (!response.ok) return null;
    return response.json();
}

function onJson(json) {
    const postContent = document.getElementById('post-content');
    const titleContainer = document.querySelector('.header-title');
    const author = document.querySelector('.author');
    const authorNameElem = document.querySelector('.author-name');
    const authorUsernameElem = document.querySelector('.author-username');
    const cover = document.querySelector('.cover');

    if (!postContent || !titleContainer || !authorNameElem || !authorUsernameElem || !author) {
        console.error('Contenitori mancanti nel DOM');
        return;
    }

    // Pulisci contenuti esistenti
    postContent.innerHTML = '';
    titleContainer.innerHTML = '';
    cover.innerHTML = '';

    if (!json || json.error) {
        const h1 = document.createElement('h1');
        h1.textContent = 'Nessun post';
        titleContainer.appendChild(h1);
        return;
    }

    // Titolo in alto
    const postTitle = document.createElement('h1');
    postTitle.classList.add('post-title');
    postTitle.textContent = json.title;
    titleContainer.appendChild(postTitle);

    // Aggiorna immagine profilo autore
    author.innerHTML = ''; // Pulisci tutto l'autore per ricostruire correttamente
    const profileImage = document.createElement('img');
    if (json.immagine_profilo) {
        profileImage.src = json.immagine_profilo;
    } else {
        profileImage.src = 'Media/Portrait_Placeholder.png';
    }
    profileImage.alt = `Foto profilo di ${json.name}`;
    profileImage.classList.add('author-img');
    author.appendChild(profileImage);

    // Ricrea la sezione info autore
    const authorInfo = document.createElement('div');
    authorInfo.classList.add('author-info');

    const authorName = document.createElement('p');
    authorName.classList.add('author-name');
    authorName.textContent = `${json.name} ${json.surname}`;

    const authorUsername = document.createElement('p');
    authorUsername.classList.add('author-username');
    authorUsername.textContent = `@${json.autore}`;

    authorInfo.appendChild(authorName);
    authorInfo.appendChild(authorUsername);
    author.appendChild(authorInfo);

    // Immagine copertina
    if (json.percorsoMedia) {
        const coverImg = document.createElement('img');
        coverImg.src = json.percorsoMedia;
        coverImg.alt = 'Immagine copertina post';
        coverImg.classList.add('cover-img');
        cover.appendChild(coverImg);
    }

    // Contenuto del post
    const postDiv = document.createElement('div');
    postDiv.classList.add('post');

    if (json.categoria) {
        const category = document.createElement('span');
        category.classList.add('category');
        category.textContent = '#' + json.categoria;
        postDiv.appendChild(category);
    }

    const content = document.createElement('p');
    content.textContent = json.contenuto;
    postDiv.appendChild(content);

    postContent.appendChild(postDiv);
}


fetchPost();
aggiornaCommenti();

const commentForm = document.getElementById('comment-form');
commentForm.addEventListener('submit', handleCommentSubmit);


function aggiornaCommenti(){
    const commentSection = document.querySelector('.comments-section');

    
}



function responseAggiungiCommento(response) {
    if (!response) return;
    console.log('Response received for comment:', response);
    if (commentForm) commentForm.reset();
    aggiornaCommenti();
}


function handleCommentSubmit(event) {
    event.preventDefault();

    const formData = new FormData(commentForm);

    // Prendi id_post dall'URL
    const params = new URLSearchParams(window.location.search);
    const postId = params.get('id_post');

    if (postId) {
        formData.append('id_post', postId);

        inviaCommento(formData);
    } else {
        console.error("ID post non trovato nell'URL");
    }
}

function inviaCommento(formData) {
    fetch('aggiungiCommento.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(responseAggiungiCommento)
    .catch(error => console.error('Errore:', error));
}


;