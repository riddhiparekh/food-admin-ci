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
				<span class="breadcrumb-item active">Benitits</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<?php $benifitsContent = json_decode(@$pageData[0]['content']); $benifitsContent = (array)$benifitsContent ?>
<div class="content">
    <form action="<?= base_url('website/benifits')?>" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Manage Benitits</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 form-group">
                            <label>Title</label>
                            <input type="text" placeholder="Enter Benitits Title" value="<?= @$benifitsContent['title'] ?>" name="title" class="form-control" required>
                            <input type="hidden" value="benifits" name="type">
                        </div>
                        <div class="col-sm-12 col-xs-12 form-group">
                            <label>Content</label>
                            <textarea type="text" placeholder="Enter Benitits Content" name="content" class="form-control" required><?= @$benifitsContent['content'] ?></textarea>
                        </div>
    
                        <?php 
                            for($i=1; $i <= 6; $i++){ ?>
                            <div class="col-sm-4 col-xs-12 form-group">
                                <label>Icon <?= $i ?></label>
                                <input type="text" placeholder="Enter Benitits Icon Code" value="<?= @$benifitsContent['icon'.$i] ?>" name="icon<?= $i ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-4 col-xs-12 form-group">
                                <label>Heading <?= $i ?></label>
                                <input type="text" placeholder="Enter Benitits Heading" value="<?= @$benifitsContent['heading'.$i] ?>" name="heading<?= $i ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-4 col-xs-12 form-group">
                                <label>Description <?= $i ?></label>
                                <textarea placeholder="Enter Benitits Description <?= $i ?>" name="description<?= $i ?>" class="form-control" required><?= @$benifitsContent['description'.$i] ?></textarea>
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
