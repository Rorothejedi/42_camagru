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
    //context.globalAplha = 1.0;
    if (document.getElementById('videoElement').className !== 'd-none')
      context.drawImage(video, 0, 0, canvas.width, canvas.height);

    //context.globalAplha = 0.5;
    //context.drawImage(layer, 0, 0, canvas.width, canvas.height);

    let data = canvas.toDataURL("image/png");
    //let output = data.replace(/^data:image\/(png|jpg);base64,/, "");
    document.getElementById('imgHidden').value = data;
  }


  let imageLoader = document.getElementById('loadImg');
  imageLoader.addEventListener('change', handleImage, false);


  function handleImage(e)
  {
    document.getElementById('videoElement').classList.add('d-none');
    canvas.classList.remove('d-none');
    let reader = new FileReader();
    reader.onload = function(event)
    {
        let img = new Image();
        img.onload = function()
        {
            canvas.width = img.width;
            canvas.height = img.height;
            context.drawImage(img, 0, 0);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
  }
