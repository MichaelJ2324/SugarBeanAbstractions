<?php

require_once 'custom/include/SugarObjects/templates/bare/BareBean.php';

class AutoIncrementBean extends BareBean
{
    public $new_with_id = true;
    public $id = null;

    /**
     * @inheritdoc
     */
    public function save($check_notify = false)
    {
        $this->ensureId();
        return parent::save($check_notify);
    }

    /**
     * Unset ID and configure $new_with_id property
     */
    protected function ensureId()
    {
        if (!$this->isUpdate()){
            $this->id = null;
            $this->new_with_id = true;
        } else {
            $this->new_with_id = false;
        }
    }

    /**
     * Retrieve the next ID in line
     * - Random wait time incurred, to make parallel duplicate requests differ
     */
    public function getNextId()
    {
        $conn = $this->db->getConnection();

        $qb = $conn->createQueryBuilder();
        $qb->select(array('MAX(id)'));
        $qb->from($this->table_name);

        $this->wait();
        return $qb->execute()->fetchColumn();
    }

    private function wait()
    {
        $count = mt_rand(1,100);
        $x = 0;
        while($x <= $count){
            $x++;
        }
    }
}