<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Import_model extends CI_Model {
 
        public function __construct()
        {
            $this->load->database();
        }
        
        public function importData($data) {
            foreach ($data as $row) {
                $this->db->where(['QUALIFICATION' => $row['QUALIFICATION'], 'T' => $row['T']]);
                $exists = $this->db->get('t2mis')->row();
        
                if ($exists) {
                    // Update all columns in the row
                    $this->db->where(['QUALIFICATION' => $row['QUALIFICATION'], 'T' => $row['T']]);
                    $this->db->update('t2mis', $row);
                } else {
                    // Insert new record
                    $this->db->insert('t2mis', $row);
                }
            }
            return TRUE;
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

        public function get_tree_data() {
            $this->db->select('B as province, E as school, RMQ as rqm_number, AP as competency_status, COUNT(AP) as count');
            $this->db->from('t2mis');
            $this->db->group_by(['B', 'E', 'RMQ', 'AP']);
            $this->db->order_by('B, E, RMQ'); 
            $query = $this->db->get();
            return $query->result_array();
        }
        
        
    }
?>