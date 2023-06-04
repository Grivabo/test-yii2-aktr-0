<?php
declare(strict_types = 1);
use app\components\BigActiveDataProvider;
use app\models\airportName\AirportName;
use app\models\trip\Trip;
use app\models\tripService\TripService;
use app\widgets\TripsIndexPageWidget\TripsIndexPageWidget;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\trip\TripSearch $searchModel */
/** @var yii\data\DataProviderInterface $dataProvider */

?>

<div class="trip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => TripsIndexPageWidget::EXT_FILTER_CSS_CLASS]
    ]) ?>

    <div class="container">
        <div class="row d-flex align-items-end">
            <div class="col-md-3">
                <?= $form->field($searchModel, 'corporateId')
                    ->widget(
                        Select2::class,
                        TripsIndexPageWidget::select2Params(
                            Trip::select2ParamCorporateId(),
                            $searchModel->corporateId,
                            Url::toRoute('trips/select2-search-corporate-id')
                        ))
                ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'serviceId')
                    ->widget(
                        Select2::class,
                        TripsIndexPageWidget::select2Params(
                            TripService::select2ParamServiceId(),
                            $searchModel->serviceId,
                            Url::toRoute('trips/select2-search-service-id')
                        ))
                ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'depAirportId')
                    ->widget(
                        Select2::class,
                        TripsIndexPageWidget::select2Params(
                            AirportName::select2ParamForAirportId(),
                            $searchModel->depAirportId,
                            Url::toRoute('trips/select2-search-dep-airport-id')
                        ))
                ?>
            </div>
            <div class="col-md-3">
                <?= $form
                    ->field($searchModel, 'isLightPagination')->checkbox()
                    ->hint('Only "next" button. Without correct total count.')
                ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'filterSelector' => '.' . TripsIndexPageWidget::EXT_FILTER_CSS_CLASS,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],
            'id',
            'corporate_id',
            'number',
            'user_id',
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
            'lastPageCssClass' => $dataProvider instanceof BigActiveDataProvider
                ? 'd-none'
                : 'last',
        ],
    ]) ?>

</div>