<?

class personmodel
{
  /*public static function getAll()
  {
    $query = "SELECT g.*, s.name as system FROM Game g ".
      "LEFT JOIN System s ON g.system_id = s.id ".
      "ORDER BY s.name, g.name" ;
    return DB::query($query);
  }*/
  public static function getAll()
  {
    return array(array("id"=>1, "name"=>"Dave"),
                 array("id"=>2, "name"=>"Tiago"),
                 array("id"=>3, "name"=>"Christopher"));
  }
  /*public static function create($game)
  {
    return DB::insert('Game', $game);
  }
  public static function get($id)
  {
    $query = "SELECT g.*, s.name as system FROM Game g ".
      "LEFT JOIN System s ON g.system_id = s.id ".
      "WHERE g.id=".addslashes($id);
    return DB::getRow($query);
  }
  public static function destroy($id)
  {
    return DB::destroy('Game', $id);
  }
  public static function update($game)
  {
    return DB::update('Game', $game);
  }*/
}

?>
