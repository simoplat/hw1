// toggle menu a sinistra in alto
const buttonMenuLines = document.querySelector('#button-menu');
const layout = document.querySelector('.central-layout');
const buttonMenuMobile = document.querySelector('#button-menu-mobile');

function toggleMenuSidebar(){
    let sidebarContent = document.querySelector('.left-sidebar');
    
    if (sidebarContent.classList.contains('hidden')) {
        sidebarContent.classList.remove('hidden');
        layout.classList.remove('expand');
        console.log('A'); //debug
    } else {
        console.log('B'); //motivi di debug
        sidebarContent.classList.add('hidden');
        layout.classList.add('expand');
    }
}

buttonMenuLines.addEventListener('click', toggleMenuSidebar);
buttonMenuMobile.addEventListener('click', toggleMenuSidebar);

// toggle menu profilo
const buttonProfile = document.querySelector('#button-profile');
const personalMenu = document.querySelector('.personal-menu');

function toggleProfMenu(){
    

    if (personalMenu.classList.contains('hidden')) {
        if(!notifyMenu.classList.contains('hidden')){
            notifyMenu.classList.add('hidden');
        }
        personalMenu.classList.remove('hidden');
        console.log('Setto display show');
    } else {
        personalMenu.classList.add('hidden');
        console.log("Setto display hidden")
    }
}


buttonProfile.addEventListener('click', toggleProfMenu);

const mediaQuery = window.matchMedia('(max-width: 750px)');

function MediaChange(parametro) {
let sidebarContent = document.querySelector('.left-sidebar');
  if (parametro.matches) {  
    console.log('media query');
        
        // Se la sidebar è visibile, fa il toggle e nasconde
        if (!sidebarContent.classList.contains('hidden')) {
            console.log('Faccio il toggle');
            toggleMenuSidebar();
        } 
    }
}

MediaChange(mediaQuery);
mediaQuery.addEventListener('change', MediaChange);



// funzione per cambiare immagine profilo

let changeButton = document.querySelector('[data-action="change-picture"]');
let pic = document.querySelector('#profpic');
let menuPic = document.querySelector('#profpic-menu');
let imageList = ['pf1.jpg', 'pf2.jpg', 'pf3.jpg']; 

let lastImage = null;

function randomImgChange (){
    let randomImage;
    do {
        randomImage = imageList[Math.floor(Math.random() * imageList.length)];
    } while (randomImage === lastImage);

    pic.src = randomImage;
    menuPic.src = randomImage;
    lastImage = randomImage;
}

changeButton.addEventListener('click', randomImgChange);




const notifyButton = document.querySelector('#notify-button');
const notifyMenu = document.querySelector('.notify-menu');

function toggleNotifyMenu () {

    if (notifyMenu.classList.contains('hidden')) {
        if(!personalMenu.classList.contains('hidden')){
            personalMenu.classList.add('hidden');
        }
        if (notifyMenu.querySelectorAll('p').length === 0) {
            let noNotification = document.createElement('p');
            noNotification.textContent = 'Nessuna notifica';
            // noNotification.classList.add('sdbar-ins-txt');
            notifyMenu.appendChild(noNotification);
        }
        notifyMenu.classList.remove('hidden');
        console.log('Setto display show');
    } else {
        notifyMenu.classList.add('hidden');
        console.log("Setto display hidden")
    }
};

notifyButton.addEventListener('click', toggleNotifyMenu);



function nascontiContenuti(dataType) {
    document.querySelectorAll(`h1[data-type="${dataType}"] img`).forEach(img => {
        img.addEventListener('click', () => {
            document.querySelectorAll(`.sidebar-h[data-type="${dataType}"]`).forEach(sidebar => {

                if (sidebar.classList.contains('hidden')) {
                    sidebar.classList.remove('hidden');
                    img.dataset.type = 'up';
                    console.log('A');
                } else {
                    sidebar.classList.add('hidden');
                    img.dataset.type = 'down';
                    console.log('B');
                }
            });
        });
    });
}

// Example usage:
nascontiContenuti('Tu');
nascontiContenuti('channel');


//API N1



const API_KEY = 'secret'; 
const maxResults = 30;


function onJson(json){
    console.log('JSON ricevuto');
    // Svuotiamo la libreria
    const contentVIDEOLAYOUT = document.querySelector('.video-layout');
    const navCentral = document.querySelector('.nav-central');
    navCentral.classList.add('hidden');
    contentVIDEOLAYOUT.innerHTML = '';
    const categorie = document.querySelector('.categorie');
    while (categorie.querySelector('h1')) {
        categorie.querySelector('h1').remove();
    }

    if(json.items.length === 0) {
        let noResult = document.createElement('h1');
        noResult.textContent = 'Nessun risultato trovato';
        contentVIDEOLAYOUT.appendChild(noResult);
    }
    for (let i = 0; i < json.items.length; i++) {
        
        let item = json.items[i];



        //creo l'immagine e setto la sorgente
        let imgSource = item.snippet.thumbnails.medium.url;
        let imgElement = document.createElement('img');
        imgElement.src = imgSource;


        let divVideoContent = document.createElement('div');
        divVideoContent.classList.add('video-content');

        let divThumbnail = document.createElement('div');
        divThumbnail.classList.add('video-thumbnail');
        
        let divText = document.createElement('div');
        divText.classList.add('video-info');


        let divVideoInfoChannel = document.createElement('div');
        divVideoInfoChannel.classList.add('video-info-channel');

        
        let h1 = document.createElement('h1');
        h1.textContent =item.snippet.title; 

        let p = document.createElement('p');
        p.textContent = item.snippet.channelTitle;
        

        divVideoInfoChannel.appendChild(h1);
        divVideoInfoChannel.appendChild(p);

        divText.appendChild(divVideoInfoChannel);
        divThumbnail.appendChild(imgElement);
        divVideoContent.appendChild(divThumbnail);
        divVideoContent.appendChild(divText);

        contentVIDEOLAYOUT.appendChild(divVideoContent);
        if(contentVIDEOLAYOUT.classList.contains('column')) {
            contentVIDEOLAYOUT.classList.remove('column');
        }
    }
}



