<form action='/person/update' method='POST'>
<?= html_hidden('person[id]', $person['id']); ?>
<?= render_arr('person/personform', array('person'=>$person)) ?>
<?= html_button('editperson', 'Edit Person') ?>
<div><?= link_to('/person/show/'.$person['id'], 'Cancel') ?></div>
</form>
