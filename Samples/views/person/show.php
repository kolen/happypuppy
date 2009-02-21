<h2><?= $person["name"] ?> #<?= $person['id'] ?></h2>
<div><?= link_to('/person/edit/'.$person['id'], 'Edit') ?></div>
<div><?= link_to('/person/list', 'Person List') ?></div>
