<?php
/**
 * Created by PhpStorm.
 * User: nsign
 * Date: 16.05.18
 * Time: 16:33
 */

namespace tina\subscriber\grid;

use tina\subscriber\interfaces\ActiveAttributeInterface;
use yii\grid\DataColumn;

/**
 * Class ActiveColumn
 *
 * @package tina\subscriber\grid
 */
class ActiveColumn extends DataColumn
{
    /**
     * @var string
     */
    public $attribute = 'active';

    /**
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     *
     * @return string
     */
    public function getDataCellValue($model, $key, $index)
    {
        if ($this->value === null) {
            if ($model instanceof ActiveAttributeInterface) {
                return $model->getActive();
            }
        }

        return parent::getDataCellValue($model, $key, $index);
    }

    /**
     * @return string
     */
    protected function renderFilterCellContent()
    {
        if ($this->filter === null) {
            $filterModel = $this->grid->filterModel;
            if ($filterModel instanceof ActiveAttributeInterface) {
                $this->filter = $filterModel::getActiveList();
            }
        }
        return parent::renderFilterCellContent();
    }
}