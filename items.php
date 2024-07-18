<?php
include_once "data/DbData.php";
$data = new DbData();
@session_start();
$groupItems = $_SESSION['group_name'];

//$groupItems = $itemsTempArr;
?>

<body>
    <div class="row">
        <?php include_once "filter_menu.php"; ?>
        <div class="col s9">
            <?php
            foreach ($groupItems as $item) : ?>
                <div class="col s12 m6 l3">
                    <div class="itemsMarBot_10">
                        <div class="main_items">
                            <div class="items_img_div">
                                <a href="item_<?= $item["id"] ?>">
                                    <img data-codeitem="<?= $item["id"] ?>" src="img/item/<?= $item["image_name"] ?>">
                                </a>
                            </div>
                            <a href="item_<?= $item["id"] ?>" data-codeitem="<?= $item["id"] ?>" class="item_name"><?= $item["item_name"] ?></a>
                            <div class="itemsStarDiv">
                                <?php
                                
                                for ($i = 0; $i < $item["feedback_avg"]; $i++) { ?>
                                    <i class="material-icons yellow-text">star</i>
                                <?php } ?>
                                <?php for ($i = 0; $i < (5 - $item["feedback_avg"]); $i++) { ?>
                                    <i class="material-icons">star_border</i>
                                <?php } ?>
                            </div>
                            <div class="items_price_div">
                                <div class="iteminLine">
                                    <?php if ($item["sale_price"] === "0") { ?>
                                        <div class="fontFat"><?= $item["price"] ?> ₴</div>
                                    <?php } else { ?>
                                        <div class="textCross fontFat"><?= $item["price"] ?> </div>
                                        <div class="red-text fontFat"><?= $item["sale_price"] ?> ₴</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>