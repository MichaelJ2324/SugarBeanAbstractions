<?php

namespace \Sugarcrm\Sugarcrm\custom\SugarObjects\Traits;

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
                    $query->set($field,$param)
                        ->setParameter($count, $this->$field);
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
                $query->setParameter($count, $this->$field);
                $count++;
            }
        }
        try{
            if ($count > 0){
                // _ppl($query->getSql());
                // _ppl($query->getParameters());
                $result = $query->execute();
                $this->call_custom_logic('after_quicksave',array(
                    'isUpdate' => $isUpdate,
                    'fields' => array_keys($fields)
                ));
                return $this->id;
            }
        }catch(\Exception $ex){
            $GLOBALS['log']->fatal("Exception occurred quick-saving record: ".$ex->getMessage());
        }
        return false;
    }
}