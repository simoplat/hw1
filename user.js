function Onresponse(response) {
    console.log('Response received');
    if (!response.ok) return null;
    return response.json();
}

function getPostUrl(id_post) {
    return 'post.php?id_post=' + encodeURIComponent(id_post);
}

function fetchChannelContent() {
    const urlParams = new URLSearchParams(window.location.search);
    const username = urlParams.get('user'); // es: 'yosshi123'

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

if (json.profilo && json.profilo.name && json.profilo.surname) {
    const userDetails = document.querySelector('.user-details');

    userDetails.innerHTML = '';

    const nameElem = document.createElement('h2');
    nameElem.id = 'username';
    nameElem.textContent = json.profilo.name + ' ' + json.profilo.surname;

    const usernameElem = document.createElement('p');
    usernameElem.id = 'user-tag';
    if (json.profilo.username) {
        usernameElem.textContent = '@' + json.profilo.username;
    } else {
        usernameElem.textContent = '@utente_sconosciuto';
    }

    userDetails.appendChild(nameElem);
    userDetails.appendChild(usernameElem);
}





    const heading = document.createElement('h3');
    heading.textContent = 'Post recenti';
    profileContent.appendChild(heading);

    // Imposta immagini profilo/copertina
    const profPic = document.getElementById('profile-pic-id');
    if (profPic && json.profilo) {
        profPic.classList.add('profile-pic');
        profPic.src = json.profilo.immagine_profilo
        profPic.setAttribute('data-type', 'SET');
    }

    const coverPhoto = document.getElementById('cover-photo-id');
    if (coverPhoto && json.profilo) {
        coverPhoto.classList.add('cover-photo');
        coverPhoto.src = json.profilo.immagine_copertina
        coverPhoto.setAttribute('data-type', 'SET');
    }

    // Mostra i post
    if (!json.post || json.post.length === 0) {
        const noPosts = document.createElement('p');
        noPosts.textContent = 'Nessun post trovato.';
        profileContent.appendChild(noPosts);
        return;
    }

    json.post.forEach(post => {
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
