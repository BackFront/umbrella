<?php
//
namespace Umbrella\Api\Repository {
    class Repository
    {

        private $repositoryUrl;
        private $outputFile;

        function getRepositoryUrl()
        {
            return $this->repositoryUrl;
        }


        function getOutputFile()
        {
            return $this->outputFile;
        }


        function setRepositoryUrl($repositoryUrl)
        {
            $this->repositoryUrl = $repositoryUrl;
        }


        function setOutputFile($outputFile)
        {
            $this->outputFile = $outputFile;
        }


    }
}