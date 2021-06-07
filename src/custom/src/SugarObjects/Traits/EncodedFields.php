<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;


trait EncodedFields
{
    protected $_encoded_fields = array();

    /**
     * @param $field
     * @param $encoding
     */
    public function setFieldAsEncoded($field,$encoding = true)
    {
        $this->_encoded_fields[$field] = $encoding;
    }

    /**
     *
     * @param $field
     * @param $encoding
     * @return bool
     */
    public function fieldEncoded($field,$encoding = null)
    {
        $encoded = array_key_exists($field,$this->_encoded_fields);
        if ($encoded && $encoding){
            return $this->_encoded_fields[$field] == $encoding;
        }
        return $encoded;
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