<?php
namespace IniConfigurator;

/**
 * Class IniConfigurator
 * Base class for ini file configuration
 * @author Yusuf Gunduz<info@yusufgunduz.com.tr>
 */
class IniConfigurator
{
    const ENABLE_SECTIONS = true;
    const DISABLE_SECTIONS = false;

    /**
     * @var null|string ini file location
     */
    protected $file;

    /**
     * @var array configuration array
     */
    protected $confData;

    /**
     * @var bool for reading/writing with sections
     */
    protected $sections;

    /**
     * Returns the file location
     * @return null|string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * IniConfigurator constructor.
     * @param null $fileName ini file location
     * @param bool|false $enableSections enable/disable processing with sections
     */
    public function __construct($fileName = null, $enableSections = false)
    {
        if (!empty($fileName)) {
            $this->file = $fileName;
        }
        $this->sections = $enableSections;
    }

    /**
     * Sets the ini file location
     * @param string $fileName location of the ini file
     * @return object $this for method chaining
     */
    public function setFile($fileName)
    {
        $this->file = $fileName;
        return $this;
    }

    /**
     * Returns the configuration data
     * @return array configuration data
     */
    public function getConfData()
    {
        return $this->confData;
    }

    /**
     * Assigns the configuration data
     * @param array $data array that stores the configuration
     * @return $this for method chaining
     */
    public function setConfData($data)
    {
        $this->confData = $data;
        return $this;
    }

    /**
     * Enable sectioning for ini read/write operations
     * @return $this
     */
    public function enableSections()
    {
        $this->sections = true;
        return $this;

    }

    /**
     * Disable sectioning for ini read/write operations
     * @return $this for method chaining
     */
    public function disableSections()
    {
        $this->sections = false;
        return $this;
    }
}