<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;

trait GzipCompressedFields
{
    use EncodedFields;

    /**
     * @param $field
     * @param $value
     */
    public function gzipCompressField($field,$value)
    {
        if (!$this->fieldEncoded($field)) {
            if (is_string($value)) {
                $value = gzdeflate($value);
            }
            $this->$field = $value;
        }
    }

    /**
     * @param $field
     */
    public function gzipDecompressField($field)
    {
        if ($this->fieldEncoded($field,'gz')) {
            $this->$field = gzinflate($this->$field);
        }
    }
}