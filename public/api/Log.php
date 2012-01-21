<?php

/**
 * @uri /log
 * @uri /log/([0-9]+)
 */
class Log extends Resource
{
    public function get($request, $id)
    {
        $logManager = new LeanCharts_LogManager(LeanCharts::getDb());
        $entry = $logManager->getById($id);

        $response = new Response($request);

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
}