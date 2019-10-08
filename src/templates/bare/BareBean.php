<?php

class BareBean extends SugarBean
{
    /**
     * The configured modified date field
     * @var string|false
     */
    protected $_modified_date_field = false;

    /**
     * The configured modified user field
     * @var string|false
     */
    protected $_modified_user_field = false;

    /**
     * The configured created date field
     * @var string|false
     */
    protected $_created_date_field = false;

    /**
     * The configured created user field
     * @var string|false
     */
    protected $_created_user_field = false;

    /**
     * Get the field name where modified date is stored, if in use by Module
     * @return string|false
     */
    public function getModifiedDateField()
    {
        if ($this->_modified_date_field !== FALSE){
            $field = $this->_modified_date_field;
            if (isset($this->field_defs[$field]) && $this->field_defs[$field]['type'] == 'datetime'){
                return $field;
            }
        }
        return FALSE;
    }

    /**
     * Override the stock setModifiedDate method
     *  - Check that field is in use by this Module
     *  - If in use, set the configured field to current time
     * @inheritdoc
     **/
    public function setModifiedDate($date = '')
    {
        global $timedate;

        $field = $this->getModifiedDateField();
        if ($field !== FALSE){
            // This code was duplicated from the stock SugarBean::setModifiedDate
            if ($this->update_date_modified || empty($this->$field)) {
                // This only needs to be calculated if it is going to be used
                if (empty($date)) {
                    $date = $timedate->nowDb();
                }

                $this->$field = $date;
            }
        }
    }

    /**
     * Get the field name where modified user ID is stored, if in use by Module
     * @return string|false
     **/
    public function getModifiedUserField()
    {
        if ($this->_modified_user_field !== FALSE){
            $field = $this->_modified_user_field;
            if (isset($this->field_defs[$field]) && $this->field_defs[$field]['type'] == 'assigned_user_name'){
                return $field;
            }
        }
        return FALSE;
    }

    /**
     * Override the stock setModifiedUser Method
     * - Check that field is in use by this Module
     * - If in use, set the configured field to user_id
     * @inheritdoc
     * @param User|null $user [description]
     */
    public function setModifiedUser(User $user = null)
    {
        global $current_user;
        $field = $this->getModifiedUserField();
        if ($field !== FALSE){
            // If the update date modified by flag is set then carry out this directive
            if ($this->update_modified_by) {
                // Default the modified user id to the default
                $this->$field = 1;

                // If a user was not presented, default to the current user
                if (empty($user)) {
                    $user = $current_user;
                }

                // If the user is set, use it
                if (!empty($user)) {
                    $this->$field = $user->id;
                }
            }
        }
    }

    /**
     * Get the field name where created date is stored, if in use by Module
     * @return string|false
     */
    public function getCreatedDateField()
    {
        if ($this->_created_date_field !== FALSE){
            $field = $this->_created_date_field;
            if (isset($this->field_defs[$field]) && $this->field_defs[$field]['type'] == 'datetime'){
                return $field;
            }
        }
        return FALSE;
    }

    /**
     * Get the field name where created user ID is stored, if in use by Module
     * @return string|false
     */
    public function getCreatedUserField()
    {
        if ($this->_created_user_field !== FALSE){
            $field = $this->_created_user_field;
            if (isset($this->field_defs[$field]) && $this->field_defs[$field]['type'] == 'assigned_user_name'){
                return $field;
            }
        }
        return FALSE;
    }

