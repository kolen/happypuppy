<h2>People List</h2>
<?
foreach($people as $person) { ?>
  <div><?= link_to("/person/show/".$person['id'], $person['name']) ?>
  <?= delete_link('/person/destroy?id='.$person["id"], png('delete'), "Are you sure you want to delete ".$person['name']."?") ?></div>
  <? } ?>
