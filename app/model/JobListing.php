<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * JobListing.php 1.0
 * Febuary 23 2020
 *
 * Job Listing is a model to hold all information about a job posting
 */

namespace App\model;

Class JobListing implements \JsonSerializable
{
    private $id;
    private $companyName;
    private $position;
    private $salary;
    private $skills;
    private $description;
    
    /**
     * Constructor in order to initialize all varibles in the property
     * @param $id - int: the primary key id of the job listing in the database
     * @param $companyName - string: The name of the company that the job posting is for
     * @param $position - string: the posistion or job title of the job listing
     * @param $salary - int: The starting salary of the posting
     * @param $skills - list: list of qualififications for the job
     * @param $description - string: a description of the what the job entials
     */
    public function __construct($id, $companyName, $position, $salary, $skills, $description)
    {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->position = $position;
        $this->salary = $salary;
        $this->skills = $skills;
        $this->description = $description;
    }
    
    /**
     * Getter method for the id property
     * @return $id - int: the primary key id of the job listing in the database
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter method for the company name property
     * @return $companyName - string: The name of the company that the job posting is for
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Getter method for the position property
     * @return $position - string: the posistion or job title of the job listing
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Getter method for the salary property
     * @return $salary - int: The starting salary of the posting
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Getter method for the skills property
     * @return $skills - list: list of qualififications for the job
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Getter method for the description property
     * @return $description - string: a description of the what the  job entials
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Setter method for the id property
     * @param $id - int: the primary key id of the job listing in the database
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Setter method for the company name property
     * @param $companyName - string: The name of the company that the job posting is for
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * Setter method for the position property
     * @param $position - string: the posistion or job title of the job listing
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Setter method for the salary property
     * @param $salary - int: The starting salary of the posting
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * Setter method for the skills property
     * @param $skills - list: list of qualififications for the job
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * Setter method for the description property
     * @param $description - string: a description of the what the job entials
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
  
}