(function() {

  // var streaming = false,
  //   video       = document.querySelector('#video'),

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
        var video = document.querySelector('#videoElement');
        video.srcObject = stream;
        video.onloadedmetadata = function(e) {
          video.play();
        };
      },
      function(error) {
        console.log(error.name);
      }
    );
  } 
  else
    console.log("getUserMedia not supported");


  /**
   * Test de la forme supporté par navigateur
   */
  //navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);

  /**
   * Nous demandons au navigateur de nous donner la vidéo sans le son 
   * et de récupérer le flux dans une fonction callback
   */
  // navigator.getMedia(
  // {
  //   video: true,
  //   audio: false
  // },
  // function(stream)
  // {

  //     //var vendorURL = window.URL || window.webkitURL;
  //     //video.src = window.URL.createObjectURL(stream);
  //     var binaryData = [];
  //     binaryData.push(stream);
  //     video.src = window.URL.createObjectURL(new Blob(binaryData, {type: "application/zip"}))
  //     /*error here*/

  //   video.play();
  // },
  // function(err)
  // {
  //   console.log("An error occured! " + err);
  // }
  // );

  /**
   * Redimentionnement de la vidéo dans les bonnes dimensions
   */
  // video.addEventListener('canplay', function(ev)
  // {
  //   if (!streaming) {
  //     height = video.videoHeight / (video.videoWidth/width);
  //     video.setAttribute('width', width);
  //     video.setAttribute('height', height);
  //     canvas.setAttribute('width', width);
  //     canvas.setAttribute('height', height);
  //     streaming = true;
  //   }
  // }, false);

  // function takepicture()
  // {
  //   canvas.width = width;
  //   canvas.height = height;
  //   canvas.getContext('2d').drawImage(video, 0, 0, width, height);
  //   var data = canvas.toDataURL('image/png');
  //   photo.setAttribute('src', data);
  // }


  // startbutton.addEventListener('click', function(ev)
  // {
  //   takepicture();
  //   ev.preventDefault();
  // }, false);

})();