<div class="col s2 l3 main-leftside-div">
    <div class="basket_height">
        <div class="collection delete-margin">
            <?php foreach ([
                'cabinet' => ['Особисті дані', 'manage_accounts'],
                'orders' => ['Мої замовлення', 'fact_check'],
                'basketviewcab' => ['Кошик', 'shopping_cart']
            ] as $href => $nameArr) : ?>

                <a href=<?= $href ?> class="left-side-href collection-item <?= $uri == $href ? 'class="active"' : '' ?>">
                    <i class="material-icons text-vertical-middel"><?= $nameArr[1] ?></i>
                    <span class="text-vertical-middel left-side-table-text hide-on-med-only hide-on-small-only"><?= $nameArr[0] ?></span>
                </a>

            <?php endforeach ?>
        </div>
    </div>
</div>