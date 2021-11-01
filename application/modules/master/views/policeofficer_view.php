<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Police officer
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
        <div class="d-flex align-items-center py-1">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">Add Police officer</button>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-4" id="user_data">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th>S.No</th>
                            <th >Officer Name</th>
							<th>Image</th>
                            <th>Email</th>
							<th>Contact NO</th>
							<th>Designation</th>
							<th>Department</th>
							<th>Group</th>
							<th>Police station</th>
                            <th >Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody  class="text-gray-600 fw-bold">
                        
                     </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Add Details of Police Officers</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y">
                <form id="kt_modal_add_user_form" method="post" class="form" action="<?php echo base_url();?>master/police_officer/save_data/" enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                                <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Officer Name </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="name" />
                                    </div>
									<div class="fv-row mb-10">
									<label class="d-flex align-items-center fs-5 fw-bold ">
										<span class="required"> Email </span>
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
									</label>
									<input type="text" class="form-control form-control-lg form-control-solid" name="email" />
									</div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Contact NO </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="number" />
                                    </div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Gender </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
										<div class="form-check form-check-custom form-check-solid me-10">
											<input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioLg"/>
											<label class="form-check-label" for="flexRadioLg"> Female </label>
                                   		</div><br>
                                   		<div class="form-check form-check-custom form-check-solid me-10">
											<input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioLg"/>
											<label class="form-check-label" for="flexRadioLg">Male </label>
                                 		</div>
                                    </div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required"> Designation </span>
											<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
										</label>
										<select class="form-select form-select-solid " name="designation" aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['designation_name'] as $row){
										       echo  '<option value="'.$row->iDesignationId.'">'.$row->vDesignationName.'</option>';
											}
											?>
										</select>								
									</div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required">Department </span>
											<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
										</label>
										<select class="form-select form-select-solid "  name="department"  aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['department_name'] as $row){
										       echo  '<option value="'.$row->iDepartmentId.'">'.$row->vDepartmentName.'</option>';
											}
											?>
										</select>									
									</div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required">Group</span>
											<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify group"></i>
										</label>
										<select class="form-select form-select-solid "  name="group"  aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['group_name'] as $row){
										       echo  '<option value="'.$row->iGroupid.'">'.$row->vGroupName.'</option>';
											}
											?>
										</select>									
									</div>
									<div class="fv-row mb-10">
											<label class="d-flex align-items-center fs-5 fw-bold ">
												<span class="required">Police station</span>
												<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify police station"></i>
											</label>
											<input type="text" class="form-control form-control-lg form-control-solid" name="station" placeholder="" value="" />
									</div>
                                    <div class="fv-row mb-10">
									<div class="col-lg-8">
										<!--begin::Image input-->
										<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/avatars/blank.png')">
											<!--begin::Preview existing avatar-->
											<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('assets/media/svg/brand-logos/volicity-9.svg')"></div>
											<!--end::Preview existing avatar-->
											<!--begin::Label-->
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
												<i class="bi bi-pencil-fill fs-7"></i>
												<!--begin::Inputs-->
												<input type="file" name="image" accept=".png, .jpg, .jpeg" />
												<!-- <input type="hidden"  name="avatar_remove" /> -->
												<!--end::Inputs-->
											</label>
											<!--end::Label-->
											<!--begin::Cancel-->
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Cancel-->
											<!--begin::Remove-->
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<!--end::Remove-->
										</div>
										<!--end::Image input-->
										<!--begin::Hint-->
										<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
										<!--end::Hint-->
									</div>
                                </div><br>
                            </div>
                          </div>
                        	<button type="submit" class="btn btn-lg btn-primary" >Submit</button>
                        </div>
                    </div>
                </form>
           </div>
     </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>   

<script type="text/javascript" language="javascript" >  

 $(document).ready(function(){  
      var dataTable = $('#user_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
			url:"<?php echo base_url() . 'police_officer/list_data'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 3, 4],  
                     "orderable":false,  
                },  
           ],  
      });  
 });   
 </script>  



<!-- <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script>
$(document).ready(function () {
$("#submit1").on('click',function () {
var error = 0;
$('#form').find('.required').each(function(){
var _val = $(this).val();
var type = $(this).attr('type');
if(type == 'radio'){
    var gender = $('input[name="status"]:checked').length;
    
    if(gender == 0){
        $(this).closest('div.form-group').find('span.val').text("Required Field");
    }else{
        $(this).closest('div.form-group').find('span.val').text("");
        $('input[name="gender"]').removeClass('required');
    }
}else{
    if(_val == ''){
        error++;  
        $(this).closest('div').find('span.val').text("Required Field");
    }else{
        $(this).closest('div').find('span.val').text("");
    }    
}

});//alert(error);
if(error > 0){
    return false;
}else{
$("form").submit();
}
});
var form_validation = false;
$(".group_name").on('blur', function() {
    var name = $(".group_name").val();
    var filter = /^[a-zA-Z.\s]+[\S]{3,30}$/;
    if (name == "" || name == null || name.trim().length == 0) {
        form_validation = false;
        $("#input1").html("Required Field");
        // return false;
    } else if (!filter.test(name)) {
        form_validation = false;
        $("#input1").html("Alphabets and Min 3 to Max 30 without space ");
        // return false;
    } else {
        $("#input1").html("");
        form_validation = true;
        // return true;
    }
});
$(".status").on('blur', function() {
var status = $("#status").val();
if (status == "") {
    form_validation = false;
    $("#input2").html("Required Field");
}else {
    form_validation = true;
    $("#input2").html("");
}
});
});
</script> -->



<!-- <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.submit').click(function () {
            m = 0;
            $('.required').each(function () {
                this_val = $.trim($(this).val());
                this_id = $(this).attr('id');
                this_ele = $(this);
                if (this_val == '') {
                    $(this).closest('div.form-group').find('.error_msg').text('This field is required').slideDown('500').css('display', 'inline-block');
                    m++;
                } else {
                    $(this).closest('div.form-group').find('.error_msg').text('').slideUp('500');
                }
            });
            if (m > 0)
                return false;
        });
    });
</script> -->