<?

class test extends C
{
  //Notice we don't need an index function.  If it's blank don't even bother!

  public function hello()
  {
    echo 'Hello World - Simple text example';
    $this->rendered = true;
  }
  // redirection
  public function redir()
  {
    $this->redirect('/test/error');
  }
  public function error()
  {
    echo "The link you clicked on was /test/redir, but look at the url";
    $this->rendered = true;
  }
  public function altview()
  {
    // Use a different view
    $this->view_template = 'views/test/different.php';
  }
  public function altlayout()
  {
    // Use a different layout
    $this->layout_template = 'views/alternatelayout.php';
  }
  public function nolayout()
  {
    // or turn the layout off completely
    $this->layout = false;
  }

  // Passing arguments as part of the URL

  public function show($id)
  {
    echo "Showing #$id"."  Try changing the URL";
    $this->rendered = true;
  }
  public function showboth($one, $two)
  {
    echo "Arg #1: ($one) Arg #2: ($two)";
    $this->rendered = true;
  }
  public function blog($year, $month, $day, $title)
  {
    echo "Year: $year Month: $month Day: $day Title: $title";
    $this->rendered = true;
  }
}
?>
