<?php

class LeanCharts_Config
{
    private $configuration;

    public function __construct($config)
    {
        if (file_exists($config)) {
            $this->load($config);
        }
    }

    public function load($configFile)
    {
        $this->configuration = parse_ini_file($configFile);
    }

    public function get($key)
    {
        if(isset($this->configuration[$key])) {
            return $this->configuration[$key];
        }

        throw new InvalidArgumentException("Configuration with $key does not exist.");
    }
}