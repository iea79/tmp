<?php
namespace DaVinci\TaxiBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Intl\Intl;

/**
 * @author Mykola Sedletskyi <icevita@gmail.com>
 */

/**
 * @ORM\Entity
 */
class Language
{
    const LEVEL_NO  = 0;
    const LEVEL_ELEMENTARY = 1;
    const LEVEL_PRE_INTERMEDIATE = 2;
    const LEVEL_INTERMEDIATE = 3;
    const LEVEL_UPPER_INTERMEDIATE = 4;
    const LEVEL_ADVANCED = 5;
    const LEVEL_PROFICIENCY = 6;

    static public function getLanguageLevelOptions()
    {
         return array(
            self::LEVEL_NO  => 'No',
            self::LEVEL_ELEMENTARY => 'Elementary',
            self::LEVEL_PRE_INTERMEDIATE => 'Pre-Intermediate',
            self::LEVEL_INTERMEDIATE  => 'Intermediate',
            self::LEVEL_UPPER_INTERMEDIATE => 'Upper-Intermediate',
            self::LEVEL_ADVANCED => 'Advanced',
            self::LEVEL_PROFICIENCY => 'Proficiency'
         );
    }
     
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="array")
     */
    private $languages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = array();
    }

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
     * Set level
     *
     * @param string $level
     * @return UserLanguage
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Get level named
     *
     * @return string 
     */
    public function getLevelNamed()
    {
        return self::getLanguageLevelOptions()[$this->level];
    }

    /**
     * Add language
     *
     * @param string $language
     * @return TaxiCompany
     */
    public function addLanguage($language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param string $language
     */
    public function removeLanguage($language)
    {
        $arr = array_diff($this->languages, array($language));
    }

    /**
     * Get languages
     *
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }
    
    /**
     * Get languages
     *
     * @return string
     */
    public function getSeparatedLanguages()
    {
        $languages = $this->languages;
		array_walk($languages, function(&$value) {
			$value = Intl::getLanguageBundle()->getLanguageName($value);
		});
        
    	return implode(', ', $languages);	
    }
        
    /**
     * Get languages
     *
     * @return array 
     */
    public function getLanguagesNamed()
    {

        return array_map(array(Intl::getLanguageBundle(), "getLanguageName"), $this->languages);
    }

    /**
     * Set languages
     *
     * @param array $languages
     * @return Language
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }
}
