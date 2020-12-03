<?php 
namespace Libs\httpResponse;

class httpResponse {

    public function setHeader($header) {
        return header($header);
    }

    public function redirect($page) {
        return $this->setHeader("location: $page");
    }

    public function redirect404() {
        return $this->redirect(__DIR__.'/Views/error/404.html');
    }

    public function json($data) {
        $this->setHeader('Content-Type: application/json; charset=uft-8');
        return json_encode($data);
    }

    public function curl($url, $return_transfert = true, $return_json = true, $timeout = 5, $ca_path) : ?array {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_RETURNTRANSFER => $return_transfert,
        ]);
        if($ca_path) {
            curl_setopt($curl, CURLOPT_CAINFO, $ca_path);
        }
        if($return_transfert) {
            $data = curl_exec($curl);
        } else {
            return null;
        }

        if($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            var_dump(curl_error($curl));
            return null;
        } 
        if($return_json)  $data = json_decode($data, true); 
        return $data;
        curl_close($curl);
    }

}