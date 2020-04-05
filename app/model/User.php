<?php

/**
 * Bryce Schmisseur and Hermes Mimini
 * Job Match Application 3.0
 * User.php 2.0
 * Febuary 23 2020
 * 
 * User is a model class in order to hold data and path through different pages and methods
 */

namespace App\model;

Class User implements \JsonSerializable
{
    private $idNum;
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $userRole;
    private $active;
    private $userCredentials;
    private $userInformation;
    
    /**
     * Constructor poulated with all properies inorder when creating the object to set the varibles
     * @param $idNum - int: The users id number that is stored
     * @param $firstName - string: The users first name that is stored
     * @param $lastName - stirng: The users last name that is stored
     * @param $email - string: The users email that is stored
     * @param $phoneNumber - string: The users phone number that is stored
     * @param $userRole - int: The users id role through the website
     * @param $active - int: The users status on the website
     * @param $userCredentials - UserCredential:  The users id number that is stored
     * @param $userInformation - UserInformation:  The users id number that is stored
     */
    function __construct(int $idNum, String $firstName, String $lastName, String $email, String $phoneNumber, 
                         int $userRole, int $active, UserCredential $userCredentials, UserInformation $userInforamtion)
    {
        $this->idNum = $idNum;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->userRole = $userRole;
        $this->active = $active;
        $this->userCredentials = $userCredentials;
        $this->userInformation = $userInforamtion;
    }
    
    /**
     * Getter function for the id property
     * @return $idNum - int: The users id number that is stored
     */
    public function getIdNum()
    {
        return $this->idNum;
    }
    
    /**
     * Getter function for the first name property
     * @return $firstName - string: The users first name that is stored
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Getter function for the lastname property
     * @return $lastName - stirng: The users last name that is stored
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Getter function for the email property
     * @return $email - string: The users email that is stored
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Getter function for the Phone Number  property
     * @return $phoneNumber - string: The users phone number that is stored
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    /**
     * Getter function for the User Role  property
     * @return $userRole - int: The users id role through the website
     */
    public function getUserRole()
    {
        return $this->userRole;
    }
    
    /**
     * Getter function for the active property
     * @return $active - int: The users status on the website
     */
    public function isActive()
    {
        return $this->active;
    }
    
    /**
     * Getter function for the userCredential property
     * @return $userCredential - UserCredential: An object to get the user credentials
     */
    public function getUserCredential()
    {
        return $this->userCredentials;
    }
    
    /**
     * Getter function for the userInformation property
     * @return $userInfroamtion - UserInformation: An object to see the users information
     */
    public function getUserInformation()
    {
        return $this->userInformation;
    }
    
    /**
     * Setter function for the idNum property
     * @param $idNum - int:  The users id number that is stored 
     */
    public function setIdNum(int $idNum)
    {
        $this->idNum = $idNum;
    }
    
     /**
     * Setter function for the first name property
     * @param $firstName - int:  The users first name that is stored
     */
    public function setFirstName(String $firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * Setter function for the last name property
     * @param $lastName - String:  The users last name that is stored
     */
    public function setLastName(String $lastName)
    {
        $this->lastName = $lastName;
    }
    
    /**
     * Setter function for the email property
     * @param $email - String:  The users email that is stored
     */
    public function setEmail(String $email)
    {
        $this->email = $email;
    }
    
    /**
     * Setter function for the phone number property
     * @param $phoneNumber - String:  The users phone number that is stored
     */
    public function setPhoneNumber(String $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    
    /**
     * Setter function for the user role property
     * @param $userRole - int:  The users id role through the website
     */
    public function setUserRole(int $userRole)
    {
        $this->userRole = $userRole;
    }
    
    /**
     * Setter function for the active property
     * @param $active - int:  The users status on the website
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
    
    /**
     * Setter function for the user credentials property
     * @param $userCredentials - UserCredential:  The users id number that is stored
     */
    public function setUserCredentials(UserCredential $userCredentials)
    {
        $this->userCredentials = $userCredentials;
    }
    
    /**
     * Setter function for the user information property
     * @param $userInformation - UserInformation:  The users id number that is stored
     */
    public function setUserInformation(UserInformation $userInformation)
    {
        $this->userInformation = $userInformation;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    
}