<?php
declare(strict_types = 1);

use app\widgets\TripsIndexPageWidget\TripsIndexPageWidget;

/** @var yii\web\View $this */
/** @var app\models\trip\TripSearch $searchModel */
/** @var yii\data\DataProviderInterface $dataProvider */

$this->title = 'Trips';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= TripsIndexPageWidget::widget(compact('searchModel', 'dataProvider')) ?>