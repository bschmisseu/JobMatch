<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * Groups.php 1.0
 * Febuary 23 2020
 *
 * Group model to hold information about an affinity group
 */

namespace App\model;

Class Groups implements \JsonSerializable
{
    private $id;
    private $name;
    private $userId;
    private $users;
    private $ownerName; 
    
    /**
     * 
     * @param $id - int: the primary key id of the skill in the database
     * @param String $name
     * @param $userId - int: the primary key of the user in which the skill is linked to
     */
    public function __construct(int $id, String $name, int $userId, array $users)
    {
        $this->id = $id;
        $this->name = $name;
        $this->userId = $userId;
        $this->users = $users;
    }
    
    /**
     * Getter method for the id property
     * @return $id - int: the primary key id of the group in the database
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Setter method for the id property
     * @param $id - int: the primary key id of the group in the database
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name; 
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
     * Setter method for the users id property
     * @param $userId - int: the primary key of the user in which the group is linked to
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    } 
    
    /**
     * Getter method for the users property
     * @return $users - array: users that are apart of the group
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    /**
     * Setter method for the users property
     * @param $users - array: users that are apart of the group
     */
    public function setUsers(array $users)
    {
        $this->users = $users;
    }
    
    /**
     * Method to determine if a specific user is apart of a group
     * @param int $userId
     * @return boolean
     */
    public function isApart(int $userId)
    {
        $isApart = false;
        
        for($i = 0; $i < count($this->users); $i++)
        {
            if($this->users[$i] == $userId)
            {
                $isApart = true;
                break;
            }
        }
        
        return $isApart;
    }
    
    /**
     * @return mixed
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * @param mixed $ownerName
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
 
}