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
     * Setting request body w/ json content type.
     * @see http://www.lornajane.net/posts/2011/posting-json-data-with-php-curl
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

        if ($method === 'GET' && ! empty($parameters) && strpos($url, '?') === false) {
            $url = sprintf('%s?%s', $url, http_build_query($parameters));
            $parameters = [];
        }

        if (in_array('Content-Type: application/json', $headers)) {
            $postFields = json_encode($parameters);
        } else {
            $postFields = http_build_query($parameters);
        }

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $postFields,
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_HEADER         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 360
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headerOut = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        $header = substr($response, 0, $headerSize);
        $response = substr($response, $headerSize);

        if (curl_errno($ch)) {
            $returnData['error'] = sprintf('Failed to reach %s.', $url);
        } else {
            $returnData['http_code'] = $httpCode;
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

        /*
        print '<br>';
        print str_repeat('=', 40);
        print '<br>';
        print '</pre>';
        print 'CURL REQUEST HEADER<pre>';
        print_r($headerOut);
        print '</pre>';
        print 'CURL RESPONSE HEADER<pre>';
        print_r($header);
        print '</pre>';
        print 'CURL RESPONSE BODY<pre>';
        print_r($response);
        print '</pre>';
        print str_repeat('=', 40);
        print '<br>';
        */

        curl_close($ch);

        return $returnData;
    }
}