    /**
     * Override the stock setCreateData method
     * - Code was duplicated from stock, to accommodate not having created date or created user fields
     * @inheritdoc
     */
    public function setCreateData($isUpdate, User $user = null)
    {
        if (!$isUpdate) {
            global $current_user;

            $field = $this->getCreatedDateField();
            if ($field !== FALSE){
                //Duplicated from SugarBean::setCreateData with modifications for dynamic field name
                if (empty($this->$field)) {
                    $this->$field = $this->getDateModified();
                }

                if (empty($this->$field)){
                    global $timedate;
                    $this->$field = $timedate->nowDb();
                }
            }

            $field = $this->getCreatedUserField();
            if ($field !== FALSE){
                //Duplicated from SugarBean::setCreateData with modifications for dynamic field name
                if ($this->set_created_by == true) {
                    // created by should always be this user
                    // unless it was set outside of the bean
                    if ($user) {
                        $this->$field = $user->id;
                    } else {
                        $this->$field = isset($current_user) ? $current_user->id : "";
                    }
                }
            }

            if ($this->new_with_id == false) {
                $this->id = Sugarcrm\Sugarcrm\Util\Uuid::uuid1();
            }
        }
    }

    /**
     * Get the Date Modified fields value
     * @return mixed|false
     */
    public function getDateModified()
    {
        if ($this->_modified_date_field !== FALSE){
            $field = $this->_modified_date_field;
            return $this->$field;
        }
        return FALSE;
    }

    /**
     * Get the Date Created Fields value
     * @return mixed|false
     */
    public function getDateCreated()
    {
        if ($this->_created_date_field !== FALSE){
            $field = $this->_created_date_field;
            return $this->$field;
        }
        return FALSE;
    }

    /**
     * @inheritdoc
     */
    public function mark_deleted($id)
    {
        $date_modified = $GLOBALS['timedate']->nowDb();
        if (isset($_SESSION['show_deleted'])) {
            $this->mark_undeleted($id);
        } else {
            // Ensure that Activity Messages do not occur in the context of a Delete action (e.g. unlink)
            // and do so for all nested calls within the Top Level Delete Context
            $opflag = static::enterOperation('delete');
            $aflag = Activity::isEnabled();
            Activity::disable();
            // call the custom business logic
            $custom_logic_arguments['id'] = $id;
            $this->call_custom_logic("before_delete", $custom_logic_arguments);
            $this->deleted = 1;

            if (isset($this->field_defs['team_id'])) {
                if (empty($this->teams)) {
                    $this->load_relationship('teams');
                }

                if (!empty($this->teams)) {
                    $this->teams->removeTeamSetModule();
                }
            }

            $this->mark_relationships_deleted($id);

            $updateFields = array('deleted' => 1);

            $field = $this->getModifiedDateField();
            if ($field !== FALSE){
                $this->setModifiedDate();
                $updateFields[$field] = $this->$field;
            }

            $field = $this->getModifiedUserField();
            if ($field !== FALSE){
                $this->setModifiedUser();
                $updateFields[$field] = $this->$field;
            }

            $this->db->updateParams(
                $this->table_name,
                $this->field_defs,
                $updateFields,
                array('id' => $id)
            );

            if ($this->isFavoritesEnabled()) {
                SugarFavorites::markRecordDeletedInFavorites($id, $date_modified);
            }

            // Take the item off the recently viewed lists
            $tracker = BeanFactory::newBean('Trackers');
            $tracker->makeInvisibleForAll($id);

            SugarRelationship::resaveRelatedBeans();

            // call the custom business logic
            $this->call_custom_logic("after_delete", $custom_logic_arguments);
            if(static::leaveOperation('delete', $opflag) && $aflag) {
                Activity::enable();
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function mark_undeleted($id)
    {
        // call the custom business logic
        $custom_logic_arguments['id'] = $id;
        $this->call_custom_logic("before_restore", $custom_logic_arguments);

        $this->deleted = 0;
        $modified_date_field = $this->getModifiedDateField();
        if ($modified_date_field !== FALSE){
            $this->setModifiedDate();
        }

        $query = "UPDATE {$this->table_name} SET deleted = ?".(!$modified_date_field?"":",$modified_date_field = ?")." WHERE id = ?";
        $conn = $this->db->getConnection();
        $params = array($this->deleted);
        if ($modified_date_field){
            $params[] = $this->$modified_date_field;
        }
        $params[] = $id;
        $conn->executeQuery($query, $params);

        // call the custom business logic
        $this->call_custom_logic("after_restore", $custom_logic_arguments);
    }
}