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
foreach ($basketItems as $basketItem) :

  if ($basketItem["sale_price"] === "0") {
    $totalUah += ($basketItem["price"] * intval($basketItem["quantity"]));
  } else {
    $totalUah += ($basketItem["sale_price"] * intval($basketItem["quantity"]));
  }
endforeach;
?>

<!doctype html>
<html>

<head>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <!--Import Google Icon Font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WebStore</title>
    <link rel="stylesheet" href="/css/site.css" />
</head>

<body>

    <header>

        <nav>
            <div class="nav-wrapper white check_nav_div">
                <a href="/" class="brand-logo left"><img src="/img/webshop-logo.png" /></a>

            </div>
        </nav>

        </div>

        <main class="container">
            <form>
                <div class="row">
                    <div class="col m8">
                        <div class="row">
                            <div class="col m12">
                                <h3>Оформлення замовлення</h3>
                                <div class="row">
                                    <div class="col s12">
                                        <span class="font_style_2">Ваші контактні дані</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <input id="check_first_name" type="text" class="validate">
                                        <label for="check_first_name">Ім'я</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input id="check_last_name" type="text" class="validate">
                                        <label for="check_last_name">Прізвище</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <input id="check_email" type="text" class="validate">
                                        <label for="check_email">Електронна пошта</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input id="check_phone" type="text" class="validate">
                                        <label for="check_phone">Мобільний телефон</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="check_address" type="text" class="validate">
                                        <label for="check_address">Адреса</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m12 div_space_between">
                                <span class="font_style_2">Замовлення</span>
                                <div class="div_vertical_center">
                                    <span>на суму:</span>
                                    <span class="font_bolt_2 margin_left_10"><?= $totalUah ?> ₴</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m12 paddingNull">
                                <?php if ($basketItems != null) { ?>
                                <ul class="basket-ul">
                                    <?php foreach ($basketItems as $basketItem) : ?>
                                    <li class="row white ">
                                        <div class="col s12 m3 l3 basket-item-image-div">
                                            <img class="basket_item_image"
                                                src="/img/item/<?= $basketItem["image_name"] ?>"
                                                alt="<?= $basketItem["image_name"] ?>">
                                        </div>
                                        <div data-itemId="<?= $basketItem["id"] ?>"
                                            class="col s12 m9 l9 basket-item-div">
                                            <div class="marg_right_5">
                                                <span class="title"><?= $basketItem["item_name"] ?></span>
                                                <!-- <p><?= $basketItem["itemName"] ?></p> -->
                                                <div class="basket-quantity-div">
                                                    <div class="basket-item-quantity">
                                                        <a class="btn-floating white basketItemSub"><i
                                                                data-basketItemId="<?= $basketItem["id"] ?>"
                                                                class="material-icons grey-text">remove</i></a>
                                                        <span
                                                            class="basket-quantity-span"><?= $basketItem["quantity"] ?></span>
                                                        <a class="btn-floating white basketItemAdd"><i
                                                                data-basketItemId="<?= $basketItem["id"] ?>"
                                                                class="material-icons grey-text">add</i></a>
                                                    </div>
                                                    <div class="basket-item-price">
                                                        <?php if ($basketItem["sale_price"] === "0") { ?>
                                                        <span
                                                            class="fontFat"><?= floatval($basketItem["price"]) * intval($basketItem["quantity"]) ?></span><span
                                                            class="fontFat">₴</span>

                                                        <?php } else { ?>
                                                        <span
                                                            class="textCross fontFat"><?= floatval($basketItem["price"]) * intval($basketItem["quantity"]) ?></span>
                                                        <span class="red-text fontFat">
                                                            <?= floatval($basketItem["sale_price"]) * intval($basketItem["quantity"]) ?></span><span
                                                            class="fontFat">₴</span>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#!" id="basketDeleteButton" class="basket-delete-img"><i
                                                data-basketItemId="<?= $basketItem["id"] ?>"
                                                class="material-icons">delete</i></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>

                                <?php

                } else { ?>
                                <div class="basket-empty-div">
                                    <img class="basket-empty-img" src="/img/basket_emp.png" alt="basket_empty" />
                                    <h4>Кошик порожній</h4>
                                </div>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m12">
                                <div>
                                    <span class="font_style_2">Коментар до замовлення</span>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <textarea id="check_comment" class="materialize-textarea"></textarea>
                                <label for="check_comment">Коментар</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m12">
                                <div>
                                    <span class="font_style_2">Доставка</span>
                                </div>
                                <p>
                                    <label>
                                        <input name="checkout_shipment" type="radio" value="Самовивіз з Нової Пошти"
                                            checked />
                                        <span>Самовивіз з Нової Пошти</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="checkout_shipment" type="radio" value="Кур'єр на вашу адресу" />
                                        <span>Кур'єр на вашу адресу</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m12">
                                <div>
                                    <span class="font_style_2">Оплата</span>
                                </div>
                                <p>
                                    <label>
                                        <input name="checkout_payment" type="radio" checked
                                            value="Оплата під час отримання товару" />
                                        <span>Оплата під час отримання товару</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input name="checkout_payment" type="radio" value="Оплата карткою" />
                                        <span>Оплата карткою</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col m4">
                        <div class="row">
                            <div class="col s12">
                                <div class="div_border_amaunt ">
                                    <div class="row">
                                        <div class="col s12">
                                            <span class="font_style_2 font_bolt_2">Разом</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="div_space_between font_style_3">
                                                <span>товари на суму</span>
                                                <span class="font_bolt_2"><?= $totalUah ?> ₴</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="div_space_between font_style_3 margin_top_10">
                                                <div class="div_vertical_center">
                                                    <span>До сплати</span>
                                                </div>
                                                <span class="font_bolt_2 font_style_2"><?= $totalUah ?> ₴</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col s12">
                                            <div>
                                                <a id="checkout_button"
                                                    class="waves-effect waves-light btn orange darken-3 width_100 checkout_button">Замовлення
                                                    підтверджую</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="font_style_4">
                                                <span>
                                                    Отримання замовлення від 5 000 ₴ - 30 000 ₴ за наявності документів.
                                                    При
                                                    оплаті готівкою від 30 000 ₴ необхідно надати документи для
                                                    верифікації
                                                    згідно вимог Закону України від 06.12.2019 №361-IX
                                                </span>
                                                <span>
                                                    Підтверджуючи замовлення, я приймаю умови:
                                                </span>
                                                <ul class="li_space_10">
                                                    <li>положення про обробку і захист персональних даних</li>
                                                    <li>угоди користувача</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <footer>
            <div>
                <div class="footerLine">

                </div>
                <div class="row">
                    <div class="col s12 m3 l2">
                        <a href="/" class="brand-logo left"><img src="/img/webshop-logo.png" /></a>
                    </div>
                    <div class="col s12 m3 l3 push-l2 headerSpanDiv">
                        <span>Час роботи Call-центру</span>
                        <span>Пн.-Пт.: 08:00 - 22:00</span>
                        <span>Сб.: 09:00 - 20:00</span>
                        <span>Нд.: 09:00 - 19:00</span>
                    </div>
                    <div class="col s12 m3 l4 push-l3 headerSpanDiv">
                        <span>Тел.+ 38 (044) 111-11-11</span>
                        <span>e-mail: <a href="#"> info@WebStore.ua</a></span>
                        <span>© 2008-2024 Інтернет-магазин «WebStore»</span>
                        <span>Знак на товари і послуги WebStore використовується </span>
                        <span>на підставі ліцензійного договору з правовласником знака</span>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Modal Structure -->
        <?php
    if (isset($_SESSION['user'])) {
      echo ('
    <ul id="dropdownUserAuth" class="dropdown-content">
      <li><a href="/cabinet"><i class="material-icons">other_houses</i>Кабінет</a></li>
      <li class="divider" tabindex="1"></li>
      <li><a id="signout-button"><i class="material-icons">logout</i>Вийти</a></li>
    </ul>
    ');
    }
    ?>
        <div id="auth-modal" class="modal login-wind modal-login">
            <div class="col s12" method="post" asp-action="/">
                <div class="modal-content mymodel">
                    <h4 class="mymodel center-align"><span class="teal-text">LOG IN</span></h4>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="user-input-email" type="text" class="validate" name="auth-email">
                        <label for="user-input-email">Email</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">lock</i>
                        <input id="user-input-password" type="password" class="validate" name="auth-password">
                        <label for="user-input-password">Password</label>
                    </div>
                    <button class="btn-flat teal waves-light button-ligin-enter white-text"
                        id="auth-button">Вхід</button>
                    <button class="modal-close btn-floating grey button-ligin-exit material-icons">close</button>
                    <div class="registr-button">
                        <a href="/signup">Зареєструватися</a>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="/js/site.js"></script>

</body>

</html>