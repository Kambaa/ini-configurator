<?php
namespace SonsuratExtre\Utils\IniConfigurator;

use Exception;

/**
 * Class ConfWriter
 * Writes configuration array to a ini file
 * @author Yusuf Gunduz<info@yusufgunduz.com.tr>
 */
class ConfWriter extends IniConfigurator
{
    /**
     * Generate ini string without sectioning
     * @return null|string ini string
     */
    private function generateIniWithoutSections()
    {
        $content = NULL;
        foreach ($this->confData as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $v) {
                    $content .= $key . '[] = ' . (is_numeric($v) ? $v : '"' . $v . '"') . PHP_EOL;
                }
            } elseif (empty($val)) {
                $content .= $key . ' = ' . PHP_EOL;
            } else {
                $content .= $key . ' = ' . (is_numeric($val) ? $val : '"' . $val . '"') . PHP_EOL;
            }
        }
    }

    /**
     * Generates ini string without sectioning
     * @return null|string ini string
     */
    private function generateIniWithSections()
    {
        $content = NULL;
        foreach ($this->confData as $section => $data) {
            $content .= '[' . $section . ']' . PHP_EOL;
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $v) {
                        $content .= $key . '[] = ' . (is_numeric($v) ? $v : '"' . $v . '"') . PHP_EOL;
                    }
                } elseif (empty($val)) {
                    $content .= $key . ' = ' . PHP_EOL;
                } else {
                    $content .= $key . ' = ' . (is_numeric($val) ? $val : '"' . $val . '"') . PHP_EOL;
                }
            }
            $content .= PHP_EOL;
        }
        return $content;
    }

    /**
     * Writes the generated string to the ini file
     * @param array $data configuration data array
     * @return true operation result
     * @throws Exception if ini file is not writable or file_put_contents method returns false or zero bytes
     */
    public function write($data = [])
    {
        $this->confData = $data;
        $iniStr = $this->sections ? $this->generateIniWithSections() : $this->generateIniWithoutSections();
        $result = file_put_contents($this->getFile(), $iniStr, FILE_APPEND);
        if ($result === false || (is_int($result) && $result < 1)) {
            throw new Exception("Error writing configuration to file: " . $this->file);
        }
        return true;
    }

}