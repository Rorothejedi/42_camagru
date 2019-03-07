  let video;
  let layer;
  let webcamStream;
  let canvas;
  let context;

  let lastId;

  navigator.getUserMedia = navigator.getUserMedia ||
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia;

  if (navigator.getUserMedia)
  {
    navigator.getUserMedia({
      audio: false,
      video: {
        width: 1280,
        height: 720 }
      },
      function(stream) {
        video = document.querySelector('#videoElement');
        video.srcObject = stream;
        webcamStream = stream;
      },
      function(error) {
        console.log(error.name);
      }
    );
  }
  else
    console.log("getUserMedia not supported");

  function init()
  {
    canvas = document.getElementById("canvas");
    context = canvas.getContext('2d');
  }

  function loadLayer()
  {
    let val;
    let radios;
    let layerImg;
    radios = document.getElementsByName('layer');
    for (let i = 0; i < radios.length; i++)
    {
      if (radios[i].checked)
      {
        val = radios[i].value;
        layer = document.getElementById(val + 'Layer');
        layerImg = layer.src;
      }
    }
  }

  function replyClick(id)
  {
    let element = document.getElementById(id + 'Layer');
    if (lastId !== undefined && lastId != id + 'Layer')
    {
      let lastElement = document.getElementById(lastId);
      lastElement.classList.add("d-none");
      element.classList.remove("d-none");
    }
    else
    {
      let button = document.getElementById('takePhoto');
      button.disabled = false;
      element.classList.remove("d-none");
    }
    lastId = id + 'Layer';
  }

  function instashot()
  {
    loadLayer();
    if (document.getElementById('videoElement').className !== 'd-none')
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
    let data = canvas.toDataURL("image/png");
    document.getElementById('imgHidden').value = data;
  }

  let imageLoader = document.getElementById('loadImg');
  imageLoader.addEventListener('change', handleImage, false);

  function handleImage(e)
  {
    let imageLoaderExtension = getExtension(imageLoader.value).toLowerCase();
    if (imageLoaderExtension != 'jpg' && imageLoaderExtension != 'png')
    {
      alert('Attention ! Le format de l\'image n\'est pas correct. Seuls les formats .jpg et .png sont acceptés.');
      window.location.reload();
      return;
    }
    document.getElementById('videoElement').classList.add('d-none');
    canvas.classList.remove('d-none');
    let reader = new FileReader();
    reader.onload = function(event)
    {
        let img = new Image();
        img.onload = function()
        {
            let imageWidth  = img.width;
            let imageHeight = img.height;
            let ratio = imageHeight / imageWidth;
            let maxWidth  = 1280;
            let maxHeight = 720;
            if (imageWidth < maxWidth || imageHeight < maxHeight)
            {
              alert('Attention ! La taille de l\'image n\'est pas correcte. Elle doit être d\'au moins 1280x720px');
              window.location.reload();
              return;
            }
            if (ratio > 1)
            {
              alert('Attention ! L\'image utilisée doit être au format paysage.' );
              window.location.reload();
              return;
            }
            if (imageWidth > imageHeight)
            {
              if (imageWidth > maxWidth)
              {
                imageHeight *= maxWidth / imageWidth;
                imageWidth = maxWidth;
              }
            } 
            else 
            {
              if (imageHeight > maxHeight) 
              {
                imageWidth *= maxHeight / imageHeight;
                imageHeight = maxHeight;
              }
            }
            canvas.width = maxWidth;
            canvas.height = maxHeight;
            img.width = imageWidth;
            img.height = imageHeight;
            context.drawImage(img, 0, 0, imageWidth, imageHeight);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
  }

  function getExtension(path)
{
   let regex = /[^.]*$/i;
   let results = path.match(regex);
   return results[0];
}
