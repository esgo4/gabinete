<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Minutas */

$this->title = 'Create Minutas';
$this->params['breadcrumbs'][] = ['label' => 'Minutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minutas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
