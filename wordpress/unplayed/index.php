<?php

function e($str) { echo preg_replace('#\(([^\)]+)\)#', '<span>\1</span>', $str); }

include('libs/smartypants.php');
include('libs/markdown.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Unplayed</title>
<meta name="viewport" content="width=320, initial-scale=1, minimum-scale=0.45" />
<style>

*
{
	margin: 0;
	padding: 0;
	border: none;
}

body
{
	font: 13px/18px sans-serif;
	color: #333;
	background-color: #fff;
	padding: 16px;
}

a
{
	text-decoration: none;
	font-weight: bold;
	color: inherit;
}

a:hover
{
	color: #333;
}

div
{
	-webkit-box-sizing: border-box;
	-ms-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-o-box-sizing: border-box;
	box-sizing: border-box;
	padding: 16px;
	width: 25%;
	float: left;
}

#footer
{
	margin: 16px 16px 0;
	padding: 16px 0 0;
	border-top: 1px solid #333;
	float: none;
	clear: both;
	width: auto;
}

h1
{
	margin: 0 0 16px;
	padding: 0 0 16px;
	border-bottom: 4px solid #333;
}

p
{
	margin: 0 0 16px;
}

li
{
	list-style: none;
	padding: 0 0 0 16px;
	position: relative;
}

li:before
{
	display: block;
	content: '-';
	font-weight: bold;
	position: absolute;
	top: -2px;
	left: 0;
	font-size: 24px;
}

span
{
	color: #999;
	font-size: 9px;
}

span + span
{
	font-size: 11px;
	line-height: 13px;
	display: block;
	position: relative;
	top: -2px;
}

/* iPhone [portrait + landscape] */
@media only screen and (max-device-width: 480px)
{
	body
	{
		padding: 0;
	}
	div
	{
		width: 320px;
		clear: both;
	}
	#footer
	{
		margin: 16px;
	}
}

</style>
</head>
<body>

<div>
<h1>Playing</h1>
<?php e(markdown(smartypants(file_get_contents('unbeaten.markdown'))));?>
</div>

<div>
<h1>Unplayed</h1>
<?php e(markdown(smartypants(file_get_contents('unplayed.markdown'))));?>
</div>

<div>
<h1>Beaten</h1>
<?php e(markdown(smartypants(file_get_contents('beaten.markdown'))));?>
</div>

<div>
<h1>Abandoned</h1>
<?php e(markdown(smartypants(file_get_contents('abandoned.markdown'))));?>
</div>




<div id="footer"><a href="http://shauninman.com/">Shaun Inman</a> gave me this idea. <a href="http://shauninman.com/archive/2011/04/18/unplayed">More info</a> 
<P>Est. 12/2/2013
</div>

</body>
</html>