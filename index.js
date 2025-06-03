  const header = document.getElementById('main-header');
  const images = [
    'Media/welcomeWallpaper.jpg',
    'Content/profile/pf1Background.jpg',
  ];

  let index = 0;

  function changeBackground() {
    header.style.backgroundImage = `url('${images[index]}')`;
    index = (index + 1) % images.length;
  }

  changeBackground();
  setInterval(changeBackground, 5000);