<?php

include_once './../lib/LeanChartsApiClient.php';

$apiClient = new LeanChartsApiClient('c11587f9806c93393e603429fb802ddd');
$apiClient->setHost('http://www.lean-charts.local/api');
$res = $apiClient->log('test api event');

if ($res === true) {
    echo "API call successful.";
} else {
    echo "API call not successful.";
}