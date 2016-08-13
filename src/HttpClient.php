<?php

namespace YodleeApi;

class HttpClient
{
    /**
     * Send a GET request.
     *
     * @param string
     * @param array
     * @return string
     */
    public function get($url, $requestHeaders = [])
    {
        return $this->send('GET', $url, null, $requestHeaders);
    }

    /**
     * Send a DELETE request.
     *
     * @param string
     * @param array
     */
    public function delete($url, $requestHeaders = [])
    {
        $this->send('DELETE', $url, null, $requestHeaders);
    }

    /**
     * Send a POST request.
     *
     * @param string
     * @param array|string
     * @param array
     * @return string
     */
    public function post($url, $content = '', $requestHeaders = [])
    {
        return $this->send('POST', $url, $content, $requestHeaders);
    }

    /**
     * Send a PUT request.
     *
     * @param string
     * @param array|string
     * @param array
     * @return string
     */
    public function put($url, $content = '', $requestHeaders = [])
    {
        return $this->send('PUT', $url, $content, $requestHeaders);
    }

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
     * @param array|string
     * @param array
     * @return array
     */
    public function send($method = 'GET', $url = '', $parameters = '', array $requestHeaders = [])
    {
        $ch = curl_init();

        // make sure parameters is empty for GET requests.
        if ($method === 'GET') {
            $parameters = '';
        }

        // set the correct body for json requests.
        if (empty($parameters)) {
            $postFields = '';
        } elseif (in_array('content-type: application/json', array_map('strtolower', $requestHeaders))) {
            $postFields = json_encode($parameters);
        } else {
            $postFields = http_build_query($parameters);
        }

        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER     => $requestHeaders,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_URL            => $url,
            CURLOPT_POSTFIELDS     => $postFields,
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_HEADER         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 360
        ]);

        $curlErrorNo = curl_errno($ch);
        $response = curl_exec($ch);
        $responseHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $responseHeaderSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $responseHeader = substr($response, 0, $responseHeaderSize);
        $responseBody = substr($response, $responseHeaderSize);
        $requestHeader = curl_getinfo($ch, CURLINFO_HEADER_OUT);

        /*
        // diagnostic prints for debugging transaction.
        print str_repeat('=', 40);
        print '<br>';
        print 'REQUEST ARGUMENTS<pre>';
        print_r(func_get_args());
        print '</pre>';
        print str_repeat('=', 40);
        print '<br>';
        print 'CURL ERROR NO: ' . curl_errno($ch);
        print '<br>';
        print str_repeat('=', 40);
        print '<br>';
        print 'CURL REQUEST HEADER<pre>';
        print_r($requestHeader);
        print '</pre>';
        print 'CURL RESPONSE HEADER<pre>';
        print_r($responseHeader);
        print '</pre>';
        print 'CURL RESPONSE BODY<pre>';
        print_r($responseBody);
        print '</pre>';
        print str_repeat('=', 40);
        print '<br>';
        print '<br>';
        */

        curl_close($ch);

        return $responseBody;
    }
}
