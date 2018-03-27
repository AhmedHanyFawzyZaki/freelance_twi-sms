<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Number;
use App\User;
use App\Http\Requests;
use App\Http\Session;
use App\Http\Controllers\Controller;
use Twilio\Twiml;

class DirectoryController extends Controller {

    public function search(Request $request) {
        $msg_arr = [];
        $body = $request->input('Body');
        $from = $request->input('From');
        $to = $request->input('To');
        if ($body) {
            $msg_arr = explode(' ', $body);
        }

        $query = Number::whereIn('number', $msg_arr);
        $count = $query->count();
        if ($count > 0) {
            return $this->_singleResult($query, $body, $from, $to);
        } else {
            return $this->_notFound($body, $from, $to);
        }
    }

    private function _singleResult($query, $body, $from, $to) {
        $twiml = new Twiml;
        $number = $query->first();
        $reply = $number->msg;
        $twiml->message($reply);

        $this->_curlAPI('POST', env('ENHANCED_API_URL'), ['Body' => $body, 'From' => $from, 'To' => $to, 'Reply' => $reply]);

        return $this->_xmlResponse($twiml);
    }

    private function _notFound($body, $from, $to) {
        $twiml = new Twiml;
        $settings = User::findOrFail(1);
        $reply = $settings->default_message;
        $twiml->message($reply);

        $this->_curlAPI('POST', env('ENHANCED_API_URL'), ['Body' => $body, 'From' => $from, 'To' => $to, 'Reply' => $reply]);

        return $this->_xmlResponse($twiml);
    }

    private function _xmlResponse($twiml) {
        return response($twiml, 200)->header('Content-Type', 'application/xml');
    }

    private function _curlAPI($method, $url, $data = false) {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

}