function onResponse(response) {
    console.log('Risposta ricevuta');
    return response.json();
}



function search (event){
    event.preventDefault();
    const searchInput = document.querySelector('#search-bar').value;
    console.log('Hai cercato: '+ searchInput);
    const encode = encodeURIComponent(searchInput);
    console.log('Encoding:' + encode);
    restUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' + encode + '&type=video&maxResults=' + maxResults+ '&key=' + API_KEY;
    console.log('URL:' + restUrl);
    fetch(restUrl).then(onResponse).then(onJson);
    
}
const form = document.querySelector('#search-form');
form.addEventListener('submit', search);

////API SPOTIFY N.2 oauth 2.0


function onJsonSpotify(json){
    const contentVIDEOLAYOUT = document.querySelector('.video-layout');
    contentVIDEOLAYOUT.innerHTML = '';
    const centralLayout = document.querySelector('.central-layout');
    const navCentral = document.querySelector('.nav-central');
    navCentral.classList.add('hidden');
    const categorie = document.querySelector('.categorie');
    if(!categorie.querySelector('h1')) {

        let title = document.createElement('h1');
        title.textContent = 'Playlists:';
        categorie.appendChild(title);
    }
    for (let i = 0; i < json.playlists.items.length; i++) {
        const item = json.playlists.items[i];
        if (item && item.name) {
            console.log(item.name);
            let playlistName = document.createElement('h2');
            playlistName.textContent = item.name;
            let videoContent = document.createElement('div');
            videoContent.classList.add('video-content');
            let imgElement = document.createElement('img');
            imgElement.src = item.images[0].url;
            let divThumbnail = document.createElement('div');
            divThumbnail.classList.add('video-thumbnail');
            let divVideoInfo = document.createElement('div');
            divVideoInfo.classList.add('video-info');
            divVideoInfo.appendChild(playlistName);
            divThumbnail.appendChild(imgElement);
            videoContent.appendChild(divThumbnail);
            videoContent.appendChild(divVideoInfo);

            contentVIDEOLAYOUT.appendChild(videoContent);
        }
    }
    
}



function playlistSpotify(event)
{
  event.preventDefault();
  console.log('Ho ricevuto il click sul bottone playlist');
  // Esegui la richiesta
  fetch("https://api.spotify.com/v1/search?q=ROCK&type=playlist",
    {
      headers:
      {
        'Authorization': 'Bearer ' + token
      }
    }
  ).then(onResponse).then(onJsonSpotify);
}


function onTokenJson(json)
{
  token = json.access_token;
}

function onTokenResponse(response)
{
  return response.json();
}


const client_id = 'secret';
const client_secret = 'secret';
const myUserId = 'secret';
let token;

fetch("https://accounts.spotify.com/api/token",
	{
   method: "post",
   body: 'grant_type=client_credentials',
   headers:
   {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Authorization': 'Basic ' + btoa(client_id + ':' + client_secret)
   }
  }
).then(onTokenResponse).then(onTokenJson);


const playlistButton = document.querySelector('#buttonPlaylist');
playlistButton.addEventListener('click', playlistSpotify);



// API CHANNELS

const channelDivCreator = document.querySelector('.createChannels');

function onJsonChannels(json) {
       console.log('Json ricevuto, creo i canali');
       console.log(json);
       channelDivCreator.innerHTML = '';

       json.forEach(channel => {
          // Creo un nuovo div
          // Creo il div principale con classe e attributo data-type
const sidebarDiv = document.createElement('div');
sidebarDiv.classList.add('sidebar-h');
sidebarDiv.setAttribute('data-type', 'channel');

// Creo il button
const button = document.createElement('button');

// Creo il div sidebar-inside
const sidebarInside = document.createElement('div');
sidebarInside.classList.add('sidebar-inside');

// Creo il div per immagine
const imgDiv = document.createElement('div');
imgDiv.classList.add('sdbar-ins-img');

// Creo l'img
const img = document.createElement('img');
img.classList.add('channel-pic');
img.src = 'Media/Portrait_Placeholder.png';


imgDiv.appendChild(img);

// Creo il div per il testo
const txtDiv = document.createElement('div');
txtDiv.classList.add('sdbar-ins-txt');

const p = document.createElement('p');
p.textContent = channel.channelname;


txtDiv.appendChild(p);


sidebarInside.appendChild(imgDiv);
sidebarInside.appendChild(txtDiv);


button.appendChild(sidebarInside);


sidebarDiv.appendChild(button);


channelDivCreator.appendChild(sidebarDiv);


       });
}

function loadchannels(){
    console.log('Carico i canali');
    fetch('fetchchannels.php').then(onResponse).then(onJsonChannels);
};

loadchannels();


//clik su canale


document.addEventListener('click', function (event) {
  const button = event.target.closest('.sidebar-h[data-type="channel"] button');
  if (button) {
    event.preventDefault();
    const channelName = button.querySelector('p').textContent.trim();
    console.log('Canale selezionato:', channelName);
    window.location.href = `user.php?user=${encodeURIComponent(channelName)}`;
  }
});
