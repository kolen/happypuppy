<?

# load models needed for this controller here
require DOCROOT.'/models/personmodel.php';

class person extends C
{
  public function index()
  {
    $this->redirect("/person/list");
  }
  public function _list()
  {
    $this->people = personmodel::getAll();
  }
  public function create()
  {
    // collect POST variables here
    // save to database
    // redirect as appropriate
    /*$person = $_POST['person'];
    if (personmodel::create($person))
    {
      setflash("Person created");
    }
    else
    {
      setflash("Could not create person");
    }*/
    setflash("Dummy create method");
    $this->redirect('/person/list');
  }
  public function show($id)
  {
    // $this->person = personmodel::get($id);
    $this->person = array('id'=>$id, 'name'=>'Fake Person');
  }
  public function destroy()
  {
    /*$id = $_GET['id'];
    $person = personmodel::get($id);
    if ($_POST['_method'] != 'delete')
    {
      $this->redirect("/person/show/$id");
      return;
    }
    if (personmodel::destroy($id))
    {
      setflash("Deleted ".$person['name']);
    }
    else
    {
      setflash("Could not delete ".$person['name']);
    }*/
    setflash("Dummy destroy method");
    $this->redirect("/person/list");
  }
  public function edit($id)
  {
    // $this->person = personmodel::get($id);
    $this->person = array('id'=>$id, 'name'=>'Fake Person'.' '.$id);
  }
  public function update()
  {
    /*$person = $_POST['person'];
    if (personmodel::update($person))
    {
      setflash($person['name']." updated");
    }
    else
    {
      setflash("Could not update ".$person['name']);
    }*/
    setflash("Dummy update method");
    $this->redirect('/person/list');
  }
}

?>
