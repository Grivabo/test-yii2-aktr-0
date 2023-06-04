<?php
declare(strict_types = 1);

namespace app\components\select2Helper;

use yii\db\ActiveRecord;

/**
 * @see Select2Helper
 * @see Select2
 */
readonly class Select2ParamDto
{
    /**
     * @param class-string<ActiveRecord> $class
     * @param string $idFieldName
     * @param string $textFieldName
     */
    public function __construct(
        public string $class,
        public string $idFieldName,
        public string $textFieldName,
    )
    {
    }
}