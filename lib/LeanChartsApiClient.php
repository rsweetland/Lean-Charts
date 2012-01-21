<?php

class LeanChartsApiClient
{
    protected $token;
    protected $host = 'http://www.lean-charts.com/api';

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function log($event, $data = array())
    {
        $url = $this->host . '/log?token=' . $this->token;
        $params = array_merge(array('event' => $event), $data);

        return $this->sendRequest($url, $params);
    }

    private function sendRequest($url, $data = array())
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        if (!empty($data)) {

            $params = array();
            foreach ($data as $key => $value) {
                $params[] = $key . "=" . urlencode($value);
            }

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $params));
        }

        curl_exec ($ch);

        if (!curl_errno($ch)) {
            $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($info == '201') {
                return true;
            }
        }

        return false;
    }
}