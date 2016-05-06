<?php
//
namespace Umbrella\Api\Repository {
    class RepositoryCurl extends Repository
    {

        protected $object_curl;

        public function __construct($repository_url = null, $outputFile = null)
        {
            set_time_limit(0);
            $this->repositoryUrl = $repository_url;
            $this->outputFile = $outputFile;
            $this->defaultOptions();
        }


        public function __destruct()
        {
            $this->finish();
        }


        private function defaultOptions()
        {
            curl_setopt($this->object_curl, CURLOPT_URL, $this->repositoryUrl);
            curl_setopt($this->object_curl, CURLOPT_FILE, $this->outputFile);
            curl_setopt($this->object_curl, CURLOPT_TIMEOUT, 5040);
            curl_setopt($this->object_curl, CURLOPT_POST, 1);
            curl_setopt($this->object_curl, CURLOPT_POSTFIELDS, $this->XMLRequest);
            curl_setopt($this->object_curl, CURLOPT_SSL_VERIFYHOST, 1);
            curl_setopt($this->object_curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->object_curl, CURLOPT_SSLVERSION, 3);
            curl_setopt($this->object_curl, CURLOPT_FOLLOWLOCATION, true);
        }


        public function setOptions($key, $value)
        {
            curl_setopt($this->curl, $key, $value);
        }


        public function init()
        {
            $this->object_curl = curl_init();
        }


        public function exec()
        {
            $this->defaultOptions();
            $this->output();
            return curl_exec($this->object_curl);
        }


        private function output()
        {
            return fopen($this->outputFile, 'w+');
        }


        public function finish()
        {
            curl_close($this->object_curl);
            fclose($this->outputFile);
        }


    }
}