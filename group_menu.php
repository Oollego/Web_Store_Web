<?php
include_once "data/DbData.php";
$data = new DbData();
$groups = $data->getListOfGroup();
?>
<div class="col s3 main-leftside-div">
    <div class="collection delete-margin">
        <?php foreach ($groups as $group) : ?>
        <a href="group_<?= $group["uri_name"] ?>" class="collection-item">
            <i class="material-icons text-vertical-middel"><?= $group["logo"] ?></i>
            <span class="text-vertical-middel left-side-table-text  hide-on-small-only"><?= $group["main_group_name"] ?></span>
        </a>
        <?php endforeach ?>
    </div>
</div>