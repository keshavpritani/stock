<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>
            <li class="active">Product</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
            </div>
            <!-- /panel-heading -->
            <div class="panel-body">
                <div class="remove-messages"></div>
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
                </div>
                <!-- /div-action -->				
                <table class="table" id="manageProductTable">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Stock</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->
            </div>
            <!-- /panel-body -->
        </div>
        <!-- /panel -->		
    </div>
    <!-- /col-md-12 -->
</div>
<!-- /row -->
<!-- add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
                </div>
                <div class="modal-body" style="max-height:450px; overflow:auto;">
                    <!-- /form-group-->	     	           	       
                    <div class="form-group">
                        <label for="productName" class="col-sm-3 control-label">Product Name: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="productName" placeholder="Product Name" name="productName" autocomplete="off">
                        </div>
                    </div>
                    <!-- /form-group-->	         	 
                    <!-- <div class="form-group">
                        <label for="rate" class="col-sm-3 control-label">Rate: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="number" min=0 class="form-control" id="rate" placeholder="Rate" name="rate" autocomplete="off">
                        </div>
                    </div> -->
                    <!-- /form-group-->	     	        
                    <!-- <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Company Name: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="brandName" name="brandName">
                                <option value="">SELECT</option>
                                <?php
									$sql = "SELECT brand_id, brand_name, brand_status FROM brands WHERE brand_status = 1";
									$result = $connect->query($sql);

									while ($row = $result->fetch_array())
									    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";

								?>
                            </select>
                        </div>
                    </div> -->
                    <!-- /form-group-->	
                    <div class="form-group">
                        <label for="categoryName" class="col-sm-3 control-label">Materials: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-offset-4 col-sm-8">
                            <table class="table" id="materialTable">
                                <?php
									$arrayNumber = 0;
									for ($x = 1;$x < 3;$x++)
									{ 
								?>
                                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                    <td style="width: 50%;">
                                        <select type="text" class="form-control" id="categoryName" placeholder="Product Name" name="categoryName[]" >
                                            <option value="">SELECT</option>
                                            <?php
                                            	$sql = "SELECT categories_id, categories_name, categories_status FROM categories WHERE categories_status = 1";
                                            	$result = $connect->query($sql);

                                            	while ($row = $result->fetch_array())
											    	echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";  
											?>
                                        </select>
                                    </td>
                                    <!-- </div>
                                        <div class="col-sm-3"> -->
                                    <td>
                                        <input type="number" class="form-control" id="qty" placeholder="Quantity" step=".001" min=0 name="qty[]" autocomplete="off">
                                    </td>
                                    <td>
                                        <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
									    $arrayNumber++;
									} // /for
								?>
                            </table>
                        </div>
                    </div>
                    <!-- /form-group-->	         	        
                </div>
                <!-- /modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                    <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                </div>
                <!-- /modal-footer -->	      
            </form>
            <!-- /.form -->	     
        </div>
        <!-- /modal-content -->    
    </div>
    <!-- /modal-dailog -->
</div>
<!-- /add categories -->
<!-- edit categories brand -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Product</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">
                <div class="div-loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="div-result">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>
                    </ul>
                    <!-- Tab panes -->
                    
                        <div role="tabpanel" class="tab-pane" id="productInfo">
                            <form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">
                                <br />
                                <div id="edit-product-messages"></div>
                                <div class="form-group">
                                    <label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
                                    </div>
                                </div>
                                <!-- /form-group-->	        	 
                                <!-- <div class="form-group">
                                    <label for="editRate" class="col-sm-3 control-label">Rate: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editRate" placeholder="Rate" name="editRate" autocomplete="off">
                                    </div>
                                </div> -->
                                <!-- /form-group-->	     	        
                                 <!--<div class="form-group">
                                    <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="editBrandName" name="editBrandName">
                                            <option value="">SELECT</option>
                                            <?php
												$sql = "SELECT brand_id, brand_name, brand_status FROM brands WHERE brand_status = 1";
												$result = $connect->query($sql);

												while ($row = $result->fetch_array())
												{
												    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
												} // while

											?>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- /form-group-->	
                                <div class="form-group">
                        <label for="categoryName" class="col-sm-3 control-label">Materials: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-default" onclick="addRow(1)" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-offset-4 col-sm-8">
                            <table class="table" id="materialTable1">
                                <?php
                                    $arrayNumber = 0;
                                    for ($x = 1;$x < 2;$x++)
                                    { 
                                ?>
                                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                    <td style="width: 50%;">
                                        <select type="text" class="form-control" id="categoryName<?php echo $x; ?>" placeholder="Product Name" name="categoryName[]" >
                                            <option value="">SELECT</option>
                                            <?php
                                                $sql = "SELECT categories_id, categories_name, categories_status FROM categories WHERE categories_status = 1";
                                                $result = $connect->query($sql);

                                                while ($row = $result->fetch_array())
                                                    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";  
                                            ?>
                                        </select>
                                    </td>
                                    <!-- </div>
                                        <div class="col-sm-3"> -->
                                    <td>
                                        <input type="number" class="form-control" id="rate<?php echo $x; ?>" placeholder="Quantity" min=0 name="qty[]" step=".001" autocomplete="off">
                                    </td>
                                </tr>
                                <?php
                                        $arrayNumber++;
                                    } // /for
                                ?>
                            </table>
                        </div>
                    </div>
                                
                                <!-- /form-group-->	         	        
                                <div class="modal-footer editProductFooter">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                                    <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                                </div>
                                <!-- /modal-footer -->				     
                            </form>
                            <!-- /.form -->				     	
                        </div>
                        <!-- /product info -->
                    </div>
                </div>
            </div>
            <!-- /modal-body -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- /categories brand -->
<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Product</h4>
            </div>
            <div class="modal-body">
                <div class="removeProductMessages"></div>
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /categories brand -->
<script src="custom/js/product.js"></script>
<?php require_once 'includes/footer.php'; ?>
