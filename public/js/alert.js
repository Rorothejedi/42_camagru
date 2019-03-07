if (alerts = document.getElementById('alert'))
{
	document.getElementById('alertNone').style.display = 'none';
	var interval = setInterval(function ()
	{ 
		animateOut(alerts, 4); 
	}, 1000);
	alerts.onclick = function()
	{
		clearInterval(interval);
		animateOut(alerts, 0);
	};
}

function animateOut(element, delay)
{
	element.classList.remove("slideInDown");
	element.classList.add("slideOutUp");
	if (delay != 0)
	{
		element.classList.add("delay-4s");
		setInterval(function () {
			element.remove();
			document.getElementById('alertNone').style.display = "block";
		}, 5000);
	}
	else
	{
		element.classList.remove("delay-4s");
		setInterval(function () {
			element.remove();
			document.getElementById('alertNone').style.display = "block";
		}, 1000);
	}
}