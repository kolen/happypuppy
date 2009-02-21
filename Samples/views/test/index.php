<h2>The Basics</h2>
<p>All (except one) of these examples are in the 'test' controller, found in /controllers/test.php
<div class="example">
<p><?= link_to('/test/hello', 'Hello World'); ?></p>
<pre>
public function hello()
{
  echo 'Hello World - Simple text example';
  $this->rendered = true;
}
</pre>
<p>Basic Hello World.  Notice that we must specify $this->rendered = true to tell Happy Puppy that we are outputting text directly and to not try and load a template file</p>
</div>
<div class="example">
<p><?= link_to('/test/redir', 'Redirected Link'); ?></p>
<pre>
public function redir()
{
  $this->redirect('/test/error');
}
</pre>
<p>Calling $this->redirect outputs a location header right away, stops processing and redirects the browser.</p>
</div>
<div class="example">
<p><?= link_to('/test/altview', 'Alternate view template'); ?><p>
<pre>
public function altview()
{
  $this->view_template = 'views/test/different.php';
}
</pre>
<p>By default, /test/altview would look for a template in views/test/altview.php  This lets you specify a different view file</p>
</div>
<div class="example">
<p><?= link_to('/test/altlayout', 'Alternate layout template'); ?></p>
<pre>
public function altlayout()
{
  $this->layout_template = 'views/alternatelayout.php';
}
</pre>
<p>The default layout template is views/layout.php  You can specify a different one</p>
</div>
<div class="example">
<p><?= link_to('/test/nolayout', 'No layout template'); ?></p>
<pre>
public function nolayout()
{
  $this->layout = false;
}
</pre>
<p>You can also turn it off completely</p>
</div>
<div class="example">
<p><?= link_to('/test/show/44', "Single argument"); ?></p>
<pre>
public function show($id)
{
  echo "Showing #$id"."  Try changing the URL";
  $this->rendered = true;
}
</pre>
<p>Specifying parameters is easy</p>
</div>
<div class="example">
<p><?= link_to('/test/showboth/first/second', 'Multiple arguments'); ?></p>
<pre>
public function showboth($one, $two)
{
  echo "Arg #1: ($one) Arg #2: ($two)";
  $this->rendered = true;
}
</pre>
<p>Add as many arguments as you'd like</p>
</div>
<div class="example">
<p><?= link_to('/2009/01/20/blog/Hope', 'Custom route'); ?></p>
<pre>R('(?P&lt;year&gt;[-\w]+)/(?P&lt;month&gt;[-\w]+)/(?P&lt;day&gt;[-\w]+)/blog/(?P&lt;title&gt;[-\w]+)', 'test', 'blog', 'GET');</pre>
<pre>
public function blog($year, $month, $day, $title)
{
  echo "Year: $year Month: $month Day: $day Title: $title";
  $this->rendered = true;
}
</pre>
<p>Add the route to your routes file.</p>
</div>
<div class="example">
<h3>Static files</h3>
<p>The included .htaccess file will automatically serve up files in your public folder.  For example, placing a file in /var/www/htdocs/public/images/happypuppy.jpg makes it accessible to http://host/images/happypuppy.jpg</p>
<img src="images/happypuppy.jpg" alt="Happy puppies" />
</div>
