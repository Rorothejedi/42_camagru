
  let video;
  let webcamStream;
  let canvas;
  let ctx;

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
    ctx = canvas.getContext('2d');
  }

  function instashot()
  {
    ctx.drawImage(video, 0,0, canvas.width, canvas.height);

    let data = canvas.toDataURL("image/png");
    //let output = data.replace(/^data:image\/(png|jpg);base64,/, "");
    document.getElementById('imgHidden').value = data;
  }
