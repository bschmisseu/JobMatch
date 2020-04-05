<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * Skill.php 1.0
 * Febuary 23 2020
 *
 * Skill model to hold information about a user's skill
 */

namespace App\model;

Class Skill implements \JsonSerializable
{
    private $id;
    private $skillString;
    private $userId;
    
    /**
     * Constructor in order to initialize all varibles in the property
     * @param $id - int: the primary key id of the skill in the database
     * @param $skillString - string: the skill that describes a users
     * @param $userId - int: the primary key of the user in which the skill is linked to
     */
    public function __construct($id, $skillString, $userId)
    {
        $this->id = $id;
        $this->skillString = $skillString;
        $this->userId = $userId;
    }
    
    /**
     * Getter method for the id property
     * @return $id - int: the primary key id of the skill in the database
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter method for the skill string property
     * @return $skillString - string: the skill that describes a users
     */
    public function getSkillString()
    {
        return $this->skillString;
    }

    /**
     * Getter method for the users id property
     * @return $userId - int: the primary key of the user in which the skill is linked to
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Setter method for the id property
     * @param $id - int: the primary key id of the skill in the database
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Getter method for the skill string property
     * @param $skillString - string: the skill that describes a users
     */
    public function setSkillString($skillString)
    {
        $this->skillString = $skillString;
    }

    /**
     * Setter method for the users id property
     * @param $userId - int: the primary key of the user in which the skill is linked to
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