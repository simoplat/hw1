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
