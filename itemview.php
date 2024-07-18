<?php


include_once "data/DbData.php";
$data = new DbData();
$subGroups = $data->getItemById($contentUri);
$data = $subGroups["data"];
$feedbacks = $subGroups["feedbacks"];
$imgs = $subGroups["imgs"];
$features = $subGroups["features"];
// @session_start();
// $data = $_SESSION['item_data']["data"];
// $feedbacks = $_SESSION["item_data"]["feedbacks"];
// $imgs = $_SESSION["item_data"]["imgs"];
// $features = $_SESSION["item_data"]["features"];

?>

<div class="row">
    <div class="col s12 m6">
        <div class="col s12 itemPageMainImg">
            <img id="bigImgItem" class="item_img col s12" src="/img/item/<?= $imgs[0]["file_name"] ?>" alt="item_img">
        </div>
        <div class="col s12">
            <div class="img-box">
                <?php foreach ($imgs as $img) { ?>
                    <div class="img_box_div">
                        <img src="/img/item/<?= $img["file_name"] ?>" class="item_img_box_img" alt="<?= $img["file_name"] ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col s12 m6">
        <h4>
            <?= $data["item_name"] ?>
        </h4>
        <!-- <div class="iteminLine margtop_40">

            <div class="textCross itemPagePrice">1500 </div>
            <div class="red-text itemPagePrice">1000 ₴</div>

        </div> -->
        <div class="star_div">

            <?php
            $totalScore =0;
            foreach ($feedbacks as $feedback) {
                $totalScore += $feedback["score"];
            }

            if(isset($feedbacks)){
                $quantity = count($feedbacks);
                $totalScore /= $quantity;
            }
            for ($i = 0; $i < $totalScore; $i++) { ?>
                <i class="material-icons yellow-text">star</i>
            <?php } ?>
            <?php for ($i = 0; $i < (5 - $totalScore); $i++) { ?>
                <i class="material-icons">star_border</i>
            <?php } ?>
            <span class="star_span"><?=$quantity?> відгуки</span>
        </div>

        <div class="iteminLine margtop_40">
            <?php if ($data["sale_price"] === "0") { ?>
                <div class="itemPagePrice"><?= $data["price"] ?> ₴</div>
            <?php } else { ?>
                <div class="textCross itemPagePrice"><?= $data["price"] ?> </div>
                <div class="red-text itemPagePrice"><?= $data["sale_price"] ?> ₴</div>
            <?php } ?>
        </div>
        
        <?php if ($data["on_active"] === 1) { ?>
            <span class="green-text">Є в наявності</span>
        <?php } else { ?>
            <span class="grey-text text-lighten-2">Немає в наявності</span>
        <?php } ?>
        <div class="margtop_40">
            <a id="buyItemButton" class="waves-effect waves-light btn orange darken-3"><i class="material-icons left">shopping_cart</i>Купити</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12 m6">

        <div class="col s12">
            <div>
                <h4>Опис</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <span class="desc_text">
                            <?= $data["description"] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <div class="col s12">
            <h4>Характеристики</h4>
            <div id="featureDiv">
                <table class="striped">
                    <tbody>
                        <?php foreach ($features as $feature) { ?>
                            <tr>
                                <td><?= $feature["feature_name"] ?></td>
                                <td><?= $feature["feature_text"] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col s12 m6">
        <h4>Відгуки покупців</h4>
        <div class="row">
            <div class="col s12 feed_marg_top_bot">
                <?php foreach ($feedbacks as $feedback) { ?>
                    <div class="feed_main_div col s12">
                        <div class="feed_div right-align">
                            <span><?= $feedback["date"] ?></span>
                        </div>
                        <div class="feed_div">
                            <?php for ($i = 0; $i < $feedback["score"]; $i++) { ?>
                                <i class="material-icons yellow-text">star</i>
                            <?php } ?>
                            <?php for ($i = 0; $i < (5 - $feedback["score"]); $i++) { ?>
                                <i class="material-icons">star_border</i>
                            <?php } ?>
                        </div>
                        <div class="feed_div">
                            <span><?= $feedback["comment"] ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>