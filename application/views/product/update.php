<form data-action=" <?= base_url('product/' . @$record['id'] . '/update') ?>" action="#" class="ajax-action-form" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="form-group">
        <label>Select Category:</label>
        <select name="category" data-placeholder="Select category..." class="form-control form-control-select2" required data-fouc>
            <option></option>
            <?php
            $category = array_column($record['categories'], 'category_id');
            foreach ($categories as $key => $value) {
                ?>
            <option <?= in_array($key, $category) ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
            <?php
            } ?>
        </select>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Product Name</label>
                <input type="text" placeholder="Name of Product" name="name" class="form-control" value="<?= @$record['name'] ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Sub Title</label>
                <input type="text" placeholder="Enter Product subtitle" name="subtitle" class="form-control" value="<?= @$record['sub_title'] ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Enter product price:</label>
        <div class="input-group">
            <span class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-inr"></i></span>
            </span>
            <input type="text" name="price" required class="form-control digit" placeholder="Enter product Price" value="<?= @$record['price'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Select Images:</label>
        <input type="file" name="image[]" multiple class="form-input-styled" data-fouc>
        <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
    </div>
    <?php
    if (isset($record['images'])) {
        ?>
    <div class="form-group">
        <?php
            foreach ($record['images'] as $img) {
                ?>
        <img src="<?= ASSET_URL . "images/product/" . $img ?>" height="100px" width='auto'>
        <?php
            } ?>
    </div>
    <?php } ?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Description</label>
                <textarea class="form-control" name="description" placeholder="Description of Product"><?= @$record['description'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-checkmark4"></i></b> Save</button>
        </div>
    </div>
</form>