<?

function html_text($name, $html_options = array())
{
  $id = ''; $default = '';
  if (array_key_exists('id', $html_options)){ $id="id='".$html_options["id"]."'"; }
  if (array_key_exists('default', $html_options)){ $default="value='".htmlspecialchars($html_options["default"], ENT_QUOTES)."'"; }
  $out = "<input type='text' name='$name' $id $default' />";
  return $out;
}

function html_select($name, $options, $selected_id = null)
{
  $out = "<select name='$name'>";
  foreach ($options as $id=>$value)
  {
    $selected = ($id == $selected_id) ? "SELECTED" : "";
    $out .= "<option value='$id' $selected>$value</option>";
  }
  $out .= "</select>";
  return $out;
}

function html_button($name, $text)
{
  $out = "<input type='submit' name='$name' value='$text' />";
  return $out;
}

function html_textarea($name, $default)
{
  $out = "<textarea name='$name' rows='4' cols='40'>$default</textarea>";
  return $out;
}

function html_hidden($name, $value)
{
  $out = "<input type='hidden' name='$name' value='$value' />";
  print $out;
}

?>
