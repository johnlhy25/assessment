<!DOCTYPE html>
<html lang="en">
<head>
  <title>Evidences</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  *{
    font-family: 'Poppins', sans-serif;
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
        <h1><strong><i class="fa fa-file-pdf" style="color:#EF5350"></i> Employment Report</strong></h1>    
        <small><i class="fa fa-tv"></i> TESDA DOS INTEGRATED SYSTEM (TDIS) <b>v 2.1.0</b> | &copy <?= date('Y');?> <b>TESDA DOS ICTU</b>. Site developed and managed with <i class="fa fa-heart" style="color:#E53935"></i> by <strong>TESDA DOS ICTU</strong></small>  
    </div>
</div>
  
<div class="container">
 <!--Card-->
  <div class="card">
    <div class="card-body">
      <div class="col-md-12">
        
        <div class="row">

          <div class="col-md-4">

          </div>

          <div class="col-md-8">
          
            <?php if($this->session->flashdata('danger')) : ?>
              <div id="alert" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="fa fa-times-circle" aria-hidden="true"></i> Error!</strong> Invalid file.
              </div>
            <?php $this->session->unset_userdata('danger'); endif;?>

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
              <label><b><i class="fa fa-file-excel" aria-hidden="true"></i> T2MIS and BSRS RWAC Generated</b></label> 
              <input type="file" name="uploadFile" value="" /><br><br>
              <input type="submit" name="submit" value="Import" class="btn btn-primary" ></input>
            </form>  

          </div>

        </div>
      </div>
     
    </div>
  </div>
<!--Card-->  
</div>

<div class="container mt-4">
        <h2>Report Data</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Province</th>
                    <th>TTI/TVI</th>
                    <th>Number of Employed</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($report_data)): ?>
                    <?php foreach ($report_data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['B']) ?></td>
                            <td><?= htmlspecialchars($row['E']) ?></td>
                            <td><?= htmlspecialchars($row['count_T']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No data found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<!--Scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url()."assets/js/script.js"?>"></script>
<!--Scripts-->

</body>
</html>
