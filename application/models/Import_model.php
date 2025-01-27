<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Import_model extends CI_Model {
 
        public function __construct()
        {
            $this->load->database();
        }
        
        public function importData($data) {
            $res = $this->db->insert_batch('t2mis', $data);
            if($res){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        public function report() {
            $this->db->select('B, E, COUNT(DISTINCT T) as count_T');
            $this->db->where('AS1 !=', 'Unemployed');
            $this->db->or_where('AS1 !=', 'N/A');
            $this->db->or_where('AS1 !=', '');
            $this->db->group_by(['B', 'E']);
            $query = $this->db->get('t2mis');
            return $query->result_array();
        }
        

        public function classification_report() {
            // Assuming you are fetching data from the 't2mis' table
            $this->db->select('AH'); // Select only the AH column
            $query = $this->db->get('t2mis'); // Execute the query
            return $query->result_array(); // Return the results as an array
        }
        
        
    }
?>