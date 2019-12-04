<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;

trait JsonEncodedFields
{
    use EncodedFields;

    /**
     * @param $value
     * @return false|int
     */
    public function isJsonString($value)
    {
        return preg_match("(^[\{].*[\}]$)|(^[\[].*[\]]$)", $value);
    }

    /**
     * @param $field
     * @param $value
     */
    public function jsonEncodeField($field,$value)
    {
        if (!$this->fieldEncoded($field)) {
            if (is_object($value) || is_array($value)) {
                $value = json_encode($value);
            }
            $this->$field = $value;
        }
    }

    /**
     * @param $field
     */
    public function jsonDecodeField($field)
    {
        if ($this->fieldEncoded($field)) {
            if ($this->isJsonString($this->$field)){
                $this->$field = json_decode($this->$field,true);
            }
        }
    }
}