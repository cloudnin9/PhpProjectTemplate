<?php
/**
 * Created by PhpStorm.
 * User: naing
 * Date: 13/08/14
 * Time: 11:46 AM
 */

namespace application\models;

/**
 * Class PersonalInfo
 * @package application\models
 */
class PersonalInfo {

    public function __construct(){

    }

    final static function Get($identifier = 'author'){

        $str_data = file_get_contents("./models/People.json");
        $data = json_decode($str_data, true);

        $person = new PersonalInfo();

        //echo $identifier;

        $person->Name = $data[$identifier]['name'];
        $person->LastName = $data[$identifier]['last name'];
        $person->Age = $data[$identifier]['age'];
        $person->Email = $data[$identifier]['email'];
        $person->Mobile = $data[$identifier]['mobile'];
        $person->Phone = $data[$identifier]['phone'];

        $residence = $data[$identifier]['residence'];
        $postal = $data[$identifier]['postal'];

        $person->Residence = new Address($residence['address lines'],
            $residence['city'],
            $residence['code'],
            $residence['state'],
            $residence['country']);

        $person->Residence = new Address($postal['address lines'],
            $postal['city'],
            $postal['code'],
            $postal['state'],
            $postal['country']);

        $person->About = $data[$identifier]["about"];

        return $person;
    }

    /**
     * @string
     */
    public $About;

    /**
     * @string
     */
    public $Name;
    /**
     * @string
     */
    public $LastName;
    /**
     * @int
     */
    public $Age;
    /**
     * @string
     */
    public $Email;
    /**
     * @int
     */
    public $Phone;
    /**
     * @int
     */
    public $Mobile;
    /**
     * @Address
     */
    public $Residence;
    /**
     * @Address
     */
    public $Postal;

}

class Address{

    public function __construct($addressLines, $city, $code, $state, $country){
        $this->Lines = $addressLines;
        $this->City = $city;
        $this->Code = $code;
        $this->Country = $country;
        $this->state = $state;
    }

    protected  $state;
    protected $Lines;
    protected $City;
    protected $Code;
    protected $State;
    protected $Country;

    /**
     * @return Array of string
     */
    public function getLines()
    {
        return $this->Lines;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->Code;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->State;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->Country;
    }
}