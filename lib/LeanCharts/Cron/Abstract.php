<?php

class LeanCharts_Cron_Abstract
{
    /**
     * @var Sparrow
     */
    protected $db;

    protected $customStatsPath;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setCustomStatsPath($path)
    {
        $this->customStatsPath = $path;
    }

    public function runCustomStats($interval)
    {
        $files = glob($this->customStatsPath . '/*.php');

        if(is_array($files) && count($files) > 0) {

            foreach ($files as $file) {

                include_once $file;
                $class = $this->getClassName($file);

                $customStat = new $class($this->db);
                $customStat->run($interval);

            }

        }
    }

    private function getClassName($file)
    {
        $class = str_replace($this->customStatsPath . '/', '', $file);
        $class = str_replace(".php", '', $class);
        
        return $class;
    }
}