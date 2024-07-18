<?php
include_once "data/DbData.php";
$data = new DbData();
$subGroups = $data->getListOfsubGroup($contentUri);
?>

<body>
    <div class="row">
        <?php include_once "group_menu.php"; ?>
        <div class="col s9">
            <?php 
           
            foreach ($subGroups as $subGroup) : ?>
                <div class="col s12 m6 l3">
                    <div class="subGrDiv">
                        <div>
                            <a data-subgroup="<?= $subGroup["uri_name"] ?>" class="imgHref">
                                <img src="img/subgroup/<?= $subGroup["img"] ?>" alt="img">
                            </a>
                            <div class="grItemDiv">
                                <a data-subgroup="<?= $subGroup["uri_name"] ?>" class="ffutrg"><?= $subGroup["sub_name"] ?></a>
                                <ul>
                                    <?php $ItemGroupsArr = $data->getListOfItemGroup($subGroup["uri_name"]);
                                        foreach ($ItemGroupsArr as $ItemGroup) : ?>
                                            <li><a data-subgroup="<?= $ItemGroup["item_group_name"] ?>" class="ItemgrHref"><?= $ItemGroup["item_group_name"] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</body>



<!-- <body>
    <div class="row">
        <?php include_once "group_menu.php"; ?>
        <div class="col s9">
            <?php foreach ($subGroups as $subGroup) : ?>
                <div class="col s12 m6 l3">
                    <div class="card">
                        <a class="card-group" href="<?= $subGroup["uri_name"] ?>">
                            <img class="prop_img" src="img/subgroup/<?= $subGroup["img"] ?> ">
                        </a>
                        <div class="card-stacked">
                            <div class="card-content">
                                <a class="mar_but_10" href="<?= $subGroup["uri_name"] ?>"><?= $subGroup["subName"] ?></a>
                                <div class="cardUlDiv">
                                    <ul class="margin_null itemGroup">
                                        <?php $ItemGroupsArr = $data->getListOfItemGroup($subGroup["uri_name"]);
                                        foreach ($ItemGroupsArr as $ItemGroup) : ?>
                                            <li><a href=""><?= $ItemGroup["itemGroupName"] ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</body> -->