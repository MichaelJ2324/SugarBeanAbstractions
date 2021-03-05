<?php

require_once 'custom/include/SugarObjects/templates/bare/BareBean.php';

class AutoIncrementBean extends BareBean
{
    public $id = null;

    /**
     * If not an Update set ID to null, since it autoincrements
     * @param bool $isUpdate
     * @param User|null $user
     */
    public function setCreateData($isUpdate, User $user = null)
    {
        parent::setCreateData($isUpdate, $user);
        if(!$isUpdate){
            if (!empty($this->id) && $this->new_with_id){
                $nextId = $this->getNextId();
                if ($this->id === $nextId){
                    return;
                }
            }
            $this->id = null;
        }
    }

    /**
     * Remove ID field if requesting auto_increment properties (as done by loadAutoIncrementValues()
     * @inheritDoc
     */
    public function getFieldDefinitions(?string $property = null, array $filter = array()) : array
    {
        $definitions = parent::getFieldDefinitions($property,$filter);
        if ($property == 'auto_increment'){
            foreach ($definitions as $i => $field) {
                if ($field['name'] == 'id'){
                    unset($definitions[$i]);
                    break;
                }
            }
        }
        return $definitions;
    }

    /**
     * Set ID to Last ID
     */
    protected function loadAutoIncrementValues()
    {
        $this->id = $this->getLastId();

        parent::loadAutoIncrementValues();
    }

    /**
     * Retrieve the next ID in line
     * - Random wait time incurred, to make parallel duplicate requests differ
     */
    public function getLastId()
    {
        $conn = $this->db->getConnection();

        $qb = $conn->createQueryBuilder();
        $qb->select("MAX(id)");
        $qb->from($this->table_name);
        return $qb->execute()->fetchColumn();
    }

    /**
     * Retrieve the next ID in line
     * - Random wait time incurred, to make parallel duplicate requests differ
     */
    public function getNextId()
    {
        $this->wait();
        return $this->getLastId()+1;
    }

    /**
     * Randomize cycles
     */
    private function wait()
    {
        $count = mt_rand(100,100000);
        $count = intval(round(($count/100)));
        $x = 0;
        while($x <= $count){
            $x++;
        }
    }
}