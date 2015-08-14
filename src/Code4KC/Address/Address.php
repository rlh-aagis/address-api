<?php

namespace Code4KC\Address;

use \PDO as PDO;

/**
 * Class Address
 */
class Address extends BaseTable
{

    var $table_name = 'address';
    var $primary_key_sequence = 'address_id_seq_02';
    var $single_line_address_query = '';
    var $fields = array(
        'single_line_address' => '',
        'street_number' => '',
        'pre_direction' => '',
        'street_name' => '',
        'street_type' => '',
        'post_direction' => '',
        'internal' => '',
        'city' => '',
        'state' => '',
        'zip' => '',
        'zip4' => '',
        'longitude' => '0.0',
        'latitude' => '0.0'
    );

    /**
     * @param $id
     * @return false or found record
     */
    function find_by_single_line_address($single_line_address)
    {
        if (!$this->single_line_address_query) {
            $sql = 'SELECT *  FROM ' . $this->table_name . ' WHERE single_line_address = :single_line_address';
            $this->single_line_address_query = $this->dbh->prepare("$sql  -- " . __FILE__ . ' ' . __LINE__);
        }

        try {
            $this->single_line_address_query->execute(array(':single_line_address' => $single_line_address));
        } catch (PDOException  $e) {
            error_log($e->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            //throw new Exception('Unable to query database');
            return false;
        }

        return $this->single_line_address_query->fetch(PDO::FETCH_ASSOC);
    }


    
}
