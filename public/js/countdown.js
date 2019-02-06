var count   = 8;
var counter = setInterval(countdown, 1000);

function countdown()
{
  	count = count - 1;
	if (count <= 0)
	{
	    clearInterval(counter);
	    document.location.href = './';
	 	return;
	}
	document.getElementById("countdown").innerHTML = count;
}