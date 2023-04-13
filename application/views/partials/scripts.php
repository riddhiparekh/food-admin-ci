<!-- Core JS files -->
<script src="<?= ADMIN_ASSET_URL ?>js/jquery.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/bootstrap.bundle.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/loaders/blockui.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/uniform.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/form/tokenfield.min.js"></script>
<!-- /core JS files -->
<script src="<?= ADMIN_ASSET_URL ?>js/notifications/noty.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js\form\switchery.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/notifications/sweet_alert.min.js"></script>
<!-- Theme JS files -->
<script src="<?= ADMIN_ASSET_URL ?>/js/datatables/datatables.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/app.js"></script>
<!-- /theme JS files -->	
<script type="text/javascript">
	var invalid_form = true;
    var option_push = '';
    var tbl;
	function alertNotification(msg,type) {
		if (typeof Noty == 'undefined') {
		    console.warn('Warning - noty.min.js is not loaded.');
		    return;
		}
		// Override Noty defaults
		Noty.overrideDefaults({
		    theme: 'limitless',
		    layout: 'topRight',
		    type: 'alert',
		    timeout: 2500
		});
		new Noty({
		    text: msg,
		    type: type
		}).show();
	}
	var openModal = function(title,url,size,selectElem = '')
	{
		$('#naruto_modal .modal-title').html(title);
		$('#naruto_modal .modal-dialog').removeClass().addClass('modal-dialog modal-'+size);
		var modalBody = $('#naruto_modal .modal-body');
		$('#naruto_modal').modal('show');
		$(modalBody).block({ 
            message: '<i class="icon-spinner9 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
            	width: 16,
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
		$.ajax({
			url:url,
			type:'get',
			success:function(d){
				$('.blockOverlay').on('click', function() {
		        	$(modalBody).unblock();
		        });
				$(modalBody).html(d);
				option_push = selectElem;
				$('.form-input-styled').uniform({fileButtonClass: 'action btn bg-info-800'});
                $('.keyword-input').tokenfield();
                if (typeof reInitInputs === "function") { 
                    reInitInputs();
                }
			}
		});
	}
	$(document).ready(function(){
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            }
        });
		var url = window.location.href.replace(/\/\d+$/, "");
		$('.sidebar a[href$="'+url+'"]').addClass('active');
		$('.sidebar a.nav-link.active').parents('.nav-item').addClass('nav-item-open');
		$('.sidebar a.nav-link.active').parents('.nav-group-sub').show();
		$('body').on('submit','.ajax-action-form',function(e){
			e.preventDefault();
			if (invalid_form) {
				alertNotification('Invalid Data to Proceed!','warning');
				return false;
			}
			var action_url = $(this).data('action');
			var form = new FormData(this);
			$.ajax({
				url: action_url,
				method: 'post',
				contentType: false,
				processData: false,
				data: form,
				dataType: 'json',
				success: function(a){
					if (a.status) {
						alertNotification(a.msg,'success');
						if (option_push != '') {
							$(option_push).append(new Option(a.data.value,a.data.id));
						}else{
							tbl.ajax.reload( null, false );
						}
						option_push = '';
						$('#naruto_modal .modal-body').html('');
						$('#naruto_modal').modal('hide');
					}else{
						alertNotification(a.msg,'error');
					}
				}
			});
        });
        $(".digit").keypress(function (e) 
        {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
            {
                return false;
            }
        });
	});
</script>