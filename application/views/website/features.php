<?php 
    if($this->session->flashdata('success')){
?>
    <script>
        $('document').ready(function(){
            alertNotification('<?= $this->session->flashdata('success') ?>','success');
        });
    </script>
<?php } 
if($this->session->flashdata('fail')){ ?>
    <script>
        $('document').ready(function(){
            alertNotification('<?= $this->session->flashdata('fail') ?>','error');
        });
    </script>
<?php } ?>
<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item">Website</span>
				<span class="breadcrumb-item active">Features</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<?php $featuresContent = json_decode(@$pageData[0]['content']); $featuresContent = (array)$featuresContent ?>
<div class="content">
    <form action="<?= base_url('website/features')?>" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Manage Feature</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 form-group">
                            <label>Title</label>
                            <input type="text" placeholder="Enter Feature Title" value="<?= @$featuresContent['title'] ?>" name="title" class="form-control" required>
                            <input type="hidden" value="features" name="type">
                        </div>
                        <div class="col-sm-12 col-xs-12 form-group">
                            <label>Content</label>
                            <textarea type="text" placeholder="Enter Feature Content" name="content" class="form-control" required><?= @$featuresContent['content'] ?></textarea>
                        </div>
    
                        <?php 
                            for($i=1; $i <= 6; $i++){ ?>
                            <div class="col-sm-4 col-xs-12 form-group">
                                <label>Icon <?= $i ?></label>
                                <input type="text" placeholder="Enter Feature Icon Code" value="<?= @$featuresContent['icon'.$i] ?>" name="icon<?= $i ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-4 col-xs-12 form-group">
                                <label>Heading <?= $i ?></label>
                                <input type="text" placeholder="Enter Feature Heading" value="<?= @$featuresContent['heading'.$i] ?>" name="heading<?= $i ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-4 col-xs-12 form-group">
                                <label>Description <?= $i ?></label>
                                <textarea placeholder="Enter Feature Description <?= $i ?>" name="description<?= $i ?>" class="form-control" required><?= @$featuresContent['description'.$i] ?></textarea>
                            </div>
                        <?php } ?>

                        <div class="col-sm-12 col-xs-12 form-group text-right">
                            <button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-checkmark4"></i></b> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
