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
    const username = urlParams.get('user'); 

    let url = 'fetchChannelContent.php';
    if (username) {
        url += '?user=' + encodeURIComponent(username);
    }

    fetch(url)
        .then(Onresponse)
        .then(onJson);
}


function renderPost(post, container) {
    let postDiv = document.createElement('div');
    postDiv.classList.add('post');

    let titleLink = document.createElement('a');
    titleLink.textContent = post.title;
    titleLink.href = getPostUrl(post.id_post);
    titleLink.setAttribute('data-id', post.id_post);

    let title = document.createElement('h4');
    title.appendChild(titleLink);

    let content = document.createElement('p');
    content.textContent = post.contenuto;

    postDiv.appendChild(title);
    postDiv.appendChild(content);
    container.appendChild(postDiv);
}

function onJson(json) {
    let profileContent = document.getElementById('profile-content');
    profileContent.innerHTML = '';

    if (json.profilo && json.profilo.name && json.profilo.surname) {
        let userDetails = document.querySelector('.user-details');
        userDetails.innerHTML = '';

        let nameElem = document.createElement('h2');
        nameElem.id = 'username';
        nameElem.textContent = json.profilo.name + ' ' + json.profilo.surname;

        let usernameElem = document.createElement('p');
        usernameElem.id = 'user-tag';
        if (json.profilo.username) {
            usernameElem.textContent = '@' + json.profilo.username;
        } else {
            usernameElem.textContent = '@utente_sconosciuto';
        }

        userDetails.appendChild(nameElem);
        userDetails.appendChild(usernameElem);
    }

    let heading = document.createElement('h3');
    heading.textContent = 'Post recenti';
    profileContent.appendChild(heading);

    let profPic = document.getElementById('profile-pic-id');
    if (profPic && json.profilo) {
        profPic.classList.add('profile-pic');
        profPic.src = json.profilo.immagine_profilo;
        profPic.setAttribute('data-type', 'SET');
    }

    let coverPhoto = document.getElementById('cover-photo-id');
    if (coverPhoto && json.profilo) {
        coverPhoto.classList.add('cover-photo');
        coverPhoto.src = json.profilo.immagine_copertina;
        coverPhoto.setAttribute('data-type', 'SET');
    }

    if (!json.post || json.post.length === 0) {
        let noPosts = document.createElement('p');
        noPosts.textContent = 'Nessun post trovato.';
        profileContent.appendChild(noPosts);
        return;
    }

    for (let i = 0; i < json.post.length; i++) {
        renderPost(json.post[i], profileContent);
    }
}

fetchChannelContent();

const iscrivitiBtn = document.querySelector('.btn-iscrizione');
if (iscrivitiBtn) {
    iscrivitiBtn.addEventListener('click', toggleIscritto);
}

function toggleIscritto() {
    const urlParams = new URLSearchParams(window.location.search);
    const user_channel = urlParams.get('user');
    console.log('TOGGLE id canale: ' + user_channel);

    if (user_channel) {
        const formData = new FormData();
        formData.append('user', user_channel);

        fetch('toggleIscritto.php', {
            method: 'POST',
            body: formData
        })
            .then(Onresponse).then(updateIscrittoUI)
    } else {
        console.error("ID post non trovato nell'URL");
    }

}


function updateIscrittoUI(json) {
    const iscrivitiTxt = document.querySelector('.btn-text');
    if(iscrivitiBtn){

        if(json.iscritto) {
            iscrivitiBtn.setAttribute('data-set', 'yes');
            iscrivitiTxt.textContent = 'Disiscriviti dal canale';
            
        } else if(json.iscritto === false) {
            iscrivitiBtn.setAttribute('data-set', 'no');
            iscrivitiTxt.textContent = 'Iscriviti al canale';
        }

    }

}

checkIscritto();

function checkIscritto() {
    const urlParams = new URLSearchParams(window.location.search);
    const user_channel = urlParams.get('user');
    const formData = new FormData();
    console.log('CHECK id canale: ' + user_channel);
    formData.append('user', user_channel);
    fetch('check_channel.php', {
        method: 'POST',
        body: formData
    }).then(Onresponse).then(handleIscritto);
}




function handleIscritto(json) {
    if (json === true || json.iscritto === true) {
        console.log("Iscritto? true");
        const iscTxt = document.getElementById('isc-text');
        if (iscTxt) {
            iscTxt.textContent = 'Disiscriviti dal canale';
            iscrivitiBtn.setAttribute('data-set', 'yes');
        }
    } else if (json === false || json.iscritto === false) {
        console.log("Iscritto? false");
        const iscTxt = document.getElementById('isc-text');
        if (iscTxt) {
            iscTxt.textContent = 'Iscriviti al canale';
            iscrivitiBtn.setAttribute('data-set', 'no');
        }
    } else if (json === 'TeStesso' || json.iscritto === 'TeStesso') {
        console.log("Non puoi iscriverti al tuo stesso canale");
        iscrivitiBtn.classList.add('hidden');
    }
}