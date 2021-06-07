<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;


trait EncryptFields
{
    /**
     * Encrypted fields
     * @var array
     */
    protected $encfields;

    /**
     * Plain text encrypted fields
     * @var array
     */
    protected $encfields_plain;

    /**
     * Set the plain text encrypted field property
     * @param $field
     * @param $value
     * @return self
     */
    public function setEncryptedField($field,$value)
    {
        $this->$field = $value;
        return $this->resetEncryptedField($field);
    }

    /**
     * Reset the encfield properties stating the field is in a plaintext state
     * @param $field
     * @return self
     */
    public function resetEncryptedField($field)
    {
        unset($this->encfields_plain[$field]);
        unset($this->encfields[$field]);
        return $this;
    }

    /**
     * Encrypt an encrypted field
     * Register value in encfields property
     * @param string $field
     * @param string $value
     * @return self
     */
    public function encryptField($field)
    {
        $value = $this->$field;
        if (isset($this->encfields_plain[$field])){
            $value = $this->encfields_plain[$field];
        }
        $this->$field = $this->encrpyt_before_save($value);
        $this->encfields[$field] = $this->$field;
        return $this;
    }

    /**
     * Decrypt an encrypted field
     * Register value in encfield_plain property
     * @param string $field
     * @return self
     */
    public function decryptField($field)
    {
        $value = $this->$field;
        if (isset($this->encfields[$field])){
            $value = $this->encfields[$field];
        }
        $this->$field = $this->decrypt_after_retrieve($value);
        $this->encfields_plain[$field] = $this->$field;
        return $this;
    }
}