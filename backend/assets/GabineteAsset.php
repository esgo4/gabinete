<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class GabineteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'thema/css/vendors.bundle.css',
        'thema/css/app.bundle.css',
        'thema/css/datagrid/datatables/datatables.bundle.css',    
        //'css/csmap.css',
    ];
    public $js = [
        'js/modal-popup.js',
        'tinymce/tinymce.min.js',
        'js/funciones.js',
     //   'thema/js/vendors.bundle.js',
        'thema/js/app.bundle.js',
        'thema/js/statistics/peity/peity.bundle.js',
        'thema/js/statistics/flot/flot.bundle.js',
        'thema/js/statistics/easypiechart/easypiechart.bundle.js',
        'thema/js/datagrid/datatables/datatables.bundle.js',
        'theme/js/statistics/chartjs/chartjs.bundle.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
