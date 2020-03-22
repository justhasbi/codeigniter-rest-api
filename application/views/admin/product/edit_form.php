<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("admin/_partials/head.php");?>
</head>
<body>
    
    <div class="wrapper">

        <!-- sidebar -->
        
        <?php $this->load->view("admin/_partials/sidebar.php");?>

        <!-- page content -->
        <div id="content">

            <?php if($this->session->flashdata('success')): ?>
			<div class="alert alert-success" role="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>

			<?php endif; ?>

			<div class="card mb-3">
				<div class="card-header">
					<a href="<?php echo site_url('admin/products/')?>"><i class="fas fa-arrow-left"></i> Back</a>
				</div>

				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?php echo $product->id_product?>" />

						<div class="form-group">
							<label for="product_name">Name*</label>
							<input type="text" class="form-control <?php echo form_error('product_name') ? 'is-invalid':'' ?>" name="product_name" placeholder="Product Name" value="<?php echo $product->product_name ?>"/>

							<div class="invalid-feedback">
								<?php echo form_error('product_name') ?>
							</div>
						</div>

						<div class="form-group">
							<label for="price">Price*</label>
							<input type="number" class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>" name="price" min="0" placeholder="Product price" value="<?php echo $product->price ?>"/>

							<div class="invalid-feedback">
								<?php echo form_error('price') ?>
							</div>
						</div>

						<div class="form-group">
								<label for="image">Photo</label>
								<input class="form-control-file <?php echo form_error('image') ? 'is-invalid':'' ?>"
								 type="file" name="image"/>
                                 <input type="hidden" name="old-image" value="<?php echo $product->image ?>"/>
								<div class="invalid-feedback">
									<?php echo form_error('image') ?>
								</div>
							</div>

						<div class="form-group">
							<label for="name">Description*</label>
							<textarea name="description" class="form-control <?php echo form_error('description') ? 'is-invalid':'' ?>" placeholder="Product Description..." ><?php echo $product->description ?></textarea>

							<div class="invalid-feedback">
								<?php echo form_error('price') ?>
							</div>
						</div>

						<input class="btn btn-success" type="submit" name="btn" value="Save" />

					</form>
				</div>

				<div class="card-footer small text-muted">
						* required fields
				</div>

			</div>

        </div>
        
    </div>

    <?php $this->load->view("admin/_partials/js.php");?>
</body>
</html>