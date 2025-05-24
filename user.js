
function Onresponse(response) {
    console.log('Response received');
    if (!response.ok) {return null};
    return response.json();
}

function fetchChannelContent(){
    fetch('fetchChannelContent.php').then(Onresponse).then(onJson);
}

function onJson(json) {
    console.log(json);
}


fetchChannelContent();