function Onresponse(response) {
    console.log('Response received');
    if (!response.ok) return null;
    return response.json();
}

function getPostUrl(id_post) {
    return 'post.php?id_post=' + encodeURIComponent(id_post);
}

function fetchChannelContent() {
    // Prendi il valore dell'utente dalla query string
    const urlParams = new URLSearchParams(window.location.search);
    const username = urlParams.get('user'); // es: 'yosshi123'

    // Costruisci la richiesta con il parametro
    let url = 'fetchChannelContent.php';
    if (username) {
        url += '?user=' + encodeURIComponent(username);
    }

    fetch(url)
        .then(Onresponse)
        .then(onJson);
}


function onJson(json) {
    const profileContent = document.getElementById('profile-content');
    profileContent.innerHTML = '';

    const heading = document.createElement('h3');
    heading.textContent = 'Post recenti';
    profileContent.appendChild(heading);

    if (!json || json.length === 0) {
        const noPosts = document.createElement('p');
        noPosts.textContent = 'Nessun post trovato.';
        profileContent.appendChild(noPosts);
        return;
    }

    const profPic = document.getElementById('profile-pic');
if (profPic && json.length > 0 && profPic.getAttribute('data-type') !== 'SET') {
    profPic.classList.add('profile-pic');
    profPic.src = json[0].immagine_profilo
    profPic.setAttribute('data-type', 'SET');
}

const profPicBackground = document.getElementById('cover-photo');
if (profPicBackground && json.length > 0 && profPicBackground.getAttribute('data-type') !== 'SET') {
    profPicBackground.classList.add('cover-photo');
    profPicBackground.src = json[0].immagine_copertina 
    profPicBackground.setAttribute('data-type', 'SET');
}




    json.forEach(post => {

        const postDiv = document.createElement('div');
        postDiv.classList.add('post');

        const titleLink = document.createElement('a');
        titleLink.textContent = post.title;
        titleLink.href = getPostUrl(post.id_post);
        titleLink.setAttribute('data-id', post.id_post);

        const title = document.createElement('h4');
        title.appendChild(titleLink);

        const content = document.createElement('p');
        content.textContent = post.contenuto;

        postDiv.appendChild(title);
        postDiv.appendChild(content);
        profileContent.appendChild(postDiv);
    });
}

fetchChannelContent();
