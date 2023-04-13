<form data-action="<?= base_url('product/create')?>" action="#" class="ajax-action-form" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="form-group">
        <label>Select Category:</label>
        <select name="category" data-placeholder="Select category..." class="form-control form-control-select2" required data-fouc>
            <option></option>
            <?php foreach ($categories as $key => $value) {
                ?>
                <option value="<?= $key ?>"><?= $value?></option>
                <?php
            } ?>
        </select>
    </div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label>Product Name</label>
				<input type="text" placeholder="Name of Product" name="name" class="form-control">
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label>Sub Title</label>
				<input type="text" placeholder="Enter Product subtitle" name="sub_title" class="form-control">
			</div>
		</div>
    </div>
    <div class="form-group">
        <label>Enter product price:</label>
        <div class="input-group">
            <span class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-inr"></i></span>
            </span>
            <input type="text" name="price" value="101" class="form-control digit" placeholder="Enter product Price">
        </div>
    </div>
    <div class="form-group">
		<label>Select Images:</label>
		<input type="file" name="images[]" multiple class="form-input-styled" data-fouc>
		<span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label>Description</label>
				<textarea class="form-control" name="description" placeholder="Description of Product"></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-right">
			<button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-checkmark4"></i></b> Save</button>
		</div>
	</div>
</form>