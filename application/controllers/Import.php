<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Import extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Import_model', 'import');
        $this->load->helper(array('url','html','form'));
    }    
 
    public function index() {
        $data['report_data'] = $this->import->report();
        //print_r($data);
        $this->load->view('import', $data);
    }

    public function classification_report() {
      // Store the result in a data array by calling a model method
      $results = $this->import->classification_report(); // Assuming the model function fetches the data
  
      // Initialize an array to hold the counts of each classification
      $classification_counts = [];
  
      // Loop through each result and process the AH column
      foreach ($results as $row) {
          // Split the 'AH' column data by semicolon into individual classifications
          $classifications = explode(',', $row['AH']); // Split by comma
  
          // Count each classification
          foreach ($classifications as $classification) {
              $classification = trim($classification); // Trim any extra spaces
              if (!empty($classification)) { // Check if the classification is not empty
                  if (isset($classification_counts[$classification])) {
                      // If the classification already exists, increment its count
                      $classification_counts[$classification]++;
                  } else {
                      // Otherwise, initialize it with 1
                      $classification_counts[$classification] = 1;
                  }
              }
          }
      }
  
      // Pass the classification counts to the view
      $data['classification_data'] = $classification_counts;
      $this->load->view('classification_report_view', $data);
  }
 
    public function importFile(){
  
      if ($this->input->post('submit')) {
                 
                $path = 'assets/uploads/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                 
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $highestColumm = $objPHPExcel->getActiveSheet()->getHighestColumn();
//--------T2MIS------------
                    if($highestColumm == 'AV'){
                      $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true);
                      $flag = true;
                      $i=1;
                      foreach ($allDataInSheet as $key => $value) {
                        // Skip the first row
                        if ($key === 1) {
                            continue;
                        }

                        // Check if the value in the first column is null
                        if (empty($value['A'])) {
                            break;
                        }

                        if($flag){
                          $flag =false;
                          continue;
                        }
                        $inserdata[$i]['id'] = $value['A'];
                        $inserdata[$i]['B'] = $value['B'];
                        $inserdata[$i]['C'] = $value['C'];
                        $inserdata[$i]['D'] = $value['D'];
                        $inserdata[$i]['E'] = $value['E'];
                        $inserdata[$i]['F'] = $value['F'];
                        $inserdata[$i]['G'] = $value['G'];
                        $inserdata[$i]['H'] = $value['H'];
                        $inserdata[$i]['I'] = $value['I'];
                        $inserdata[$i]['J'] = $value['J'];
                        $inserdata[$i]['K'] = $value['K'];
                        $inserdata[$i]['L'] = $value['L'];
                        $inserdata[$i]['M'] = $value['M'];
                        $inserdata[$i]['N'] = $value['N'];
                        $inserdata[$i]['O'] = $value['O'];
                        $inserdata[$i]['P'] = $value['P'];
                        $inserdata[$i]['Q'] = $value['Q'];
                        $inserdata[$i]['R'] = $value['R'];
                        $inserdata[$i]['S'] = $value['S'];
                        $inserdata[$i]['T'] = $value['T'];
                        $inserdata[$i]['U'] = $value['U'];
                        $inserdata[$i]['V'] = $value['V'];
                        $inserdata[$i]['W'] = $value['W'];
                        $inserdata[$i]['X'] = $value['X'];
                        $inserdata[$i]['Y'] = $value['Y'];
                        $inserdata[$i]['Z'] = $value['Z'];
                        $inserdata[$i]['AA'] = $value['AA'];
                        $inserdata[$i]['AB'] = $value['AB'];
                        $inserdata[$i]['AC'] = $value['AC'];
                        $inserdata[$i]['AD'] = $value['AD'];
                        $inserdata[$i]['AE'] = $value['AE'];
                        $inserdata[$i]['AF'] = $value['AF'];
                        $inserdata[$i]['AG'] = $value['AG'];
                        $inserdata[$i]['AH'] = $value['AH'];
                        $inserdata[$i]['AI'] = $value['AI'];
                        $inserdata[$i]['AJ'] = $value['AJ'];
                        $inserdata[$i]['AK'] = $value['AK'];
                        $inserdata[$i]['AL'] = date('Y-m-d', strtotime($value['AL']));
                        $inserdata[$i]['AM'] = date('Y-m-d', strtotime($value['AM']));
                        $inserdata[$i]['AN'] = $value['AN'];
                        $inserdata[$i]['AO'] = null;
                        $inserdata[$i]['AP'] = $value['AO'];
                        $inserdata[$i]['AQ'] = $value['AP'];
                        $inserdata[$i]['AR'] = date('Y-m-d', strtotime($value['AQ']));
                        $inserdata[$i]['AS1'] = $value['AR'];
                        $inserdata[$i]['AT'] = $value['AS'];
                        $inserdata[$i]['AU'] = $value['AT'];
                        $inserdata[$i]['AV'] = $value['AU'];
                        $inserdata[$i]['AW'] = $value['AV'];
                        $inserdata[$i]['AX'] = null;
                        $inserdata[$i]['AY'] = null;
                        $i++;
                      }               
                      $result = $this->import->importData($inserdata);   
                      if($result){
                        $this->session->set_flashdata('success','<strong>Success!</strong> Imported successfully.');
                      }else{
                        echo "ERROR !";
                      }  
                    }
//--------T2MIS------------   

//--------BSRS------------
                    elseif($highestColumm == 'AY'){
                      $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true, true);
                      $flag = true;
                      $i=1;
                      foreach ($allDataInSheet as $key => $value) {
                         // Skip the first row
                         if ($key <= 7) {
                          continue;
                          }

                          // Check if the value in the first column is null
                          //if (empty($value['A'])) {
                          //    break;
                         // }

                        if($flag){
                          $flag =false;
                          continue;
                        }
                        $inserdata[$i]['id'] = $value['A'];
                        $inserdata[$i]['B'] = $value['B'];
                        $inserdata[$i]['C'] = $value['C'];
                        $inserdata[$i]['D'] = $value['D'];
                        $inserdata[$i]['E'] = $value['E'];
                        $inserdata[$i]['F'] = $value['F'];
                        $inserdata[$i]['G'] = $value['G'];
                        $inserdata[$i]['H'] = $value['H'];
                        $inserdata[$i]['I'] = $value['I'];
                        $inserdata[$i]['J'] = $value['J'];
                        $inserdata[$i]['K'] = $value['K'];
                        $inserdata[$i]['L'] = $value['L'];
                        $inserdata[$i]['M'] = $value['M'];
                        $inserdata[$i]['N'] = $value['N'];
                        $inserdata[$i]['O'] = $value['O'];
                        $inserdata[$i]['P'] = $value['P'];
                        $inserdata[$i]['Q'] = $value['Q'];
                        $inserdata[$i]['R'] = $value['R'];
                        $inserdata[$i]['S'] = $value['S'];
                        $inserdata[$i]['T'] = $value['T'];
                        $inserdata[$i]['U'] = $value['U'];
                        $inserdata[$i]['V'] = $value['V'];
                        $inserdata[$i]['W'] = $value['W'];
                        $inserdata[$i]['X'] = $value['X'];
                        $inserdata[$i]['Y'] = $value['Y'];
                        $inserdata[$i]['Z'] = $value['Z'];
                        $inserdata[$i]['AA'] = $value['AA'];
                        $inserdata[$i]['AB'] = $value['AB'];
                        $inserdata[$i]['AC'] = $value['AC'];
                        $inserdata[$i]['AD'] = $value['AD'];
                        $inserdata[$i]['AE'] = $value['AE'];
                        $inserdata[$i]['AF'] = $value['AF'];
                        $inserdata[$i]['AG'] = $value['AG'];
                        $inserdata[$i]['AH'] = $value['AH'];
                        $inserdata[$i]['AI'] = $value['AI'];
                        $inserdata[$i]['AJ'] = $value['AJ'];
                        $inserdata[$i]['AK'] = $value['AK'];
                        $inserdata[$i]['AL'] = date('Y-m-d', strtotime($value['AL']));
                        $inserdata[$i]['AM'] = date('Y-m-d', strtotime($value['AM']));
                        $inserdata[$i]['AN'] = date('Y-m-d', strtotime($value['AN']));
                        $inserdata[$i]['AO'] = $value['AO'];
                        $inserdata[$i]['AP'] = $value['AP'];
                        $inserdata[$i]['AQ'] = $value['AQ'];
                        $inserdata[$i]['AR'] = date('Y-m-d', strtotime($value['AR']));
                        $inserdata[$i]['AS1'] = $value['AS'];
                        $inserdata[$i]['AT'] = $value['AT'];
                        $inserdata[$i]['AU'] = $value['AU'];
                        $inserdata[$i]['AV'] = $value['AV'];
                        $inserdata[$i]['AW'] = $value['AW'];
                        $inserdata[$i]['AX'] = $value['AX'];
                        $inserdata[$i]['AY'] = $value['AY'];
                        $i++;
                      }               
                      $result = $this->import->importData($inserdata);   
                      if($result){
                        $this->session->set_flashdata('success','<strong>Success!</strong> Imported successfully.');
                      }else{
                        echo "ERROR !";
                      }  
                    }else{
                        $this->session->set_flashdata('danger','<strong>Error!</strong> Please check your file. The las Column should be <b>AV</b>');
                    }
//--------BSRS------------  
      
              } catch (Exception $e) {
                   die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
              }else{
                  $this->session->set_flashdata('danger','<strong>Error!</strong>'. $error['error']);
                }
                 
                 
        }
        redirect(base_url());
    }
     
}
?>