<?php

namespace awsaf\installer\helpers;

use Yii;

/**
 * A Helper Class to set the config files.
 *
 * @since  1.0
 * @author Awsaf Anam Chowdhury
 */
class Configuration
{

	/**
	 * Returns the dynamic configuration file as array
	 *
	 * @return Array Configuration file
	 */
	public static function get()
	{
		$configFile = self::getConfigFile('web');
		$config = require($configFile);

		if (!is_array($config))
			return [];

		return $config;
	}

	/**
	 * Sets configuration into the file
	 *
	 * @param array $config
	 */
	public static function set($name, $config = [])
	{
		$configFile = self::getConfigFile($name);

		$content = "<" . "?php 
				
return ";
		$content .= var_export($config, TRUE);
		$content .= ";";

		file_put_contents($configFile, $content);

	}


    /**
     * Get a Config file based on its name.
     *
     * @param $name
     * @return string
     */
    public static function getConfigFile($name)
    {
        return Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $name . '.php';;
	}
}