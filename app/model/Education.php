<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * Education.php 2.0
 * Febuary 23 2020
 *
 * Education model in order to keep track of the users past education history
 */

namespace App\model;

Class Education implements \JsonSerializable
{
    private $id; 
    private $name;
    private $degree;
    private $field;
    private $startDate;
    private $endDate;
    private $description;
    private $userId;
    private $edit;

    /**
     * Constructor poulated with all properies inorder when creating the object to set the varibles
     * @param $id - int: The education objects id number with in the database
     * @param $name - string: the name of the school
     * @param $degree - string: the type of degree from the school
     * @param $field - string: the field of study prusude at the school
     * @param $startDate - string: the date in which started at the school
     * @param $endDate - string: the date in which graduated from the school
     * @param $description - string: the users decription of the school
     * @param $userId - int: the id of the users that the education is linked to
     */
    function __construct($id, $name, $degree, $field, $startDate, $endDate, $description, $userId)
    {
        $this->id = $id; 
        $this->name = $name;
        $this->degree = $degree;
        $this->field = $field;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->description = $description;
        $this->userId = $userId;
        $this->edit = FALSE; 
    }
    
    /**
     * Getter function for the id property
     * @return $id - int: The education objects id number with in the database
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Getter function for the name property
     * @return $name - string: the name of the school
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The getter method for the degree property
     * @return $degree - string: the type of degree from the school
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * The getter method for the field property
     * @return $field - string: the field of study prusude at the school
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * The getter method for the Start Date property
     * @return $startDate - string: the date in which started at the school
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * The getter mehtod for the end date property
     * @return $endDate - string: the date in which graduated from the school
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * The getter method for the description property
     * @return $description - string: the users decription of the school
     */
    public function getdescription()
    {
        return $this->description;
    }
    
    /**
     * Setter function for the id property
     * @param id - int: The education objects id number with in the database
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Setter function for the name property
     * @param $name - string: the name of the school
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * The setter method for the degree property
     * @param $degree - string: the type of degree from the school
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;
    }

    /**
     * The setter method for the Start Date property
     * @param $startDate - string: the date in which started at the school
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * The setter method for the Start Date property
     * @param $startDate - string: the date in which started at the school
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * The setter mehtod for the end date property
     * @param $endDate - string: the date in which graduated from the school
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * The setter method for the description property
     * @param $description - string: the users decription of the school
     */
    public function setdescription($description)
    {
        $this->description = $description;
    } 
    
    
    /**
     * The getter method for the user id property
     * @return $userId - int: the id of the users that the education is linked to
     */
    public function getUserId()
    {
        return $this->userId;
    }
    
    /**
     * The setter method for the user id property
     * @param $userId - int: the id of the users that the education is linked to
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    
    /**
     * Getter method for the edit property
     * @return $edit - boolean: property to determin if the education is in an edited state
     */
    public function getEdit()
    {
        return $this->edit;
    }
    
    /**
     * Setter method for the edit property
     * @param $edit - boolean: property to determin if the education is in an edited state
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}