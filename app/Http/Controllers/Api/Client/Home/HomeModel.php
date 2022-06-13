<?php
namespace Api\Client\Home;


class HomeModel
{

    private $Model;
    private $Request;

    public function __construct($Model , $request)
    {
        $object = new $Model($request);

        $this->setModel($object);
        $this->setRequest($request);
    }

    /**
     * @return HomeInterface
     */
    public function getModel(): HomeInterface
    {
        return $this->Model;
    }

    /**
     * @param  $Model
     */
    public function setModel(HomeInterface $Model): void
    {
        $this->Model = $Model;
    }


    /**
     * @return $Request
     */
    public function getRequest(): object
    {
        return $this->Request;
    }

    /**
     * @param  $Request
     */
    public function setRequest($Request): void
    {
        $this->Request = $Request;
    }

    /**
     * @param mixed $id
     */
    public function Home()
    {
        return $this->Model->Home($this->getRequest());
    }

}