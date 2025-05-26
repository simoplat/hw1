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

    const authorNameElem = document.querySelector('.author-name');
    const authorUsernameElem = document.querySelector('.author-username');

    
    const cover = document.querySelector('.cover');

    if (!postContent || !titleContainer || !authorNameElem || !authorUsernameElem) {
        console.error('Contenitori mancanti nel DOM');
        return;
    }

    postContent.innerHTML = '';
    titleContainer.innerHTML = '';

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

    // Imposta autore dinamico
    authorNameElem.textContent = `${json.name} ${json.surname}`;
    authorUsernameElem.textContent = `@${json.autore}`;

    // Costruisci il contenuto del post
    const postDiv = document.createElement('div');
    postDiv.classList.add('post');

    // Immagine
    if (json.percorsoMedia) {
        cover.innerHTML = ''; 
        const image = document.createElement('img');
        image.src = json.percorsoMedia;
        image.classList.add('cover-img');
        cover.appendChild(image);
    }

    // Contenuto
    const content = document.createElement('p');
    content.textContent = json.contenuto;

    // Categoria
    if (json.categoria) {
        const category = document.createElement('span');
        category.classList.add('category');
        category.textContent = '#' + json.categoria;
        postDiv.appendChild(category);
    }

    postDiv.appendChild(content);
    postContent.appendChild(postDiv);
}

fetchPost();