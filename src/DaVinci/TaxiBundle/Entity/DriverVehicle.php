<?php
namespace DaVinci\TaxiBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="DriverVehicle")
 * @FileStore\Uploadable
 */
class DriverVehicle
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50, nullable=false)
     */
    private $color;
    
    /**
     * @var string
     *
     * @ORM\Column(name="plate", type="string", length=50, nullable=false)
     */
    private $plate;
    
    
    /**
	 * @ORM\Column(type="string",  name="vehicle_class", length=255)
	 */
	private $vehicleClass;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer", nullable=false)
     */
    private $seats;

    /**
     * @var integer
     *
     * @ORM\Column(name="luggages", type="integer", nullable=false)
     */
    private $luggages;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="doors", type="integer", nullable=false)
     */
    private $doors;
    
    /**
     * @Assert\File( maxSize="20M", groups={"full"})
     * @FileStore\UploadableField(mapping="photo")
     * @ORM\Column(type="array")
     */
    private $photo;
	    
    /**
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    private $about;
    
    /**
     * @ORM\OneToOne(targetEntity="\DaVinci\TaxiBundle\Entity\IndependentDriver", inversedBy="vehicle")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     **/
    private $driver;
    
    
    
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
     * Get id
     *
     * @return Driver 
     */
    function getDriver() {
        return $this->driver;
    }

    /**
     * Set driver
     *
     * @param Driver driver
     * @return DriverVehicle
     */
    function setDriver($driver) {
        $this->driver = $driver;
        return $this;
    }

   /**
     * Set year
     *
     * @param integer $year
     * @return DriverVehicle
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
     * @return DriverVehicle
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
     * @return DriverVehicle
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

    /**
     * Set color
     *
     * @param string $color
     * @return DriverVehicle
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set plate
     *
     * @param string $plate
     * @return DriverVehicle
     */
    public function setPlate($plate)
    {
        $this->plate = $plate;

        return $this;
    }

    /**
     * Get plate
     *
     * @return string 
     */
    public function getPlate()
    {
        return $this->plate;
    }

    /**
     * Set vehicleClass
     *
     * @param string $vehicleClass
     * @return DriverVehicle
     */
    public function setVehicleClass($vehicleClass)
    {
        $this->vehicleClass = $vehicleClass;

        return $this;
    }

    /**
     * Get vehicleClass
     *
     * @return string 
     */
    public function getVehicleClass()
    {
        return $this->vehicleClass;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     * @return DriverVehicle
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer 
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set luggages
     *
     * @param integer $luggages
     * @return DriverVehicle
     */
    public function setLuggages($luggages)
    {
        $this->luggages = $luggages;

        return $this;
    }

    /**
     * Get luggages
     *
     * @return integer 
     */
    public function getLuggages()
    {
        return $this->luggages;
    }

    /**
     * Set doors
     *
     * @param integer $doors
     * @return DriverVehicle
     */
    public function setDoors($doors)
    {
        $this->doors = $doors;

        return $this;
    }

    /**
     * Get doors
     *
     * @return integer 
     */
    public function getDoors()
    {
        return $this->doors;
    }

    /**
     * Set photo
     *
     * @param array $photo
     * @return DriverVehicle
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return array 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return DriverVehicle
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }
}
