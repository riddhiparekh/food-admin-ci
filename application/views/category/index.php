<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Category</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<div class="content">
	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">Manage Categories</h5>
			<button type="button" onclick="openModal('Add Category','<?= base_url('category/create') ?>','sm')" class="btn bg-teal-400 btn-labeled pull-right btn-labeled-left rounded-round"><b><i class="icon-plus3"></i></b> Add Category</button>
		</div>
		<div class="card-body">
			
		</div>
		<table class="table my-data-table" >
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Sub Title</th>
					<th>Image</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<script src="<?= ADMIN_ASSET_URL ?>/js/form/select2.min.js"></script>
<script type="text/javascript">
	$(function(){
        invalid_form = false;
		tbl = $('.my-data-table').DataTable({
			processing: true,
			serverSide: true,
			ajax : '<?= base_url('category/list') ?>',
			columns: [
		        { data: 'id', name: 'id',width:'8%'},
		        { data: 'name', name: 'name'},
		        { data: 'sub_title', name: 'sub_title'},
		        { data: 'image', name: 'image'},
		        { data: 'is_active', name: 'status',width:'8%'},
		        { data: 'action', name: 'action',width:'8%'}
		    ]
	    });
		$('body').on('change','.status-switch',function(e){
            var id = $(this).data('id');
          	$.ajax({
          		url: '<?= base_url('category/') ?>'+id+'/status',
          		type: 'post',
          		data: {status:$(this).is(':checked')},
          		dataType: 'json',
          		success: function(a){
          			if (a.status) {
						alertNotification(a.msg,'success');
          			}else{
          				alertNotification(a.msg,'error');
          			}
          			tbl.ajax.reload( null, false );
          		}
          	});
		});
		$('.my-data-table').on( 'draw.dt', function () {
		   var elems = Array.prototype.slice.call(document.querySelectorAll('.status-switch'));
	        elems.forEach(function(html) {
	          var switchery = new Switchery(html);
	        });
		});

	    $('.my-data-table tfoot td').not(':last-child,:nth-child(4),:first-child').each(function () {
		    var title = $('.my-data-table thead th').eq($(this).index()).text();
		    $(this).html('<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />');
		});

	    tbl.columns().every( function () {
		    var that = this;
		    $('input', this.footer()).on('keyup change', function () {
		        that.search(this.value).draw();
		    });
		});
	});
	function reInitInputs() {
        $('.form-control-select2').select2();
    }
	function deleteCategory(id)
	{
		swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover category!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light',
            preConfirm: function(){
            	return new Promise(function (resolve) {
	                $.ajax({
	                	url: '<?= base_url('category/') ?>'+id+'/delete',
	                	type: 'get',
	                	dataType: 'json',
	                	success: function(a){
                			resolve();
                			swal({
                				type: a.status,
                				title: a.title,
                				text: a.msg,
                				buttonsStyling: false,
				                confirmButtonClass: 'btn btn-primary'
                			});
                			tbl.ajax.reload( null, false );
	                	},
	                	error: function(){
	                		resolve();
	                		swal({
                				title: 'Oops...',
				                text: 'Something went wrong!',
				                type: 'error',
                				buttonsStyling: false,
				                confirmButtonClass: 'btn btn-primary'
                			});
                			tbl.ajax.reload( null, false );
	                	}
	                });
                });
            }
        });
	}
</script>