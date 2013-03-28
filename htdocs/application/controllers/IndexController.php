<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // layout uitshchakelen:
        // _ in zend framework wil zeggen dat zend een hoop dingen gaat doen
        // $this->_helper->layout->disableLayout();
        $this->view->naam = "Samuel";
    }

    public function productenAction()
    {
        $this->view->test = "testje";
    }

    public function sitemapAction()
    {
        // action body
    }


}





