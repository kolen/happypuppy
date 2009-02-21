<h2>MVC Example</h2>
<p>This section shows off a fake MVC example.  Look at the person.php file in controllers to see code commented out on how many of these operations would work.</p>
<h2>People List</h2>
<table><thead><tr><td>Name</td><td></td></tr></thead>
<tbody>
<?
foreach($people as $person) { ?>
  <tr><td><?= link_to("/person/show/".$person['id'], $person['name']) ?></td>
  <td><?= delete_link('/person/destroy?id='.$person["id"], png('delete'), "Are you sure you want to delete ".$person['name']."?") ?></td></tr>
  <? } ?>
</tbody><table>
