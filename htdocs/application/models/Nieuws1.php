<?php

class Application_Model_Nieuws1 extends Zend_Db_Table_Abstract 
{
    // Definiëren hoe de tabel eruit ziet
    // naam tabel en naam primary key meegeven
    // per tabel moet je zo'n class aanmaken !
    
    protected $_name    ='nieuws';
    protected $_primary = 'id';
    
    public function getAllNieuws()
    {
        // Zend_Db_Select
        /*$db = Zend_registry::get('db');
        $select = $db->select();
        $select->from('nieuws');
        $select->where(// search criteria'')
        $select->order(// search criteria'')*/
        
        $this->fetchAll(); // select * FROM nieuws, komt door ingebouwde functionaliteit
    }
    
    public function toevoegenNieuws($params)
    {     
        
        $this->insert($params);
        //// insert into nieuws velden, values,..........
        // params is een array, dus key title met waarde, key id met waarde....
        // Dus -> 
        // $params = array('titel' => 'lipsum', 'omschrijving' => 'blabla');
        
    }
    
    public function wijzigenNieuws($params, $id)
    {     
        // beveiligd de variabele dmv de adapter
        // zorgen dat hetgeen je erin steekt 'veilig' is
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update($params, $where);
        //// insert into nieuws velden, values,..........
        // params is een array, dus key title met waarde, key id met waarde....
        // Dus -> 
        // $params = array('titel' => 'lipsum', 'omschrijving' => 'blabla');
        
    }
    
    public function verwijderNieuws($id)
    {     
        // beveiligd de variabele dmv de adapter
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($where);
        //// insert into nieuws velden, values,..........
        // params is een array, dus key title met waarde, key id met waarde....
        // Dus -> 
        // $params = array('titel' => 'lipsum', 'omschrijving' => 'blabla');
        
    }
}

?>
