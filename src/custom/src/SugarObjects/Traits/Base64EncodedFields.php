<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;


trait Base64EncodedFields
{
    use JsonEncodedFields;

    /**
     * @param $field
     */
    public function base64EncodeField($field,$value)
    {
        if (!$this->fieldEncoded($field)){
            if (is_object($value) || is_array($value)){
                $this->jsonEncodeField($field,$value);
                $value = $this->$field;
            }
            $this->$field = base64_encode($value);
            $this->setFieldAsEncoded($field);
        }
    }

    /**
     *
     * @param $field
     */
    public function base64UnencodeField($field)
    {
        if ($this->fieldEncoded($field)){
            $this->$field = base64_decode($this->$field);
            $this->jsonDecodeField($field);
            $this->unsetFieldAsEncoded($field);
        }
    }

}