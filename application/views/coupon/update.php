<form data-action="<?= base_url('coupon/' . @$record['id'] . '/update') ?>" action="#" class="ajax-action-form" method="post" autocomplete="off">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Coupon Title</label>
                        <input type="text" required placeholder="Title of Coupon" name="title" value="<?= @$record['title'] ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Coupon Code</label>
                        <input type="text" required placeholder="Enter Coupon Code" name="code" value="<?= @$record['code'] ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Description</label>
                <textarea class="form-control" name="description" placeholder="Description of Coupon"><?= @$record['description'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label>Amount</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-inr"></i></span>
                    </span>
                    <input type="text" name="amount" class="form-control digit" value="<?= floatval(@$record['amount']) ?>" placeholder="Enter coupon Price">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Amount Type:</label>
                <select name="amount_type" data-placeholder="Select amount type..." class="form-control form-control-select2" required data-fouc>
                    <option></option>
                    <option value="flat" <?= @$record['amount_type'] == 'flat' ? 'selected' : '' ?>>Flat</option>
                    <option value="percentage" <?= @$record['amount_type'] == 'percentage' ? 'selected' : '' ?>>Percentage</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>From Date:</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar22"></i></span>
                    </span>
                    <input type="text" name="valid_from" value="<?= @$record['valid_from']?>" class="form-control daterange-single">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>To Date:</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar22"></i></span>
                    </span>
                    <input type="text" name="valid_till" value="<?= @$record['valid_till']?>" class="form-control daterange-single">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Maximum orders</label>
                <input type="text" name="max_orders" value="<?= @$record['max_orders']?>" class="form-control digit" placeholder="Enter maximum orders">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Minimum Orders</label>
                <input type="text" name="min_orders" value="<?= @$record['min_orders']?>" class="form-control digit" placeholder="Enter minimum order">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Maximum order value</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-inr"></i></span>
                    </span>
                    <input type="text" name="max_order_value" value="<?= floatval(@$record['max_order_value'])?>" class="form-control digit" placeholder="Enter maximum order value">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Minimum order value</label>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-inr"></i></span>
                    </span>
                    <input type="text" name="min_order_value" value="<?= floatval(@$record['min_order_value'])?>" class="form-control digit" placeholder="Enter minimum order value">
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