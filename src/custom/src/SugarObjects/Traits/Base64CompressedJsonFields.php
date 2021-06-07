<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;

trait Base64CompressedJsonFields
{
    use EncodedFields;

    /**
     * @param $value
     * @return false|int
     */
    public function isJsonString($value)
    {
        return !!preg_match("/(^[\{].*[\}]$)|(^[\[].*[\]]$)/", $value);
    }

    /**
     * @param $field
     * @param $value
     */
    protected function jsonEncodeField($field,$value)
    {
        if (!$this->fieldEncoded($field)) {
            if (is_object($value) || is_array($value)) {
                $value = json_encode($value);
            }
            $this->$field = $value;
            $this->setFieldAsEncoded($field,'json');
        }
    }

    /**
     * @param $field
     */
    protected function jsonDecodeField($field)
    {
        if ($this->fieldEncoded($field,'json')) {
            if ($this->isJsonString($this->$field)){
                $this->$field = json_decode($this->$field,true);
            }
            $this->unsetFieldAsEncoded($field);
        }
    }

    /**
     * @param $field
     */
    protected function base64EncodeField($field,$value)
    {
        if (!$this->fieldEncoded($field,'base64') && $this->fieldEncoded($field,'gz')){
            $this->$field = base64_encode($value);
            $this->setFieldAsEncoded($field,'base64');
        }
    }

    /**
     *
     * @param $field
     */
    protected function base64UnencodeField($field)
    {
        if ($this->fieldEncoded($field,'base64')){
            $this->$field = base64_decode($this->$field);
            $this->setFieldAsEncoded($field,'gz');
        }
    }

    /**
     * @param $field
     * @param $value
     */
    protected function gzipCompressField($field,$value)
    {
        if (!$this->fieldEncoded($field,'gz') && $this->fieldEncoded($field,'json')) {
            $this->$field = gzdeflate($value);
            $this->setFieldAsEncoded($field,'gz');
        }
    }

    /**
     * @param $field
     */
    protected function gzipDecompressField($field)
    {
        if ($this->fieldEncoded($field,'gz')) {
            $this->$field = gzinflate($this->$field);
            $this->setFieldAsEncoded($field,'json');
        }
    }

    /**
     * @param $field
     * @param $value
     * @throws \Exception
     */
    public function compressField($field,$value)
    {
        if (!$this->fieldEncoded($field,'base64')){
            if (is_string($value)){
                $this->$field = $value;
                $this->setFieldAsEncoded($field,'json');
            } else {
                $this->jsonEncodeField($field,$value);
            }
            $this->gzipCompressField($field,$this->$field);
            $this->base64EncodeField($field,$this->$field);
        }
    }

    /**
     * @param $field
     */
    public function decompressField($field)
    {
        $this->base64UnencodeField($field);
        $this->gzipDecompressField($field);
        $this->jsonDecodeField($field);
    }
}
