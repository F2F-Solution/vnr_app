<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Group
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="<?php echo base_url();?>user/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark">Lists</li>
            </ul>
        </div>
        <?php if($this->session->flashdata('status')): ?>
                <div id="fadeout" class="alert alert-success" role="alert">
                    <?= $this->session->flashdata('status'); ?>
                </div>
       <?php endif; ?>
        <div class="d-flex align-items-center py-1">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">Add Group</button>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
   <div id="kt_content_container" class="container-xxl">
      <div class="card">
        <div class="card-body pt-0">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="user_data">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th>S.No</th>
                        <th class="min-w-125px">Group</th>
                        <th class="min-w-125px">Status</th>
                        <th class="min-w-125px">Actions</th>
                    </tr>
                </thead>
                    <tbody> </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<!-- ADD USER -->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Add Group</h2>
                   <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                      <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="close_modal" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                 </div>
            </div>
            <div class="modal-body scroll-y">
                <form id="form" method="post" class="form" action="<?php echo base_url();?>master/group/save_data/">
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div class="fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">Group</label>
                                    <input type="text" name="group_name" id="group_name" class="form-control form-control-solid mb-3 mb-lg-0 validation"/>
                                    <span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>

                                </div>
                            <div class="mb-7">
                                    <label class="required fw-bold fs-6 mb-5">Status</label>
                                <div class="d-flex fv-row">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input me-3 validation" name="status" type="radio" value="0" id="kt_modal_update_role_option_0" checked/>
                                            <label class="form-check-label" for="kt_modal_update_role_option_0">
                                            <div class="fw-bolder text-gray-800">Active</div>
                                            </label>
                                        </div>
                                </div>
                            <div class='separator separator-dashed my-5'></div>
                            <div class="d-flex fv-row">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input me-3" name="status" type="radio" value="1" id="kt_modal_update_role_option_1" />
                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                        <div class="fw-bolder text-gray-800">Inactive</div>
                                    </label>
                                </div>
                            </div>
                            <span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                        <button type="submit"  id="submit1" class="btn btn-primary">
                            <span class="indicator-label" id="submit1">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Edit user -->
<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Edit Group</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  id="close_edit_modal" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
           </div>
         <div class="modal-body scroll-y">
            <form id="form_edit" method="post" class="form" action="<?php  echo base_url('master/group/update/')?>">
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Group</label>
                        <input type="text" name="group_name" id="group_name1" class="form-control form-control-solid mb-3 mb-lg-0 validation"  />
                        <span id="input3" class="val" style="color:#F00; font-style:oblique;"></span>
                        <input type="hidden" name="groupid" id="group_id"  />
                    </div>
                    <div class="mb-7">
                        <label class="required fw-bold fs-6 mb-5">Status</label>
                        <div class="d-flex fv-row">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input me-3 validation" name="status" type="radio" value="0" id="status_active" >Active
                            </div>
                        </div>
                        <div class='separator separator-dashed my-5'></div>
                        <div class="d-flex fv-row">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input me-3" name="status" type="radio" value="1" id="status_inactive">Inactive
                            </div>
                        </div>
                        <span id="input4" class="val" style="color:#F00; font-style:oblique;"></span>
                </div>
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                    <button type="submit" id="submit2" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- datatable -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="<?php echo $theme_path ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!-- Form validation -->
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<!-- sweet alert -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.css" rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.js"></script>

<script>
    var table;
    table = $("#user_data").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'asc']],
            ajax: {
                url:"<?php echo base_url() . '/master/group/list_data'; ?>",  
                type:"POST"
            }
        });

        $(document)	.on('click','.addAttr',function(){
		var id = $(this).attr('data-id');
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url() . 'master/group/get';?>",
			dataType : "JSON",
			data : {id:id},
			success: function(data){
				$("#group_name1").val(data.vGroupName);
                if(data.tStatus == '0')
				$("#status_active").prop("checked", true);
				else 
				$("#status_inactive").prop("checked", true);     
                $("#group_id").val(data.iGroupid);
        
			}
		});	
		return false;
	});
// <!-- FLASH DATA FADEOUT -->
    setTimeout(function() {
        $('#fadeout').hide('fast');
    }, 2000);
// sweet alert
     $(document).on('click','.removeAttr',function(event){
        event.preventDefault();
        var id = $(this).attr('data-id');
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
			console.log(result.isConfirmed);
        if (result.isConfirmed) {
			$.ajax({
				url: "<?php echo base_url() . 'master/group/delete';?>",
				type: 'POST',
				data:{id:id},
				success: function(data) {
						Swal.fire(
					'Deleted!',
					'It has been deleted.',
					'success'
					);      
					table.ajax.reload();
				}
			});
        }
     });
    });
    // validation
    $(document).ready(function () {
        $("#submit1").on('click',function () {
            var error = 0;
            $('#form').find('.validation').each(function(){
            var _val = $(this).val();
            var name = $(this).attr('name');
            var _id  = $(this).attr('id');
            var filter = /^[a-zA-Z.\s]+[\S]{1,30}$/;
            if(name == 'status'){
                var status = $('input[name="status"]:checked').length;
                // var status = 0;
                if(status == 0){
                    $(this).closest('div.form-group').find('span.val').text("Required Field");
                }else{
                    $(this).closest('div.form-group').find('span.val').text("");
                    $('input[name="status"]').removeClass('required');
                }
            }else{
                if(_val == '' || _val == null ){
                    error++;  
                    $(this).closest('div').find('span.val').text("Required Field");
                }else if (_id == "group_name" && !filter.test(_val)) {
                    error++;
                    $("#input1").html("Alphabets and Min 2 to Max 30 without space ");
               } else{
                    $(this).closest('div').find('span.val').text("");
                }    
            }
        });       
        if(error > 0){
            return false;
        }else{
        $("form").submit();
        }
     });
});
$(document).ready(function () {
        $("#submit2").on('click',function () {
            // alert(1);
            var error = 0;
            $('#form_edit').find('.validation').each(function(){
            var _val = $(this).val();
            var name = $(this).attr('name');
            var _id  = $(this).attr('id');
            var filter = /^[a-zA-Z.\s]+[\S]{1,30}$/;
            if(name == 'status'){
                var status = $('input[name="status"]:checked').length;
                // var status = 0;
                if(status == 0){
                    $(this).closest('div.form-group').find('span.val').text("Required Field");
                }else{
                    $(this).closest('div.form-group').find('span.val').text("");
                    $('input[name="status"]').removeClass('required');
                }
            }else{
                if(_val == ''|| _val == null ){
                    error++;  
                    $(this).closest('div').find('span.val').text("Required Field");
                }else if (_id ="group_name1" && !filter.test(_val)) {
                    error++;
                    $("#input3").html("Alphabets and Min 2 to Max 30 without space ");
               } else{
                    $(this).closest('div').find('span.val').text("");
                }    
            }
        });       
        if(error > 0){
            return false;
        }else{
        $("form").submit();
        }
     });
});

// modal hide
$(document).ready(function () {
        $("#close_modal").on('click',function () {
            $('#kt_modal_add_user').modal('hide');
        });
});
$(document).ready(function () {
        $("#close_edit_modal").on('click',function () {
            $('#kt_modal_edit_user').modal('hide');
        });
});

</script>