<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title><?= $title ?></title>
  <link rel="stylesheet" href="/css/reset.css" type="text/css" />
  <link rel="stylesheet" href="/css/style.css" type="text/css" />
  <link rel="stylesheet" href="/css/positioning.css" type="text/css" />
  <link rel="stylesheet" href="/css/color.css" type="text/css" />
  <?=$head?>
</head>
<body>
<div id='page'>
<h1>Happy Puppy</h1>
<div id='sidebar'>
<img src="/images/happypuppy.jpg" alt="Happy Puppies" />
<ul>
<li><?= link_to("/doc", "Home") ?></li>
<li><?= link_to("/test", "Basics") ?></li>
<li><?= link_to("/filters", "Filters") ?></li>
<li><?= link_to("/person", "MVC example") ?></li>
</ul>
</div>
<div id='content'>
<?= flash(); ?>
<?=$content?>
</div>
</div>
</body>
</html>
