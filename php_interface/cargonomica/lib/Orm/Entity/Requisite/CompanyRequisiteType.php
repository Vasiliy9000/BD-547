<?php

namespace Cargonomica\Orm\Entity\Requisite;

use Spatie\Enum\Enum;

/**
 *  Перечисление возможных типов для getCompanyRequisitesInfo
 *
 * @method static self legal() ООО
 * @method static self individual() ИП
 */
class CompanyRequisiteType extends Enum
{
    protected static function values(): array
    {
        return [
            'legal' => 1,
            'individual' => 3,
        ];
    }
}
