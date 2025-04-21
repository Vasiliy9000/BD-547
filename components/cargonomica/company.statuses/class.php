
<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die;
}

use Bitrix\Crm\EntityRequisite;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Cargonomica\DataManager\Ebk\EbkProductTable;
use Cargonomica\DataManager\Ebk\EbkStatusTable;
use Cargonomica\Orm\Entity\Requisite\CompanyRequisiteType;

class CargonomicaCompanyStatusesComponent extends CBitrixComponent implements Controllerable
{
@@ -24,6 +26,7 @@ class CargonomicaCompanyStatusesComponent extends CBitrixComponent implements Co
        $params = Bitrix\Main\Context::getCurrent()->getRequest()->getPost("PARAMS");
        $this->arResult["company"] = EbkStatusTable::getStatusTableData($params['companyId']);
        $this->arResult['products'] = EbkProductTable::all();
        $this->getCompanyRequisitesInfo();
        ob_start();
        $this->includeComponentTemplate();
        $html = ob_get_clean();
@@ -31,4 +34,37 @@ class CargonomicaCompanyStatusesComponent extends CBitrixComponent implements Co
        $response->setContent($html);
        return $response;
    }

    /**
     * Метод для вывода сокращенного фио ип или ООО
     *
     * @see https://jira.cargonomica.com/browse/BD-547
     */
    protected function getCompanyRequisitesInfo(): void
    {
        $requisitesDbResult = (new EntityRequisite)
            ->getList([
                'select' => [
                    'RQ_INN',
                    'PRESET_ID',
                    'RQ_FIRST_NAME',
                    'RQ_SECOND_NAME',
                    'RQ_LAST_NAME',
                    'RQ_COMPANY_NAME',
                ],
                'filter' => [
                    '=RQ_INN' => array_keys($this->arResult['company']['inns']),
                ],
            ]);

        while ($requisite = $requisitesDbResult->fetch()) {
            $presetType = CompanyRequisiteType::tryFrom($requisite['PRESET_ID']);

            $secondName = $requisite['RQ_SECOND_NAME'] ? (mb_substr($requisite['RQ_SECOND_NAME'], 0, 1) . '. ') : '';
            $firstName = $requisite['RQ_FIRST_NAME'] ? (mb_substr($requisite['RQ_FIRST_NAME'], 0, 1) . '. ') : '';
            $lastName = $requisite['RQ_LAST_NAME'] ? ($requisite['RQ_LAST_NAME'] . ' ') : '';
            $shortName = $presetType === CompanyRequisiteType::individual() ? "ИП " . $lastName . $firstName . $secondName : $requisite['RQ_COMPANY_NAME'];
            $this->arResult['company']['inns'][$requisite['RQ_INN']]['shortName'] = $shortName;
        }
    }
}
