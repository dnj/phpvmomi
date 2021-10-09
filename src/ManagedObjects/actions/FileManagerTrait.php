<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\Filesystem\Local;
use dnj\phpvmomi\Exception;

trait FileManagerTrait
{
    public function download(string $url, Local\File $file): void
    {
        $curl = $this->getCURL();
        $fd = fopen($file->getPath(), 'w');
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_FILE => $fd,
        ]);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        fclose($fd);
        if (true !== $result or $info['http_code'] >= 400) {
            throw new Exception("failed download, url: {$url}, http_code: {$info['http_code']}");
        }
    }

    public function upload(string $url, Local\File $file): void
    {
        $curl = $this->getCURL();
        $fd = fopen($file->getPath(), 'r');
        curl_setopt_array($curl, [
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_URL => $url,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type' => 'application/octet-stream',
            ],
            CURLOPT_UPLOAD => true,
            CURLOPT_INFILE => $fd,
            CURLOPT_INFILESIZE => $file->size(),
        ]);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        fclose($fd);

        if (true !== $result or $info['http_code'] >= 400) {
            throw new Exception("failed upload, url: {$url}, http_code: {$info['http_code']}");
        }
    }

    protected function getCURL()
    {
        $cookies = '';
        foreach ($this->api->getClient()->__getCookies() as $key => $params) {
            $cookies .= "{$key}={$params[0]};";
        }
        $sslVerify = $this->api->getOption('ssl_verify');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_HTTPHEADER => [
                'cookie' => $cookies,
            ],
            CURLOPT_COOKIE => $cookies,
            CURLOPT_SSL_VERIFYPEER => $sslVerify,
            CURLOPT_SSL_VERIFYHOST => $sslVerify ? 2 : 0,
        ]);

        return $curl;
    }
}
