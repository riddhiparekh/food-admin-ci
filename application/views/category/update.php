<form data-action="<?= base_url('category/' . @$record['id'] . '/update') ?>" action="#" class="ajax-action-form" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Category Name</label>
                <input type="text" placeholder="Name of Category" name="name" value="<?= @$record['name'] ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Parent Category</label>
        <select name="parent_id" data-placeholder="Select category..." class="form-control form-control-select2" data-fouc>
            <option></option>
            <?php foreach ($categories as $key => $value) {
                ?>
                <option value="<?= $key ?>" <?= @$record['parent_id'] == $key ? 'selected' : '' ?>><?= $value?></option>
                <?php
            } ?>
        </select>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Sub Title</label>
                <input type="text" placeholder="Enter Category subtitle" name="subtitle" value="<?= @$record['sub_title'] ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Select Banner:</label>
        <input type="file" name="image" class="form-input-styled" data-fouc>
        <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
    </div>
    <?php if (isset($record['image'])) { ?>
    <div class="form-group">
        <img src="<?= ASSET_URL . "images/category/" . $record['image'] ?>" height="100px" width='auto'>
    </div>
    <?php } ?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Description</label>
                <textarea class="form-control" name="description" placeholder="Description of Category"><?= @$record['description'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round" <?= @$record['id'] ? '' : 'disabled' ?>><b><i class="icon-checkmark4"></i></b> Update</button>
        </div>
    </div>
</form>