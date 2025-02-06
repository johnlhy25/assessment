<!DOCTYPE html>
<html lang="en">
<head>
<title>TDIS | Assessment Reporting System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<style>
  table {border-collapse: collapse; }
  th, td { border: 1px solid black; padding: 8px; text-align: left; }
  th { background-color: #f2f2f2; }
  .toggle { cursor: pointer; color: blue; font-weight: bold; }
  .hidden { display: none; }
  .upload-container {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    width: 100%;
    position: relative;
  }
  .upload-container:hover {
    background-color: #f0f0f0;
  }
  .upload-container p {
    margin: 0;
    font-size: 16px;
    color: #555;
  }
  .hidden-input {
    display: none;
  }
  .filename {
    font-weight: bold;
    margin-top: 10px;
    color: #333;
  }
</style>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">     
        <a class="navbar-brand" href="#"><i class="fa fa-laptop" style="color:#FFCA28"></i> &nbsp TDIS </a>
    </div>
</nav>

<div class="jumbotron" style="margin-bottom:10px;background-color:#E0E0E0">
    <div class="container">     
        <h1><strong><i class="fa fa-file-pdf" style="color:#EF5350"></i> Assessment Reporting System</strong></h1>    
        <small><i class="fa fa-tv"></i> TESDA DOS INTEGRATED SYSTEM (TDIS) <b>v 2.1.0</b> | &copy <?= date('Y');?> <b>TESDA DOS ICTU</b>. Site developed and managed with <i class="fa fa-heart" style="color:#E53935"></i> by <strong>TESDA DOS ICTU</strong></small>  
    </div>
</div>
  
<div class="container">
 <!--Card-->
  <div class="card">
    <div class="card-body">
      <div class="col-md-12">
        
        <div class="row">
          <div class="col-md-12">
          
            <?php if($this->session->flashdata('danger')) : ?>
              <div id="alert" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-times-circle" aria-hidden="true"></i> Error!</strong> Invalid file.
              </div>
            <?php $this->session->unset_userdata('danger'); endif;?>

            <?php if($this->session->flashdata('danger1')) : ?>
              <div id="alert" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-times-circle" aria-hidden="true"></i> Error!</strong> Invalid/protected file.
              </div>
            <?php $this->session->unset_userdata('danger1'); endif;?>

            <?php if($this->session->flashdata('success')) : ?>
              <div id="alert" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-check-circle"></i> Success!</strong> Imported successfully.
              </div>
            <?php $this->session->unset_userdata('success'); endif;?>

            <?php if($this->session->flashdata('file')) : ?>
              <div id="alert" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-ban" aria-hidden="true"></i> Error!</strong> The filetype you are attempting to upload is not allowed..
              </div>
            <?php $this->session->unset_userdata('file'); endif;?>

            <form action="<?= base_url();?>import/importFile" method="post" enctype="multipart/form-data">
              <label><b><i class="fa fa-file-excel" aria-hidden="true"></i> BSRS RWAC Generated</b></label>

              <!-- Drag-and-drop container -->
              <div class="upload-container" id="dragDropArea">
                <p>Drag & Drop your file here or click to select</p>
                <input type="file" name="uploadFile" id="fileInput" class="hidden-input" />
                <p id="filename" class="filename"></p> <!-- Filename will appear here -->
              </div>

              <input type="submit" name="submit" value="Import" class="btn btn-primary mt-1" style="width:100%">
            </form>  

          </div>

        </div>
      </div>
     
    </div>
  </div>
<!--Card-->  

<!-- Table -->
<div class="container mt-4">
    <h2>Assessment Data</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Province</th>
                <th>TVI</th>
                <th>RQM Number</th>
                <th>Competent</th>
                <th>Not Yet Competent</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $total_competent = 0;
                $total_not_yet_competent = 0;
            ?>
            <?php foreach ($table_data as $province => $schools): ?>
                <?php 
                    $province_total_competent = 0;
                    $province_total_not_yet_competent = 0;
                ?>
                <tr class="toggle province" data-target="province-<?= md5($province) ?>">
                    <td><?= strtoupper($province) ?> <span>[+]</span></td>
                    <td colspan="4"></td>
                </tr>
                <?php foreach ($schools as $school => $rqms): ?>
                    <?php 
                        $school_total_competent = 0;
                        $school_total_not_yet_competent = 0;
                    ?>
                    <tr class="toggle school hidden province-<?= md5($province) ?>" data-target="school-<?= md5($school) ?>">
                        <td></td>
                        <td><?= strtoupper($school) ?> <span>[+]</span></td>
                        <td colspan="3"></td>
                    </tr>
                    <?php foreach ($rqms as $rqm_number => $counts): ?>
                        <tr class="hidden school-<?= md5($school) ?>">
                            <td></td>
                            <td></td>
                            <td><?= $rqm_number ?></td>
                            <td><?= $counts['competent'] ?></td>
                            <td><?= $counts['not_yet_competent'] ?></td>
                        </tr>
                        <?php 
                            // Add to school total
                            $school_total_competent += $counts['competent'];
                            $school_total_not_yet_competent += $counts['not_yet_competent'];
                        ?>
                    <?php endforeach; ?>
                    <!-- Total for each school -->
                    <tr class="hidden school-<?= md5($school) ?> font-weight-bold" style="background-color:#E3F2FD">
                        <td></td>
                        <td><?= strtoupper($school) ?></td>
                        <td></td>
                        <td><?= $school_total_competent ?></td>
                        <td><?= $school_total_not_yet_competent ?></td>
                    </tr>
                    <?php 
                        // Add to province total
                        $province_total_competent += $school_total_competent;
                        $province_total_not_yet_competent += $school_total_not_yet_competent;
                    ?>
                <?php endforeach; ?>
                <!-- Total for each province -->
                <tr class="hidden province-<?= md5($province) ?> font-weight-bold" style="background-color:#2196F3" >
                    <td><?= strtoupper($province) ?></td>
                    <td></td>
                    <td></td>
                    <td><?= $province_total_competent ?></td>
                    <td><?= $province_total_not_yet_competent ?></td>
                </tr>
                <?php 
                    // Add to grand total
                    $total_competent += $province_total_competent;
                    $total_not_yet_competent += $province_total_not_yet_competent;
                ?>
            <?php endforeach; ?>
        </tbody>
        <!-- Grand Total Row -->
        <tfoot>
            <tr class="font-weight-bold text-white" style="background-color:#0D47A1; color:white" >
                <td colspan="3" class="text-right">Grand Total:</td>
                <td><?= $total_competent ?></td>
                <td><?= $total_not_yet_competent ?></td>
            </tr>
        </tfoot>
    </table>

    <!-- Download Button -->
    <button class="btn btn-success" onclick="window.location.href='<?= base_url('export_excel') ?>'">
        <i class="fas fa-file-excel"></i> Download Excel
    </button>
</div>
<!-- Table -->

<script>
$(document).ready(function() {
    $(".toggle").click(function() {
        let targetClass = $(this).attr("data-target");
        $("." + targetClass).toggleClass("hidden");

        // Change the [+] / [-] symbol
        let symbol = $(this).find("span").text() === "[+]" ? "[-]" : "[+]";
        $(this).find("span").text(symbol);
    });
});

  const dragDropArea = document.getElementById("dragDropArea");
  const fileInput = document.getElementById("fileInput");
  const filenameDisplay = document.getElementById("filename");

  dragDropArea.addEventListener("click", function () {
    fileInput.click(); // Trigger file input when the container is clicked
  });

  dragDropArea.addEventListener("dragover", function (event) {
    event.preventDefault();
    dragDropArea.style.backgroundColor = "#e9e9e9"; // Highlight container
  });

  dragDropArea.addEventListener("dragleave", function () {
    dragDropArea.style.backgroundColor = ""; // Remove highlight when drag leaves
  });

  dragDropArea.addEventListener("drop", function (event) {
    event.preventDefault();
    const file = event.dataTransfer.files[0]; // Get the dropped file
    fileInput.files = event.dataTransfer.files; // Set file input files to the dropped file
    dragDropArea.style.backgroundColor = ""; // Reset the background

    // Update the filename display
    filenameDisplay.textContent = `File: ${file.name}`; 
  });

  fileInput.addEventListener("change", function () {
    const file = fileInput.files[0]; // Get selected file
    if (file) {
      filenameDisplay.textContent = `File: ${file.name}`; // Display filename
    }
  });
</script>


</body>
</html>
