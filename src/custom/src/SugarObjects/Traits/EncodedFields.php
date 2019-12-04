<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;


trait EncodedFields
{
    protected $_encoded_fields = array();

    /**
     * @param $field
     */
    public function setFieldAsEncoded($field)
    {
        $this->_encoded_fields[$field] = true;
    }

    /**
     *
     * @param $field
     * @return bool
     */
    public function fieldEncoded($field)
    {
        return array_key_exists($field,$this->_encoded_fields);
    }

    /**
     * @param $field
     */
    public function unsetFieldAsEncoded($field)
    {
        if (isset($this->_encoded_fields[$field])){
            unset($this->_encoded_fields[$field]);
        }
    }

}