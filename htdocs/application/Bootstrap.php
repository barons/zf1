<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    // _init gaat hij altijd automatisch gaan laden
    public function _initNavigation(){
        
        // maak de frontcontroller beschikbaar in de bootstrap
        // de frontcontroller ophalen
        $this->bootstrap('frontController');
        $front = $this->getResource('frontController');
        // registreer de Navigation plugin
        $front->registerPlugin(new Syntra_Controller_Plugin_Navigation());
        
    }
    
    public function _initDbAdapter()
    {
        // al de resources uit application.ini inladen
        $this->bootstrap('db');
        $db = $this->getResource('db');
        
        Zend_Registry::set('db', $db);
        // zend registry globale variabele, ophalen -> Zend_Registry::get('db');
        // overal in je project beschikbaar (bvb user oproepen zonder connectie
        // met database.
        
        
    }

}

