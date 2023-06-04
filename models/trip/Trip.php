<?php
declare(strict_types = 1);

namespace app\models\trip;

use app\components\select2Helper\Select2ParamDto;

/**
 * @inheritDoc
 */
class Trip extends TripAR
{
    /**
     * For AJAX search.
     * @return Select2ParamDto
     */
    public static function select2ParamCorporateId(): Select2ParamDto
    {
        return new Select2ParamDto(
            class: static::class,
            idFieldName: 'corporate_id',
            textFieldName: 'corporate_id',
        );
    }
}