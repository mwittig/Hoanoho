<?php
    function pushMessage($applicationToken, $userToken, $title, $message, $priority)
    {
        curl_setopt_array($ch = curl_init(), array(
          CURLOPT_URL => "https://api.pushover.net/1/messages.json",
          CURLOPT_USERAGENT => "Mozilla/4.0",
          CURLOPT_POSTFIELDS => array(
          "token" => $applicationToken,
          "user" => $userToken,
          "title" => $title,
          "message" => $message,
          "priority" => $priority,
        )));
        curl_exec($ch);
        curl_close($ch);
    }
?>
