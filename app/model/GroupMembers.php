<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * GroupMember.php  1.0
 * March 8 2020
 *
 * Group member model for the users in the groups
 */

namespace App\model;

Class GroupMembers implements \JsonSerializable
{
    private $groupId;
    private $userId;
    
    /**
     * 
     * @param $id - int: the primary key id of the group in the database
     * @param $userId - int: the primary key of the user in which the group is linked to
     */
    public function __construct(int $groupId, int $userId)
    {
        $this->groupId = $groupId;
        $this->userId = $userId;
    }
    
    /**
     * Getter method for the id property
     * @return $id - int: the primary key id of the group in the database
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Getter method for the users id property
     * @return $userId - int: the primary key of the user in which the group is linked to
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Setter method for the id property
     * @param $id - int: the primary key id of the group in the database
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * Setter method for the users id property
     * @param $userId - int: the primary key of the user in which the group is linked to
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
}