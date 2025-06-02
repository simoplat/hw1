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
            .then(response => response.json()).then(updateIscrittoUI)
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
    })
        .then(res => res.text())
        .then(text => {
            if (text === 'true') {
                console.log("Iscritto? true");
                const iscTxt = document.getElementById('isc-text');
                if (iscTxt) {
                    iscTxt.textContent = 'Disiscriviti dal canale';
                    iscrivitiBtn.setAttribute('data-set', 'yes');
                }
            } else if (text === 'false') {
                console.log("Iscritto? false");
                // 
            }
            else if( text === 'TeStesso') {
                console.log("Non puoi iscriverti al tuo stesso canale");
                iscrivitiBtn.classList.add('hidden');
            }
        })
}
