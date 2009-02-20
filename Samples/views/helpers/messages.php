<?

function setflash($msg)
{
  $_SESSION['flash'] = $msg;
}

function flash($id = 'flash')
{
  $retval = "";
  if ($_SESSION['flash'] != "")
  {
    $retval = "<div id='$id'>".$_SESSION['flash']."</div>";
    $_SESSION['flash'] = "";
  }
  return $retval;
}
?>
