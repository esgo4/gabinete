<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Acuerdos */

$this->title = 'Create Acuerdos';
$this->params['breadcrumbs'][] = ['label' => 'Acuerdos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acuerdos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
