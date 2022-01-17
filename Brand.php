<?php
  $page_title = 'All Brand';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_categories = find_all('categories');
  
  $all_brand = find_all('brand');
?>
<?php
 if(isset($_POST['add_brand'])){
   $req_field = array('brand-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['brand-name']));
   $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
   if(empty($errors)){
      $sql  = "INSERT INTO brand (brand, category, date, status)";
      $sql .= " VALUES ('{$cat_name}','{$p_cat},'{new date}'')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added a Brand");
        redirect('Brand.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('Brand.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('Brand.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Brand</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="Brand.php">
            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="brand-name" placeholder="Brand Name">
                  </div>
              </div>
            </div>
            <button type="submit" name="add_brand" class="btn btn-primary">Add Brand</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Brand</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Brands</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_bnrand as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_brand.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_brand.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
