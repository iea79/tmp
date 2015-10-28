<?php

namespace DaVinci\TaxiBundle\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * VehicleModelYear
 *
 * @ORM\Table(name="VehicleModelYear", uniqueConstraints={@ORM\UniqueConstraint(name="U_VehicleModelYear_year_make_model", columns={"year", "make", "model"})}, indexes={@ORM\Index(name="I_VehicleModelYear_year", columns={"year"}), @ORM\Index(name="I_VehicleModelYear_make", columns={"make"}), @ORM\Index(name="I_VehicleModelYear_model", columns={"model"})})
 * @ORM\Entity
 */
class VehicleModelYear
{
    const minYear = 1909; //min car year, max is current
    
    const maxSeats = 12; // min is 1
    const maxLuggages = 6; // min is 1
    const maxDoors = 6; // min is 1
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=50, nullable=true)
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=50, nullable=false)
     */
    private $model;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return VehicleModelYear
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set make
     *
     * @param string $make
     * @return VehicleModelYear
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return string 
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return VehicleModelYear
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }
    
    public function __toString() {
        return $this->getModel();
    }
    
    /**
     * Get model
     *
     * @return array of years 
     */
    public static function getYearsLst()
    {
        //maxYear = current
        $maxYear  = date("Y");
        
        return range($maxYear, self::minYear);
    }
    
    /**
     * Get model
     *
     * @return array of manufacturers
     */
    public static function getMakerList()
    {
        return array(
            'acura' => 'Acura',
            'alfaromeo' => 'Alfa Romeo',
            'aptera' => 'Aptera',
            'astonmartin' => 'Aston Martin',
            'audi' => 'Audi',
            'austin' => 'Austin',
            'bentley' => 'Bentley',
            'bmw' => 'BMW',
            'bugatti' => 'Bugatti',
            'buick' => 'Buick',
            'cadillac' => 'Cadillac',
            'chevrolet' => 'Chevrolet',
            'chrysler' => 'Chrysler',
            'citroën' => 'Citroën',
            'corbin' => 'Corbin',
            'daewoo' => 'Daewoo',
            'daihatsu' => 'Daihatsu',
            'dodge' => 'Dodge',
            'eagle' => 'Eagle',
            'fairthorpe' => 'Fairthorpe',
            'ferrari' => 'Ferrari',
            'fiat' => 'FIAT',
            'fillmore' => 'Fillmore',
            'foose' => 'Foose',
            'ford' => 'Ford',
            'geo' => 'Geo',
            'gmc' => 'GMC',
            'hillman' => 'Hillman',
            'holden' => 'Holden',
            'honda' => 'Honda',
            'hummer' => 'HUMMER',
            'hyundai' => 'Hyundai',
            'infiniti' => 'Infiniti',
            'isuzu' => 'Isuzu',
            'jaguar' => 'Jaguar',
            'jeep' => 'Jeep',
            'jensen' => 'Jensen',
            'kia' => 'Kia',
            'lamborghini' => 'Lamborghini',
            'landrover' => 'Land Rover',
            'lexus' => 'Lexus',
            'lincoln' => 'Lincoln',
            'lotus' => 'Lotus',
            'maserati' => 'Maserati',
            'maybach' => 'Maybach',
            'mazda' => 'Mazda',
            'mclaren' => 'McLaren',
            'mercedes-benz' => 'Mercedes-Benz',
            'mercury' => 'Mercury',
            'merkur' => 'Merkur',
            'mg' => 'MG',
            'mini' => 'MINI',
            'mitsubishi' => 'Mitsubishi',
            'morgan' => 'Morgan',
            'nissan' => 'Nissan',
            'oldsmobile' => 'Oldsmobile',
            'panoz' => 'Panoz',
            'peugeot' => 'Peugeot',
            'plymouth' => 'Plymouth',
            'pontiac' => 'Pontiac',
            'porsche' => 'Porsche',
            'ram' => 'Ram',
            'rambler' => 'Rambler',
            'renault' => 'Renault',
            'rolls-royce' => 'Rolls-Royce',
            'saab' => 'Saab',
            'saturn' => 'Saturn',
            'scion' => 'Scion',
            'shelby' => 'Shelby',
            'smart' => 'Smart',
            'spyker' => 'Spyker',
            'spykercars' => 'Spyker Cars',
            'studebaker' => 'Studebaker',
            'subaru' => 'Subaru',
            'suzuki' => 'Suzuki',
            'tesla' => 'Tesla',
            'toyota' => 'Toyota',
            'volkswagen' => 'Volkswagen',
            'volvo' => 'Volvo',
            'other' => 'Other'
            );
    }

    /**
     * Get seats
     *
     * @return array of seats count
     */
    public static function getSeatsList()
    {
        return range(1, self::maxSeats);
    }

    /**
     * Get seats
     *
     * @return array of seats count
     */
    public static function getLuggageList()
    {
        return range(1,self::maxLuggages);
    }
    
    /**
     * Get seats
     *
     * @return array of seats count
     */
    public static function getDoorsList()
    {
        return range(1,self::maxDoors);
    }
    
    /**
     * Get colors
     *
     * @return array of colors
     */
    public static function getColorsList()
    {
        return array(
            "black" => "Black",
            "beige" => "Beige",
            "blue" => "Blue",
            "brown" => "Brown",
            "burgundy" => "Burgundy",
            "charcoal" => "Charcoal",
            "gold" => "Gold",
            "gray" => "Gray",
            "green" => "Green",
            "offwhite" => "Off-white",
            "orange" => "Orange",
            "pink" => "Pink",
            "purple" => "Purple",
            "red" => "Red",
            "sliver" => "Silver",
            "tan" => "Tan",
            "turquoise" => "Turquoise",
            "white" => "White",
            "yellow" => "Yellow",
            "other" => "Other"
        );
    }
}
