<?php
declare(strict_types = 1);

namespace app\controllers;

use app\components\select2Helper\Select2Helper;
use app\models\airportName\AirportName;
use app\models\trip\Trip;
use app\models\trip\TripSearch;
use app\models\tripService\TripService;
use Throwable;
use yii\web\Controller;

/**
 * @class TripsController
 */
class TripsController extends Controller
{
    /**
     * Lists all Trip models.
     *
     * @return string
     * @throws Throwable
     */
    public function actionIndex(): string
    {
        $searchModel = new TripSearch();
        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * AJAX search.
     * @param string|null $id
     * @param string|null $q
     * @return array
     */
    public function actionSelect2SearchCorporateId(
        string $id = null,
        string $q = null
    ): array
    {
        return Select2Helper::forController(
            Trip::select2ParamCorporateId(),
            $id,
            $q
        );
    }

    /**
     * AJAX search.
     * @param string|null $id
     * @param string|null $q
     * @return array
     */
    public function actionSelect2SearchServiceId(
        string $id = null,
        string $q = null
    ): array
    {
        return Select2Helper::forController(
            TripService::select2ParamServiceId(),
            $id,
            $q
        );
    }

    /**
     * AJAX search.
     * @param string|null $id
     * @param string|null $q
     * @return array
     */
    public function actionSelect2SearchDepAirportId(
        string $id = null,
        string $q = null
    ): array
    {
        return Select2Helper::forController(
            AirportName::select2ParamForAirportId(),
            $id,
            $q
        );
    }
}
