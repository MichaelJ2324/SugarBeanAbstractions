<?php

require_once 'custom/include/SugarObjects/templates/bare/BareBean.php';

use \Sugarcrm\Sugarcrm\custom\SugarObjects\Traits\QuickSave;

class QuickBean extends BareBean
{
    use QuickSave {
        getQuickSaveFields as vardefQuickSavFields;
    }

    /**
     * @var array
     */
    protected $quickSaveFields = array();

    /**
     * Get the Quick Save fields
     * @return array
     */
    protected function getQuickSaveFields()
    {
        $fields = $this->vardefQuickSavFields();
        if (!empty($this->quickSaveFields)){
            $fields = array_merge($fields,$this->quickSaveFields);
        }
        return $fields;
    }
}