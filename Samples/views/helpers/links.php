<?php

function link_to($route, $text)
{
  $link = '<a href="'.$route.'">';
  $link .= ($text == null) ? $route : $text;
  $link .= '</a>';
  return $link;
}

function delete_link($route, $text, $confirm)
{
  // this.href
  $link = "<a onclick=\"if (confirm('".addslashes($confirm)."')) { var f = document.createElement('form');".
    "f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; ".
    "var m = document.createElement('input'); m.setAttribute('type', 'hidden'); ".
    "m.setAttribute('name', '_method'); m.setAttribute('value', 'delete'); f.appendChild(m);".
    " f.action = this.href;f.submit(); };return false;\" href='$route'>$text</a>";
  return $link;
}

function img($src)
{
  $imghtml = '<img src="'.$src.'" />';
  return $imghtml;
}

function png($name)
{
  return img('/images/'.$name.'.png');
}

?>
