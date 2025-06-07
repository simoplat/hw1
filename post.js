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
    const preferitoBtn = document.querySelector('.preferito-btn');
    const preferitoText = preferitoBtn.querySelector('.btn-text');
  

    const heartIcon = document.getElementById('heart-icon');

    if (json?.preferito) {
        preferitoText.textContent = 'Rimuovi dai preferiti';
        preferitoBtn.dataset.set = 'yes';
        if (heartIcon) {
            heartIcon.src = 'Media/heart_full.svg'; 
            heartIcon.alt = 'Rimuovi dai preferiti';
        }
    } else {
        preferitoText.textContent = 'Aggiungi ai preferiti';
        preferitoBtn.dataset.set = 'no';
        if (heartIcon) {
            heartIcon.src = 'Media/heart_empty.svg';
            heartIcon.alt = 'Aggiungi ai preferiti';
        }
    }


    if(preferitoBtn) preferitoBtn.addEventListener('click',togglePreferito);

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
    // Ricrea autore come <a> che reindirizza a user.php
    author.innerHTML = ''; // Pulisci

    const authorLink = document.createElement('a');
    authorLink.href = `user.php?user=${encodeURIComponent(json.autore)}`;
    authorLink.classList.add('author');

    // Immagine profilo
    const profileImage = document.createElement('img');
    profileImage.src = json.immagine_profilo ? json.immagine_profilo : 'Media/Portrait_Placeholder.png';
    profileImage.alt = `Foto profilo di ${json.name}`;
    profileImage.classList.add('author-img');

    // Info autore
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

    // Costruzione finale
    authorLink.appendChild(profileImage);
    authorLink.appendChild(authorInfo);
    author.appendChild(authorLink);


    // Immagine copertina
    const coverImg = document.createElement('img');
    coverImg.alt = 'Immagine copertina post';
    coverImg.classList.add('cover-img');

    const mediaPath = json.percorsoMedia && json.percorsoMedia.trim() !== '' ? json.percorsoMedia : null;

    if (mediaPath) {
        coverImg.src = mediaPath;

        

        cover.appendChild(coverImg);
    }
    // NON mostrare nulla se non c'è immagine


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

const commentSection = document.querySelector('.comments-section');

function aggiornaCommenti() {
    const urlParams = new URLSearchParams(window.location.search);
    const id_post = urlParams.get('id_post');

    if (!id_post) {
        console.error('ID del post mancante nella URL');
        return;
    }
    fetch('fetchCommenti.php?id_post=' + encodeURIComponent(id_post)).
        then(Onresponse).
        then(onJsonCommenti);
}


function onJsonCommenti(json) {
    if (!json) return;

    const oldComments = document.querySelectorAll('.comment');
    for (let i = 0; i < oldComments.length; i++) {
        oldComments[i].remove();
    }

    // Aggiungi commenti
    for (let i = 0; i < json.length; i++) {
        let commento = json[i];

        const commentDiv = document.createElement('div');
        commentDiv.classList.add('comment');

        const p = document.createElement('p');

        const author = document.createElement('a');
        author.classList.add('username');
        author.href = 'user.php?user=' + encodeURIComponent(commento.username);
        author.textContent = '@' + commento.username + ':';

        p.appendChild(author);
        p.append(' ' + commento.testo);

        commentDiv.appendChild(p);
        commentSection.appendChild(commentDiv);
    }
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
    .then(Onresponse)
    .then(responseAggiungiCommento)
}

function togglePreferito() {
    const urlParams = new URLSearchParams(window.location.search);
    const id_post = urlParams.get('id_post');
    console.log('TOGGLE id POST: ' + id_post);

    if (id_post) {
        const formData = new FormData();
        formData.append('id_post', id_post);

        fetch('togglePreferito.php', {
            method: 'POST',
            body: formData
        })
            .then(Onresponse).then(updatePreferitoUI)
    } else {
        console.error("ID post non trovato nell'URL");
    }

}




function updatePreferitoUI(json) {
    console.log('Preferito aggiornato:', json);
    const preferitoBtn = document.querySelector('.preferito-btn');
    const spanPref = document.querySelector('.btn-text');
    const preferitoIcon = document.getElementById('heart-icon');

    console.log('Preferito Button:', preferitoBtn);
    if(!preferitoBtn || !spanPref) {
        console.error('Preferito non trovato nel DOM');
        return;
    }

    if (json.preferito === true) {
        spanPref.textContent = 'Rimuovi dai preferiti';
        preferitoBtn.dataset.set = 'yes';
        preferitoIcon.src = 'Media/heart_full.svg';
    } else if (json.preferito === false) {
        spanPref.textContent = 'Aggiungi ai preferiti';
        preferitoBtn.dataset.set = 'no';
        preferitoIcon.src = 'Media/heart_empty.svg';
    }

}
