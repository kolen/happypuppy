<h2>Filters</h2>
<p>Filters allow you to call methods before your action has been run</p>
<p>Let's say you want to protect some of your actions and have only an administrator perform them.  If the user was not an administrator, boot him or her to the login page</p>
<p>First write a validate method in your controller</p>
<pre>
public function validate()
{
  $admin = false;  // Just set to false to illustrate the example
  if (!$admin)
  {
    // setflash is a helper method not part of Happy puppy
    // It sets a message before redirect is called
    setflash("You are not an admin");
    $this->redirect("/filters/login");
  }
}
</pre>
<p>Now we need to tell our application to call validate before running our actions</p>
<p>You can specify some actions in an array of strings, or all actions with a "*"</p>
<p>In your controller, make a class variable named $before.  $before is an array containing one or more key value pairs.  The key is a string of the method you want to filter, in our case the method "validate".  The value is either the string "*", to specify you want the filter method to run before all actions in the controller, or an array of methods (strings), you want the filter to run before.  It looks like this:</p>
<pre>var $before = array("validate"=&gt;array("adminonly");</pre>
<p>We can keep adding actions to this array</p>
<pre>var $before = array("validate"=&gt;array("adminonly", "deleteuser", "viewbudget");</pre>
<p>But that can get tedious.  You can specify a filter method to run before all of your actions with a "*"</p>
<pre>var $before = array("validate"=&gt;"*");</pre>
<p>Of course, this will send us on an infinite loop, because if we're not an admin, we're redirected to the login page, and at that page, if we're not an admin, we're redirected to the login page . . .</p>
<p>To break out of this loop, we should exempt the login page from our validate filter.  To do this, we need to create another class variable, $not_before, with the same format as the $before variable.
<pre>var $not_before = array("validate"=&gt;array("login"));</pre>
<p>Now our validate filter method will run before all actions in this controller except for the login action.  Look at the filters.php class in the controllers directory for more examples</p>
<div class="example">
<p><?= link_to("/filters/adminonly", "Protected admin only link") ?></p>
<p>This will redirect you to the login page because you're not an admin</p>
</div>
<div class="example">
<p><?= link_to("/filters/alreadyloaded", "Preloaded data") ?></p>
<pre>
public function preload() // called before all methods
{
  $this->classvar = "Preloaded for all methods";
}
</pre>
<pre>
// classvar is already loaded here
public function alreadyloaded()
{
  echo "Preloaded: ".$this->classvar;
  $this->rendered = true;
}
</pre>
<p>Here is an example where the data is loaded in a filter method instead of the action.  This way it can be repeated across all actions</p>
</div>
