<?php
declare(strict_types = 1);

namespace app\models\airportName;

use app\components\select2Helper\Select2ParamDto;

/**
 * @inheritDoc
 */
class AirportName extends AirportNameAR
{
    /**
     * For AJAX search.
     * @return Select2ParamDto
     */
    public static function select2ParamForAirportId(): Select2ParamDto
    {
        return new Select2ParamDto(
            class: static::class,
            idFieldName: 'airport_id',
            textFieldName: 'value',
        );
    }
}