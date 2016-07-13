<?php
namespace SonsuratExtre\Utils\IniConfigurator;

use Exception;

/**
 * Class ConfReader
 * Reads the ini configuration file
 * @author Yusuf Gunduz<yusuf.gunduz@gmail.com>
 */
class ConfReader extends IniConfigurator
{
    /**
     * Reads the ini file
     * @return array Returns the configuration data array
     * @throws Exception If parse_ini_file method returns false
     * @throws \FileNotFoundException If given ini file location doesn't exist
     */
    public function readIniFile()
    {
        if (!file_exists($this->file)) {
            throw new \FileNotFoundException("Ini file could not be found!" . $this->file);
        }
        $temp = parse_ini_file($this->file, $this->sections);
        if (!$temp) {
            throw new \Exception("Ini file read returned false!");
        }
        return $this->confData = $temp;
    }

    /**
     * ConfReader constructor.
     * @param string|null $fileName ini file location
     * @param bool|false $enableSections enable sectioning
     */
    public function __construct($fileName, $enableSections)
    {
        parent::__construct($fileName, $enableSections);
        if (!empty($this->file)) {
            $this->readIniFile();
        }

    }
}