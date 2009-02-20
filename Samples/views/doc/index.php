<p>Happy Puppy is a nano web framework for PHP.  It is a fork of the Nice Dog project.</p>
<h2>Quickstart</h2>
<ol>
<li>Download starter package</li>
<li>Put it in your directory (/var/www/htdocs)</li>
<li>Create a controller in the /controllers directory: </li>
<pre>
class hello extends C
{
  public function world(){
    echo "Hello World";
    $this->rendered = true;
  }
}
</pre>
<li>Look at the examples for more</li>
</ol>
<h2>Why Fork?</h2>
<p>I wanted to expand the functionality of Nice Dog, but the changes are not minimalistic.  Some of the features are drawn from other frameworks.  It's still a small framework, but not as small as Nice Dog.</p>
<h2>New Features</h2>
<ul>
<li>"Magic" Routes - The default route is /controller/action.  You just create your controller with actions and you're done</li>
<li>Partials - You can render small pages into another page.  Useful for things which are used on multiple pages (forms), or repeated on the same page (table rows)</li>
<li>Filters - Run a method before all your actions in a controller.  Useful for authentication</li>
</ul>
<p>Because it's a fork, it's been renamed</p>
<pre>
License Pending

Originally The MIT License
Copyright (c) 2007 Tiago Bastos</pre>
