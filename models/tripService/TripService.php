<?php
declare(strict_types = 1);

namespace app\models\tripService;

use app\components\select2Helper\Select2ParamDto;

/**
 * @inheritDoc
 */
class TripService extends TripServiceAR
{
    /**
     * For AJAX search.
     * @return Select2ParamDto
     */
    public static function select2ParamServiceId(): Select2ParamDto
    {
        return new Select2ParamDto(
            class: static::class,
            idFieldName: 'service_id',
            textFieldName: 'service_id',
        );
    }
}