<?php

use Sugarcrm\Sugarcrm\custom\Support\FileHelpers;

require_once 'custom/include/SugarObjects/templates/bare/BareBean.php';

class BareFileBean extends BareBean
{
    protected static $_upload_directory = '';

    public $uploadfile;
    public $filename;
    public $file_mime_type;
    public $file_ext;
    public $hash;

    /**
     * @see SugarBean::save()
     */
    public function save($check_notify=false)
    {
        if (!empty($this->uploadfile)) {
            $this->filename = $this->uploadfile;
        }

        return parent::save($check_notify);
    }

    /**
     * @see SugarBean::fill_in_additional_detail_fields()
     */
    public function fill_in_additional_detail_fields()
    {
        $this->uploadfile = $this->filename;

        // Bug 41453 - Make sure we call the parent method as well
        return parent::fill_in_additional_detail_fields();
    }

    /**
     * @inheritdoc
     */
    public function retrieve($id = -1, $encode = true, $deleted = true)
    {
        $return = parent::retrieve($id, $encode, $deleted);
        $this->uploadfile = $this->filename;
        return $return;
    }

    /**
    * @param $id
    * @return false|string
    * @throws SugarQueryException
    */
    public static function getHash($id)
    {
        $SugarQuery = new SugarQuery();
        $SugarQuery->from(new static());
        $SugarQuery->select(array('hash'));
        $SugarQuery->where()->equals('id', $id);
        $hash = $SugarQuery->getOne();
        return $hash;
    }

    /**
     * @return string
     */
    public static function uploadsDirectory()
    {
        return FileHelpers::getUploadStream(static::$_upload_directory);
    }

    /**
     * @return string
     */
    public function getUploadFile($stream = false)
    {
        $streamPath = static::uploadsDirectory().$this->getFileIdentifier();
        if ($stream){
            return $streamPath;
        }
        return FileHelpers::convertUploadStream($streamPath);
    }

    /**
     * @return string
     */
    public function getFileIdentifier()
    {
        return $this->hash;
    }

    /**
     * Method to delete an attachment
     *
     * @param string $isduplicate
     * @return bool
     */
    public function deleteAttachment($isduplicate = "false")
    {
        if ($this->ACLAccess('edit')) {
            if ($isduplicate == "true") {
                return true;
            }
            $removeFile = $this->getUploadFile();
        }
        if (isset($removeFile) && file_exists($removeFile) && !$this->fileExistsForOtherRecords()) {
            if (!unlink($removeFile)) {
                $GLOBALS['log']->error("*** Could not unlink() file: [ {$removeFile} ]");
            } else {
                $this->uploadfile = '';$this->uploadfile = '';
                $this->filename = '';
                $this->file_mime_type = '';
                $this->file_ext = '';
                $this->hash = '';
                $this->save();
                return true;
            }
        } else {
            $this->uploadfile = '';
            $this->filename = '';
            $this->file_mime_type = '';
            $this->file_ext = '';
            $this->hash = '';
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * @return bool
     * @throws SugarQueryException
     */
    public function fileExistsForOtherRecords()
    {
        $SugarQuery = new SugarQuery();
        $SugarQuery->from(new static());
        $SugarQuery->select(array('id'));
        $SugarQuery->where()->equals('hash', $this->hash)->notEquals('id', $this->id);
        $id = $SugarQuery->getOne();
        return !empty($id);
    }
}