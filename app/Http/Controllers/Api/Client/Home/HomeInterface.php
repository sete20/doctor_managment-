<?php


namespace Api\Client\Home;

interface HomeInterface
{
    public function Home($request) ;
    public function pagination($request) ;
    public function all($request) ;
    public function singleRecord($request) ;
}