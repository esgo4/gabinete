<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Avances */

$this->title = 'Create Avances';
$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avances-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
