<?php
include_once "data/DbData.php";
$data = new DbData();
$groups = $data->getListOfGroup();
?>
<div class="col s3 main-leftside-div">
    <div class="collection delete-margin">
        <div class="filter_menu_div teal-text">
           <span>Filled in</span>
            <div class="filter_menu_label_div">
                <label>
                    <input type="checkbox" class="filled-in" checked="checked" />
                    <span class="teal-text">Filled in</span>
                </label>
            </div>
            <div class="filter_menu_label_div">
                <label>
                    <input type="checkbox" class="filled-in" checked="checked" />
                    <span class="teal-text">Filled in</span>
                </label>
            </div>
            <div class="filter_menu_label_div">
                <label>
                    <input type="checkbox" class="filled-in" checked="checked" />
                    <span class="teal-text">Filled in</span>
                </label>
            </div>
        </div>
        <!-- <?php foreach ($groups as $group) : ?>
        <a href="group_<?= $group["uri_name"] ?>" class="collection-item">
            <i class="material-icons text-vertical-middel"><?= $group["logo"] ?></i>
            <span class="text-vertical-middel left-side-table-text  hide-on-small-only"><?= $group["mainGroupName"] ?></span>
        </a>
        <?php endforeach ?> -->
    </div>
</div>