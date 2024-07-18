<?php
include_once "data/DbData.php";
@session_start();
$data = new DbData();
if (isset($_SESSION['user'])) {
    $basketItems = $data->getFromBasket($_SESSION['user']['id']);
} else {
    $basketItems = null;
    if (isset($_SESSION['tempBasket'])) {
        $basketItems = $_SESSION['tempBasket'];
    }
}
$totalUah = 0;
?>
<div class="row ">
    <?php include 'cab_menu.php'; ?>

    <div class="col s10 l9">
        <?php if ($basketItems != null) { ?>
            <ul class="basket-ul">
                <?php foreach ($basketItems as $basketItem) : ?>
                    <li class="row white ">
                        <div class="col s12 m3 l3 basket-item-image-div">
                            <img class="basket_item_image" src="/img/item/<?= $basketItem["image_name"] ?>" alt="<?= $basketItem["image_name"] ?>">
                        </div>
                        <div data-itemId="<?= $basketItem["id"] ?>" class="col s12 m9 l9 basket-item-div">
                            <div class="marg_right_5">
                                <span class="title"><?= $basketItem["item_name"] ?></span>
                                <!-- <p><?= $basketItem["itemName"] ?></p> -->
                                <div class="basket-quantity-div">
                                    <div class="basket-item-quantity">
                                        <a  class="btn-floating white basketItemSub"><i data-basketItemId="<?= $basketItem["id"] ?>" class="material-icons grey-text">remove</i></a>
                                        <span  class="basket-quantity-span"><?= $basketItem["quantity"] ?></span>
                                        <a  class="btn-floating white basketItemAdd"><i data-basketItemId="<?= $basketItem["id"] ?>" class="material-icons grey-text">add</i></a>
                                    </div>
                                    <div class="basket-item-price">
                                        <?php if ($basketItem["sale_price"] === "0") {
                                            $totalUah += ($basketItem["price"] * intval($basketItem["quantity"]));
                                        ?>
                                            <span class="fontFat"><?= floatval($basketItem["price"]) * intval($basketItem["quantity"]) ?></span><span class="fontFat">₴</span>

                                        <?php } else {
                                            $totalUah += ($basketItem["sale_price"] * intval($basketItem["quantity"]));
                                        ?>
                                            <span class="textCross fontFat"><?= floatval($basketItem["price"]) * intval($basketItem["quantity"]) ?></span>
                                            <span class="red-text fontFat"> <?= floatval($basketItem["sale_price"]) * intval($basketItem["quantity"]) ?></span><span class="fontFat">₴</span>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#!" id="basketDeleteButton" class="basket-delete-img"><i data-basketItemId="<?= $basketItem["id"] ?>" class="material-icons">delete</i></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="col s12 m5 offset-m7 div_basket_sum">
                <span class="fontFat">Сума замовлення:  <?= $totalUah ?> ₴</span>
            </div>
            <div class="totalBasketDiv col s12 m4 offset-m8">
                
                <a id="buyBasketButton" class="waves-effect waves-light btn orange darken-3">Оформити замовлення</a>
            </div>
        <?php

        } else { ?>
            <div class="basket-empty-div">
                <img class="basket-empty-img" src="/img/basket_emp.png" alt="basket_empty"/>
                <h4>Кошик порожній</h4>
            </div>

        <?php } ?>
    </div>
</div>