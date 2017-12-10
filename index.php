<?php
$json = file_get_contents("./data.json");
$arr = json_decode($json, true);
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="тарифы">
    <title>Тарифы</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Font Awesome embed -->
    <script src="https://use.fontawesome.com/0ad2a36b68.js"></script>
</head>

<header>
    <h1>Выбор тарифа</h1>
</header>

<div class="container">
<?php foreach ($arr['tarifs'] as $tarif) { ?>

    <?php
    /* Определяем id для каждого тарифа */
        switch ($tarif['title']) {
            case 'Эконом':
                $id = 'earth';
                break;
            case 'Профи':
                $id = 'water';
                break;
            case 'Эксперт':
                $id = 'fire';
                break;
            case 'Профи HD':
                $id = 'water-hd';
                break;
            case 'Эксперт HD':
                $id = 'fire-hd';
                break;
        }
    ?>

    <?php /*Блок тарифа*/ ?>
    <div class="tarif" id="<?=$id?>">

    <?php /*Заголовок тарифа*/ ?>
    <div class="tarif-title">
        <p id="<?=$id . "-prev"?>" class="arrow-prev" data-prev-target="<?=$id . "-main"?>" data-loc="<?=$id?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></p>
        <p id="<?=$id . "-prev-sub"?>" class="arrow-prev-sub" data-prev-sub-target="<?=$id . "-sub"?>" data-loc="<?=$id?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></p>
        <h2>Тариф "<?=$tarif['title']?>"</h2>
    </div>

    <?php /*Средняя часть - основная*/ ?>
    <div class="tarif-info" id="<?=$id . "-main"?>">
        <div class="info-main">

            <p class="speed"><?=$tarif['speed']?> Мбит/с</p>
            <p class="prices">от 350 рублей/мес</p>
            <div class="free-options">
                <?php
                if (isset($tarif['free_options'])) {
                    foreach ($tarif['free_options'] as $option) { ?>
                        <p><?=$option?></p>
                    <?php }
                } ?>
            </div>

        </div>
        <p id="<?=$id . "-next"?>" class="arrow-next" data-target-block="<?=$id?>-sub" data-loc="<?=$id?>">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </p>

    </div>

    <?php /*Средняя часть - варианты тарифов*/ ?>
    <div class="sub-tarifs hidden-by-default" id="<?=$id . "-sub"?>">
        <ul>
            <?php foreach ($tarif['tarifs'] as $subtarif) { ?>

                <?php
                /* Пишем правильно! */
                $months = $subtarif['pay_period'];
                $price = $subtarif['price'];
                $price_add = $subtarif['price_add'];
                $time = substr(($subtarif['new_payday']), 0, 10);
                switch ($months) {
                    case '1':
                        $m_out = "месяц";
                        break;
                    case '3':
                        $m_out = "месяца";
                        break;
                    case '6':
                        $m_out = "месяцев";
                        break;
                    case '12':
                        $m_out = "месяцев";
                        break;
                }
                $m_price = $price/intval($months);
                ?>

            <li>
                <div class="tarif-months" id="<?=$id?>-months-<?=$months?>">
                    <div class="tarif-variant">
                        <h3><?=$months?> <?=$m_out?></h3>
                        <p><?=$m_price?> рублей/мес</p>
                        <p>разовый платёж — <?=$subtarif['price']?> рублей</p>
                    </div>
                    <p id="<?=$id . "-tarif"?>" class="arrow-next" data-tarif-sel="<?=$id?>-sel-<?=$months?>" data-loc="<?=$id?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></p>
                </div>
                <div class="tarif-selected hidden-by-default" id="<?=$id?>-sel-<?=$months?>">
                    <section class="first">
                        <p>Период оплаты — <?=$months?> <?=$m_out?></p>
                        <p><?=$m_price?> рублей/мес</p>
                    </section>
                    <section class="second">
                        <p>разовый платёж — <?=$price?> рублей</p>
                        <p>со счёта спишется — <?=$price + $price_add?> рублей</p>
                    </section>
                    <section class="third">
                        <p>вступит в силу — сегодня</p>
                        <p>активно до — <?=date('d.m.Y', $time)?></p>
                    </section>
                    <hr>
                    <button class="select-tarif">Выбрать</button>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>

    <p class="site" id="<?=$id . "-link"?>"><a href="<?=$tarif['link']?>">узнать подробнее на сайте</a></p>
    </div>
<?php } ?>
</div>

<script type="text/javascript" src="./js/script.js"></script>
</html>