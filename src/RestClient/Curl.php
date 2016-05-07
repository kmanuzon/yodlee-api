<?php

namespace Yodlee\RestClient;

class Curl
{
    /**
     * Call API via cURL.
     *
     * Regarding CURLOPT_POSTFIELDS, passing an array will encode the request as
     * multipart/form-data while URL encoded string will be in
     * application/x-www-form-urlencoded.
     * @see http://php.net/manual/en/function.curl-setopt.php#84916
     * @see http://stackoverflow.com/a/4073451/4183317
     *
     * @param string
     * @param string
     * @param array
     * @return array
     */
    public static function callApi($method = 'GET', $url = '', array $parameters = [])
    {
        $return_values = array();

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => http_build_query($parameters),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT        => 360
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
               $return_values['Error'] = "Failed to reach $url.";
        } else {
            if ($response) {
                if (gettype($response) == "string") {
                    $result = json_decode($response);
                    if ($result) {
                        $exitsError = array_key_exists("Error", $result);
                        if ($exitsError) {
                            // @todo
                            //$return_values["Body"] = self::_getErrors($result);
                            $return_values["Body"] = 'Get errors';
                        } else {
                            $return_values["Body"] = $result;
                        }
                    } else {
                        $result = simplexml_load_string($response);
                        $return_values["Body"] = $response;
                    }
                } else {
                    $result = json_decode($response);
                    if ($result === null) {
                        $return_values['Body'] = "The request does not return any value.";
                    } else {
                        $return_values["Body"] = $result;
                    }
                }
            } else {
                $return_values['Error'] = "Failed to reach $url.";
            }
        }

        curl_close($ch);

        return $return_values;
    }
}
