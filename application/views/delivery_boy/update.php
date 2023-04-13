<form data-action="<?= base_url('delivery-boy/' . @$record['id'] . '/update') ?>" action="#" class="ajax-action-form" method="post" autocomplete="off">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Name</label>
                        <input type="text" required placeholder="Delivery boy name" value="<?= @$record['name'] ?>" name="name" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Email</label>
                        <input type="email" required placeholder="Enter Email Id" name="email" value="<?= @$record['email'] ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Contact No</label>
                        <input type="text" value="<?= @$record['contact_no'] ?>" required placeholder="Enter Contact No" name="contact_no" minlength="10" maxlength="13" class="form-control digit">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-checkmark4"></i></b> Save</button>
        </div>
    </div>
</form>