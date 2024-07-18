<?php
include_once "data/DbUserCabinet.php" ;
$user;
$isUser = isset($_SESSION['user']);

if (isset($_SESSION['user'])) {
  
    $user = (new DbUserCabinet())->Db_GetUser($_SESSION['user']['id']);
}
?>
<div class="row">
    <?php include 'cab_menu.php'; ?>
    <div class="col s10 l9">
        <ul class="collapsible popout delete-margin grey-text text-darken-3">
            <li>
                <div class="collapsible-header"><i class="material-icons">contact_page</i>Особисті дані</div>
                <div class="collapsible-body">
                    <div class="">
                        <form method="post">
                            <div class="row">
                                <div class="input-field col m12 l6">
                                    <i class="material-icons prefix">badge</i>
                                    <input type="text" name="user-cabinet-name" value="<?= ($isUser) ? $user["user_name"] : ""  ?>" class="">
                                    <!-- <label for="icon_prefix">ім'я</label> -->
                                    <span class="helper-text" data-error="Це необхідн.е поле" data-success="Правильно">ім'я</span>
                                </div>
                                <div class="input-field col m12 l6">
                                    <i class="material-icons prefix">drive_file_rename_outline</i>
                                    <input type="text" name="user-cabinet-surname" value="<?= ($isUser) ? $user["surname"] : ""  ?>" class="">
                                    <!-- <label for="icon_prefix">Прізвище</label> -->
                                    <span class="helper-text" data-error="Це необхідне поле" data-success="Правильно">Прізвище</span>
                                </div>
                                <div class="input-field col 12">
                                    <button type="button" id="name-cabinet-button" class="btn orange darken-2">Редагувати</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">account_box</i>Аватар</div>
                <div class="collapsible-body ">
                    <div class="row">
                        <div class="cab_avatar_border col m5">
                            <img src="/avatar/<?php
                                            if ($isUser) {
                                                echo ((($user["avatar"] != "") ? $user["avatar"] : "No-Image.jpg"));
                                            } else {
                                                echo("No-Image.jpg");
                                            }
                                            ?>" alt="avatar" />
                        </div>
                        <div class="col m7">
                            <div class="file-field input-field cab_avatar_file">
                                <div class="btn orange darken-2">
                                    <i class="material-icons">photo</i>
                                    <input id="avatar_cabinet_input" type="file" name="user-avatar">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Аватарка">
                                </div>
                            </div>
                            <button type="button" id="avatar-cabinet-button" class="btn orange darken-2">Редагувати</button>
                        </div>

                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">home</i>Адреса доставки</div>
                <div class="collapsible-body">

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea id="user_address_cab_text" class="materialize-textarea" ><?= ($isUser) ? $user["address"] : ""  ?></textarea>
                            <label for="icon_prefix2">Address</label>
                        </div>
                    </div>
                    <div class="row">
                        <button type="button" id="address-cabinet-button" class="btn orange darken-2 btn_cab_margin_10px">Редагувати</button>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">contacts</i>Контакти</div>
                <div class="collapsible-body">
                    <div class="">
                        <form method="post">
                            <div class="row">
                                <div class="input-field col m12 l6">
                                    <i class="material-icons prefix">email</i>
                                    <input type="text" name="user-cabinet-email" class="" value="<?= ($isUser) ? $user["email"] : ""  ?>">
                                    <!-- <label for="icon_prefix">ім'я</label> -->
                                    <span class="helper-text" data-error="Це необхідне поле" data-success="Правильно">Електронна пошта</span>
                                </div>
                                <div class="input-field col m12 l6">
                                    <i class="material-icons prefix">phone</i>
                                    <input type="text" name="user-cabinet-phone" class="" value="<?= ($isUser) ? $user["phone"] : ""  ?>">
                                    <!-- <label for="icon_prefix">Прізвище</label> -->
                                    <span class="helper-text" data-error="Це необхідне поле" data-success="Правильно">Іелефон</span>
                                </div>
                                <div class="input-field col 12">
                                    <button type="button" id="contact-data-cabinet-button" class="btn orange darken-2">Редагувати</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>