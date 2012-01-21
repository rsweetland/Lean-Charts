<?php

/**
 * @uri /log
 * @uri /log/([0-9]+)
 */
class Log extends Resource
{
    public function get($request, $id)
    {
        $response = new Response($request);

        if (!$this->isAuthorized()) {
            $response->code = Response::FORBIDDEN;
            return $response;
        }

        $logManager = new LeanCharts_LogManager(LeanCharts::getDb());
        $entry = $logManager->getById($id);

        if ($entry) {
            $response->body = json_encode($entry);
            $response->addHeader('Content-type', 'application/json');
        } else {
            $response->code = Response::NOTFOUND;
        }

        return $response;
    }

    public function post($request)
    {
        $response = new Response($request);

        if (!$this->isAuthorized()) {
            $response->code = Response::FORBIDDEN;
            return $response;
        }
        
        if (empty($_POST['event'])) {
            $response->code = Response::NOTACCEPTABLE;
            return $response;
        }

        $event = $_POST['event'];
        $userId = !empty($_POST['user_id']) ? $_POST['user_id'] : null;
        $objectId = !empty($_POST['object_id']) ? $_POST['object_id'] : null;
        $objectType = !empty($_POST['object_type']) ? $_POST['object_type'] : null;
        $numValue = !empty($_POST['num_value']) ? $_POST['num_value'] : null;
        $data = !empty($_POST['data']) ? $_POST['data'] : null;
        $date = !empty($_POST['date']) ? $_POST['date'] : null;

        try {
            LeanCharts::log($event, $userId, $objectId, $objectType, $numValue, $data, $date);
            $response->code = Response::CREATED;
        } catch (Exception $e) {
            $response->code = Response::INTERNALSERVERERROR;
            $response->body = $e->getMessage();
        }

        return $response;
    }

    private function isAuthorized()
    {
        $config = LeanCharts::getConfig();

        if ($config->get('client.allowed_ip') != '0.0.0.0') {
            $clientIp = $_SERVER['REMOTE_ADDR'];
            if ($clientIp != $config->get('client.allowed_ip')) {
                return false;
            }
        }

        return !empty($_GET['token']) AND ($_GET['token'] == $config->get('client.token'));
    }
}