<?

// A good place for database settings
$hostname   = '';
$dbname     = '';
$dbusername = '';
$dbpassword = '';
$db = null;
try
{
  //$db = new PDO("mysql:host=$hostname;dbname=$dbname", $dbusername, $dbpassword);
}
catch(PDOException $e)
{
  print $e->getMessage();
}

class DB
{
  static function query($sql)
  {
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $arr = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $arr[] = $row;
    }
    return stripslashes_deep($arr);
  }
  static function assoc($sql, $key, $value)
  {
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $arr = array();
    while($row = stripslashes_deep($stmt->fetch(PDO::FETCH_ASSOC)))
    {
      $arr[$row[$key]] = $row[$value];
    }
    return $arr;
  }
  static function insert($table, $arr)
  {
    global $db;
    $sql_keys = ''; $sql_values = '';
    foreach($arr as $key=>$value)
    {
      $sql_keys .= "`".addslashes($key)."`, ";
      $sql_values .= "'".addslashes($value)."', ";
    }
    $sql_keys = substr($sql_keys, 0, -2);
    $sql_values = substr($sql_values, 0, -2);
    $query = "INSERT INTO $table ($sql_keys) VALUES ($sql_values);";
    $stmt = $db->prepare($query);
    return $stmt->execute();
  }
  static function destroy($table, $id)
  {
    global $db;
    $query = "DELETE FROM $table WHERE id='".addslashes($id)."' LIMIT 1"; 
    return $db->exec($query);
  }
  static function get($table, $id)
  {
    global $db;
    $query = "SELECT * FROM $table WHERE id=".addslashes($id);
    $stmt = $db->prepare($query);
    $stmt->execute();
    return stripslashes_deep($stmt->fetch(PDO::FETCH_ASSOC));
  }
  static function getRow($query)
  {
    global $db;
    $stmt = $db->prepare($query);
    $stmt->execute();
    return stripslashes_deep($stmt->fetch(PDO::FETCH_ASSOC));
  }
  static function update($table, $arr)
  {
    global $db;
    $sql_set = '';
    foreach($arr as $key=>$value)
    {
      $sql_set .= "`".addslashes($key)."`='".addslashes($value)."', ";
    }
    $sql_set = substr($sql_set, 0, -2);
    $query = "UPDATE $table SET $sql_set WHERE id='".addslashes($arr['id'])."';";
    print $query;
    $stmt = $db->prepare($query);
    return $stmt->execute();
  }
}
function stripslashes_deep($value)
{
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}
?>
