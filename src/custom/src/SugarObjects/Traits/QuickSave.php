<?php

namespace Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;

trait QuickSave
{
    /**
     * Retrieve an array of the fields and their values (or parameters) for QuickSave query
     * @return array
     */
    protected function getQuickSaveFields()
    {
        $fields = array();
        foreach ($this->field_defs as $field => $props){
            if (isset($props['quickSave']) && $props['quickSave'] === true){
                $fields[$field] = '?';
            }
        }
        return $fields;
    }

    /**
     * Perform a QuickSave
     * @return string|false
     */
    public function quickSave()
    {
        $isUpdate = $this->isUpdate();

        $conn = $this->db->getConnection();
        $qb = $conn->createQueryBuilder();
        
        $fields = $this->getQuickSaveFields();

        $field = $this->getModifiedDateField();
        if ($field !== false) {
            $this->setModifiedDate();
            $fields[$field] = '?';
        }
        $field = $this->getModifiedUserField();
        if ($field !== false) {
            $this->setModifiedUser();
            $fields[$field] = '?';
        }

        if ($isUpdate){
            $query = $qb->update($this->table_name);
            $count = 0;
            foreach($fields as $field => $param)
            {
                if (isset($this->$field)){
                    $value = $this->$field;
                    if ($value === true || $value === false){
                        $value = intval($value);
                    }
                    $query->set($field,$param)
                        ->setParameter($count, $value);
                    $count++;
                }
            }
            $query->where('id = ?')->setParameter($count+1,$this->id);
        } else {
            $this->setCreateData($isUpdate);
            $fields['id'] = '?';

            $field = $this->getCreatedDateField();
            if ($field !== false) {
                $fields[$field] = '?';
            }
            $field = $this->getCreatedUserField();
            if ($field !== false) {
                $fields[$field] = '?';
            }
            $validFields = array();
            foreach($fields as $field => $param)
            {
                if (isset($this->$field)) {
                    $validFields[$field] = $param;
                }
            }
            $query = $qb->insert($this->table_name)
                ->values(
                    $validFields
                );
            $count = 0;
            foreach($validFields as $field => $param)
            {
                $value = $this->$field;
                if ($value === true || $value === false){
                    $value = intval($value);
                }
                $query->setParameter($count, $value);
                $count++;
            }
        }
        try{
            if ($count > 0){
                if ($this->logQuickSave()){
                    $logger = \Sugarcrm\Sugarcrm\Logger\Factory::getLogger('quick_save');
                    $logger->debug("Quick Save SQL: ".
                        vsprintf(str_replace("?","%s",$query->getSql()),
                            array_walk($query->getParameters(),array($this->db,'quoted'))));
                }
                $result = $query->execute();
                $this->call_custom_logic('after_quicksave',array(
                    'isUpdate' => $isUpdate,
                    'fields' => array_keys($fields)
                ));
                return $this->id;
            }
        }catch(\Exception $ex){
            $GLOBALS['log']->fatal("Exception occurred quick-saving record: ".$ex->getMessage());
            $logger = \Sugarcrm\Sugarcrm\Logger\Factory::getLogger('quick_save');
            $logger->debug($ex->getTraceAsString());
        }
        return false;
    }

    /**
     * Check if quick_save channel is even configured
     * @return bool
     */
    private function logQuickSave()
    {
        if (isset($sugar_config['logger']['channels']['quick_save'])){
            return true;
        }
        return false;
    }
}