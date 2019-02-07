function fadeOutEffect(id)
{
  var fadeTarget = document.getElementById(id);
  var fadeEffect = setInterval(function ()
  {
    if (!fadeTarget.style.opacity)
      fadeTarget.style.opacity = 1;
    if (fadeTarget.style.opacity > 0)
      fadeTarget.style.opacity -= 0.1;
    else
      clearInterval(fadeEffect);
  }, 200);
}

// For use fadeOutEffect :
// document.getElementById("target").addEventListener('click', fadeOutEffect("target"));
