<?php
    
    // class altijd noemen naar de locatie waar hij staat
    class Syntra_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
    {
        /**
         * 
         * @param \Zend_Controller_Request_Abstract $request
         * @return \Zend_Navgiation
         */
        // \ iets met namespaces, zend classes staan altijd op de root
        public function preDispatch(\Zend_Controller_Request_Abstract $request) {
            // maak navigatie
            
            $container = new Zend_Navigation();
            
            $urls = array(
                array('label' => 'Home', 'action' => 'index', "controller" => 'index', 'params' => array()),
                array('label' => 'Producten', 'action' => 'Producten', "controller" => 'producten', 'params' => array()),
                array('label' => 'Contact', 'action' => 'index', "controller" => 'contact', 'params' => array()),
                array('label' => 'Sitemap', 'action' => 'sitemap', "controller" => 'index', 'params' => array()),
            );
            
            foreach ($urls as $url){
                $page = new Zend_Navigation_Page_Mvc(array(
                   'label'      => $url['label'],
                   'action'     => $url['action'],
                   'controller' => $url['controller'],
                   'route'      => 'default',
                   'params'     => $url['params'],
                ));
                $container->addPage($page);
            }
            // Design pattern, naam geven die je altijd kan oproepen, globale variabele
            // controller, views, action, models, daar kan je de variabele oproepen van zend registry
            Zend_Registry::set('Zend_Navigation', $container);
            // als registry kapot is krijg je toch nog altijd iets in return
            return $container;
        }
    }

?>