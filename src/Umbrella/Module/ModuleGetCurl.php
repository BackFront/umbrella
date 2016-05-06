<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of ModuleGetCurl
 *
 * @author developer
 */
use Umbrella\Api\Repository;

namespace Umbrella\Module {
    class ModuleGetCurl extends Module
    {

        private $repository;

        public function __construct()
        {
            $local_path = dirname(__FILE__) . 'teste.zip';
            $github_repo = 'https://github.com/BackFront/PHPfoundation/archive/master.zip';
            $this->repository = new \Umbrella\Api\Repository\RepositoryCurl($github_repo, $local_path);
        }


        public function initDownload()
        {
            $this->repository->init();
            $this->repository->exec();
        }


    }
}