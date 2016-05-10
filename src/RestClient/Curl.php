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
     * @param array
     * @return array
     */
    public static function dispatch($method = 'GET', $url = '', array $parameters = [], array $headers = [])
    {
        $returnData = array();

        $ch = curl_init();

        if ($method === 'GET' && strpos($url, '?') === false) {
            $url = sprintf('%s?%s', $url, http_build_query($parameters));
            $parameters = [];
        }

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => http_build_query($parameters),
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 360
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch) || empty($response)) {
            $returnData['error'] = sprintf('Failed to reach %s.', $url);
        } else {
            if (gettype($response) === 'string') {
                $result = json_decode($response);
                if ($result) {
                    $exitsError = array_key_exists('errorCode', $result);
                    if ($exitsError) {
                        $returnData['error'] = sprintf('%s: %s', $result->errorCode, $result->errorMessage);
                    } else {
                        $returnData['body'] = $result;
                    }
                } else {
                    $result = simplexml_load_string($response);
                    $returnData['body'] = $response;
                }
            } else {
                $result = json_decode($response);
                if ($result === null) {
                    $returnData['body'] = 'The request does not return any value.';
                } else {
                    $returnData['body'] = $result;
                }
            }
        }

        curl_close($ch);

        return $returnData;
    }
}
