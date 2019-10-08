<?php

require_once 'custom/include/SugarObjects/templates/bare/BareBean.php';
require_once 'custom/include/SugarObjects/templates/quick/traits/QuickSave.php';

class QuickBean extends BareBean
{
    use QuickSave {
        getQuickSaveFields as vardefQuickSavFields;
    }

    protected $quickSaveFields = array();

    protected function getQuickSaveFields()
    {
        $fields = $this->vardefQuickSavFields();
        if (!empty($this->quickSaveFields)){
            $fields = array_merge($fields,$this->quickSaveFields);
        }
        return $fields;
    }
}