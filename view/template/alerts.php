<?php

if (!empty($_SESSION['alert_success']))
{
	echo '<div class="alert alert-success" id="alert" role="alert">' .
		$_SESSION['alert_success'] .
    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>';
	$_SESSION['alert_success'] = null;
}
elseif (!empty($_SESSION['alert_failure']))
{
	echo '<div class="alert alert-danger container" id="alert" role="alert">' .
		$_SESSION['alert_failure'] . 
    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>';
	$_SESSION['alert_failure'] = null;
}
