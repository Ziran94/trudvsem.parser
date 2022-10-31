<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <div class="d-flex">
            <div class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="/">trudvsem.parser</a>

                    <?php
                    $menuItems = [
                        ['label' => 'Контакты', 'url' => ['/site/index']],
                        ['label' => 'Архив', 'url' => ['/site/about']],
                        ['label' => 'Настройки', 'url' => ['/site/contact']],
                    ];
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
                        'items' => $menuItems,
                    ]);
                    ?>
                    <div class="d-flex flex-column">
                        <button class="btn btn-outline-info mb-2">Добавить контакты</button>
                        <button class="btn btn-success mb-2">Запустить парсер</button>
                    </div>
                </div>
            </div>
            <div class="page-wpapper">
                <?= $content ?>
            </div>
        </div>
    </div>
</main>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
