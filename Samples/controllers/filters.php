<?

class filters extends C
{
  var $classvar;
  
  // Filter information
  var $before = array("validate"=>"*", "preload"=>array("alreadyloaded"));
  var $not_before = array("validate"=>array("", "index", "alreadyloaded", "login"));
  public function validate()
  {
    $admin = false;
    if (!$admin)
    {
      setflash("You are not an admin");
      $this->redirect("/filters/login");
    }
  }
  public function preload()
  {
    $this->classvar = "Preloaded for all methods";
  }

  public function adminonly()
  {
    echo "You're not an admin, so you'll never see this";
    $this->rendered = true;
  }
  public function alreadyloaded()
  {
    echo "Preloaded: ".$this->classvar;
    $this->rendered = true;
  }
}

?>

