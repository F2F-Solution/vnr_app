<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>


<style>
.popup{
    position:fixed;
    top:10%;
    left: 40%;
    height:400px;
    width: 600px;
    background:color:#fff;
    padding:15px;
    box-shadow: 3px 3px 5px #aaa;
    display: none;
}

.popup img{
    height:100%;
    width:100%;
}
</style>
<link href="<?php echo $theme_path ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
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
		<?php if($this->session->flashdata('status')): ?>
                <div id="fadeout" class="alert alert-success" role="alert">
                    <?= $this->session->flashdata('status'); ?>
                </div>
        <?php endif; ?>
        <div class="d-flex align-items-center py-1">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">Add Police officer</button>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-4 dataTables" id="user_data">
                    <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th>S.No</th>
                            <th>Image</th>
							<th>Officer Name</th>
							<th>Gender</th>     
                            <th>Email</th>
							<th>Contact NO</th>
							<th>Designation</th>
							<th>Department</th>
							<th>Group</th>
							<th>Police station</th>
							<th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="close_modal" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y">
                <form id="form" method="post" class="form" action="<?php echo base_url();?>master/police_officer/save_data/" enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                                <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
									<div class="fv-row mb-10">
                                            <label class="required d-flex align-items-center fs-5 fw-bold ">
                                                <span class="">Officer Name </span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="name" id="name" />
											<span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
										</div>
										<div class="col-lg-8">
											<label class="d-flex align-items-center fs-5 fw-bold ">
												<span class="required">Officer Image </span>
											</label>
										<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('../assets/media/avatars/blank.png')">
											<div class="image-input-wrapper w-125px h-125px bgi-position-center officer_file" style="background-size: 75%; background-image: url('../assets/media/svg/brand-logos/volicity-9.svg')"></div>
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
												<i class="bi bi-pencil-fill fs-7" id="upload-img"></i>
												<input type="file" class="validation" name="image" id="image" accept=".png, .jpg, .jpeg" />
											</label>
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
										</div>
										<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
									</div>
									<span id="input9" class="val" style="color:#F00; font-style:oblique;"></span>	
                                </div><br>
                            </div>
									<div class="fv-row mb-10">
									<label class="required d-flex align-items-center fs-5 fw-bold ">
										<span class=""> Email </span>
									</label>
									<input type="text" class="form-control form-control-lg form-control-solid validation" name="email"  id="email"/>
									<span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
								</div>
									<div class="fv-row mb-10">
                                            <label class="required d-flex align-items-center fs-5 fw-bold ">
                                                <span class="">Contact NO </span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="number" id="number" />
											<span id="input3" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
									<div class="fv-row mb-10">
                                            <label class="required d-flex align-items-center fs-5 fw-bold ">
                                                <span class="">Gender </span>
                                            </label>
										<div class="form-check form-check-custom form-check-solid me-10">
											<input class="form-check-input validation" type="radio" name="gender" value="female" id="flexRadioLg"/>
											<label class="form-check-label" for="flexRadioLg"> Female </label>
                                   		</div><br>
                                   		<div class="form-check form-check-custom form-check-solid me-10">
											<input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioLg"/>
											<label class="form-check-label" for="flexRadioLg">Male </label>
                                 		</div>
										 <span id="input4" class="val" style="color:#F00; font-style:oblique;"></span>

                                    </div>
									<div class="fv-row mb-10">
										<label class="required d-flex align-items-center fs-5 fw-bold ">
											<span class=""> Designation </span>
										</label>
										<select class="form-select form-select-solid validation" name="designation" aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['designation_name'] as $row){
										       echo  '<option value="'.$row->iDesignationId.'">'.$row->vDesignationName.'</option>';
											}
											?>
										</select>	
										<!-- <span id="input5" class="val" style="color:#F00; font-style:oblique;"></span> -->
									</div>
									<div class="fv-row mb-10">
										<label class="required d-flex align-items-center fs-5 fw-bold ">
											<span class="">Department </span>
										</label>
										<select class="form-select form-select-solid validation "  name="department"  aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['department_name'] as $row){
										       echo  '<option value="'.$row->iDepartmentId.'">'.$row->vDepartmentName.'</option>';
											}
											?>
										</select>	
									</div>
									<div class="fv-row mb-10">
										<label class="required d-flex align-items-center fs-5 fw-bold ">
											<span class="">Group</span>
										</label>
										<select class="form-select form-select-solid validation"  name="group"  aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['group_name'] as $row){
										       echo  '<option value="'.$row->iGroupid.'">'.$row->vGroupName.'</option>';
											}
											?>
										</select>
									</div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold required">
											<span class="">Station Name</span>
										</label>
										<select class="form-select form-select-solid validation "  name="station"  aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['station_name'] as $row){
										       echo  '<option value="'.$row->iPoliceStationId.'">'.$row->vStationName.'</option>';
											}
											?>
										</select>
									</div>
									<!-- <div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold required">
											<span class="">Station Address</span>
										</label>
										<select class="form-select form-select-solid validation "  name="station"  aria-label="Select example">
											<option>SELECT</option>
											<?php
											// foreach($groups['station_address'] as $row){
										    //    echo  '<option value="'.$row->iPoliceStationId.'">'.$row->vAddress.'</option>';
											// }
											?>
										</select>
									</div> -->
									<!-- <div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold required">
											<span class="">Pincode</span>
										</label>
										<select class="form-select form-select-solid validation "  name="station"  aria-label="Select example">
											<option>SELECT</option>
											<?php
											// foreach($groups['station_pincode'] as $row){
										    //    echo  '<option value="'.$row->iPoliceStationId.'">'.$row->iPincode.'</option>';
											// }
											?>
										</select>
									</div> -->
                                    <div class="fv-row mb-10">
									<div class="mb-7">
									<label class="required fw-bold fs-6 mb-5">Status</label>
									<div class="d-flex fv-row">
										<div class="form-check form-check-custom form-check-solid">
											<input class="form-check-input me-3 validation" name="status" type="radio" value="0" id="kt_modal_update_role_option_0" checked />
											<label class="form-check-label" for="kt_modal_update_role_option_0">
												<div class="fw-bolder text-gray-800">Active</div>
											</label>
										</div>
									</div>
									<div class='separator separator-dashed my-5'></div>
									<div class="d-flex fv-row">
										<div class="form-check form-check-custom form-check-solid">
											<input class="form-check-input me-3 " name="status" type="radio" value="1" id="kt_modal_update_role_option_1" />
											<label class="form-check-label" for="kt_modal_update_role_option_1">
												<div class="fw-bolder text-gray-800">Inactive</div>
											</label>
										</div>
									</div>
									<span id="input10" class="val" style="color:#F00; font-style:oblique;"></span>
								</div>
							</div>
                        	<button type="submit" class="btn btn-lg btn-primary" id="submit1" >Submit</button>
                        </div>
                    </div>
                </form>
           </div>
     </div>
</div>  
</div>
<!-- EDIT PAGE -->
<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Edit Details of Police Officers</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  id="close_edit_modal" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" 	height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y">
                <form id="editform" method="post" class="form"  action="<?php  echo base_url('master/police_officer/update/')?>"  enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_user_header" data-kt-scroll-wrappers="#kt_modal_edit_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                                <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Officer Name </span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="name" id="officer_name"  />
											<span id="input3" class="val" style="color:#F00; font-style:oblique;"></span>
                                            <input type="hidden" name="policeofficerid" id="policeofficer_id"  />
                                    </div>
									<input type="hidden" name="old_image" id="old_image">
                                    <div class="fv-row mb-10">
									<label class="d-flex align-items-center fs-5 fw-bold ">
                                             <span class="required">Officer Image </span>
                                    </label>
									<div class="col-lg-8">
										<div class="image-input image-input-outline"  data-kt-image-input="true" style="background-image: url('assets/media/avatars/blank.png')">
											<div class="image-input-wrapper w-125px h-125px bgi-position-center officer_file" style="background-size: 75%; background-image: url('assets/media/svg/brand-logos/volicity-9.svg')"></div>
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
											<i class="bi bi-pencil-fill fs-7" id="upload-img"></i>
												<input type="file" class="" name="image" accept=".png, .jpg, .jpeg" id="image">
												<span id="input4" class="val" style="color:#F00; font-style:oblique;"></span>
											</label>
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
											<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
												<i class="bi bi-x fs-2"></i>
											</span>
										</div>
										<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
									</div><br>
									<div class="fv-row mb-10">
									<label class="d-flex align-items-center fs-5 fw-bold ">
										<span class="required"> Email </span>
									</label>
									<input type="text" class="form-control form-control-lg form-control-solid validation" name="email" id="officer_email" />
									<span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
								    </div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Contact NO </span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="number" id="officer_number"  />
											<span id="input3" class="val" style="color:#F00; font-style:oblique;"></span>
									</div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Gender </span>
                                            </label>
										<div class="form-check form-check-custom form-check-solid me-10">
											<input class="form-check-input gender" type="radio" name="gender" value="female" id="gender_female">
											<label class="form-check-label " for="gender_female"> Female </label>
                                   		</div><br>
                                   		<div class="form-check form-check-custom form-check-solid me-10">
											<input class="form-check-input gender" type="radio" name="gender" value="male" id="gender_male">
										    <label class="form-check-label " for="gender_male">Male </label>
                                 		</div>
                                    </div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required"> Designation </span>
										</label>
										<select class="form-select form-select-solid " name="designation" id="designation" aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['designation_name'] as $row){
										       echo '<option value="'.$row->iDesignationId.'">'.$row->vDesignationName.'</option>';
											}
											?>
										</select>								
									</div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required">Department </span>
										</label>
										<select class="form-select form-select-solid "  name="department" id="department" aria-label="Select example">
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
										</label>
										<select class="form-select form-select-solid "  name="group" id="group" aria-label="Select example">
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
											<span class="required">Station Name</span>
										</label>
										<select class="form-select form-select-solid "  name="station" id="station" aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($groups['station_name'] as $row){
										       echo  '<option value="'.$row->iPoliceStationId.'">'.$row->vStationName.'</option>';
											}
											?>
										</select>									
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
										<span id="input5" class="val" style="color:#F00; font-style:oblique;"></span>
									</div>
                                </div><br>
                            </div>
                          </div>
                        	<button type="submit" id="submit_edit" class="btn btn-lg btn-primary" >Submit</button>
                        </div>
                    </div>
                </form>
           </div>
     </div>
</div> 
<!-- datatable -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="<?php echo $theme_path ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
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
                url:"<?php echo base_url() . '/master/police_officer/list_data'; ?>",  
                type:"POST"
            },
			"columnDefs":[
				{
				"targets":[0,10,11],
				"orderable":false
				}
			]
        });
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
				url: "<?php echo base_url() . '/master/police_officer/delete';?>",
				type: 'POST',
				data:{id:id},
				success: function(data) {
						Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					);      
					table.ajax.reload();
				}
			});
        }
    });
  });
	//	table.ajax.reload();
		//EDIT FORM DATA
	$(document)	.on('click','.addAttr',function(){
		var id = $(this).attr('data-id');
		var baseurl = "<?php print base_url(); ?>";
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url() . 'master/police_officer/get';?>",
			dataType : "JSON",
			data : {id:id},
			success: function(data){
				$("#officer_name").val(data.vOfficerName);
				$("#officer_email").val(data.iEmail);
				$('#officer_number').val(data.iMobileNumber);
				if(data.vGender == 'female')
				$("#gender_female").prop("checked", true);
				else 
				$("#gender_male").prop("checked", true);
				if(data.tStatus == '0')
				$("#status_active").prop("checked", true);
				else 
				$("#status_inactive").prop("checked", true);
				$('#designation').val(data.iDesignationId);
				$("#group").val(data.iGroupid);
				$("#department").val(data.iDepartmentId);
				$("#station").val(data.iPoliceStationId);    
				$('.officer_file').css('background-image', 'url(../uploads/'+data.tImage + ')');
                $("#policeofficer_id").val(data.iPoliceOfficerId);
				$('#old_image').val(data.tImage);

			}
		});	
		return false;
	});

</script>  

<!-- FLASH DATA FADEOUT -->
<script> 
    setTimeout(function() {
        $('#fadeout').hide('fast');
    }, 2000);
</script>

<!-- validation -->

<script>
$(document).ready(function () {
	$("#submit1").on('click',function () {
	var error = 0;
	$('#form').find('.validation').each(function(){
	var _val = $(this).val();
	if(_val == ''){
		error++;  
		$(this).closest('div').find('span.val').text("Required Field");
	}else{
		$(this).closest('div').find('span.val').text("");
	}    
	
	});
	if(error > 0){
	return false;
	}else{
	$("form").submit();
	}
	});
	var form_validation = false;
	$("#name").on('blur', function() {
	var name = $("#name").val();
	var filter = /^[a-zA-Z.\s]+[\S]{2,30}$/;
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
	$("#email").on('blur', function() {
	var mail = $("#email").val();
	var efilter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (mail == "") {
	form_validation = false;
	$("#input2").html("Required Field");
	} else if (!efilter.test(mail) && mail != "") {
	form_validation = false;
	$("#input2").html("Enter Valid Email");
	} else {
	form_validation = true;
	$("#input2").html("");
	}
	});
	$("#number").on('blur', function() {
	var number = $("#number").val();
	var nfilter = /^(\+91-|\+91|0)?\d{10}$/;
	if (number =="") {
	form_validation = false;
	$("#input3").html("Required Field");
	} else if (!nfilter.test(number) && number != "") {
	form_validation = false;
	$("#input3").html("Enter Valid number");
	} else {
	form_validation = true;
	$("#input3").html("");
	}
	});
	$("#image").on('blur', function() {
	var image = $("#image").val();
	if (image =="") {
	form_validation = false;
	$("#input9").html("Required Field");
	} 
	else {
	form_validation = true;
	$("#input9").html("");
	}
	});
});
$(document).ready(function () {
	$("#submit_edit").on('click',function () {
	var error = 0;
	$('#editform').find('.validation').each(function(){
	var _val = $(this).val();
	if(_val == ''){
		error++;  
		$(this).closest('div').find('span.val').text("Required Field");
	}else{
		$(this).closest('div').find('span.val').text("");
	}    
	
	});
	// alert(error);
	if(error > 0){
	return false;
	}else{
	$("form").submit();
	}
	});
	var form_validation = false;
	$("#officer_name").on('blur', function() {
	var name = $("#officer_name").val();
	var filter = /^[a-zA-Z.\s]+[\S]{2,30}$/;
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
	$("#officer_email").on('blur', function() {
	var mail = $("#officer_email").val();
	var efilter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (mail == "") {
	form_validation = false;
	$("#input2").html("Required Field");
	} else if (!efilter.test(mail) && mail != "") {
	form_validation = false;
	$("#input2").html("Enter Valid Email");
	} else {
	form_validation = true;
	$("#input2").html("");
	}
	});
	$("#officer_number").on('blur', function() {
	var number = $("#officer_number").val();
	var nfilter = /^(\+91-|\+91|0)?\d{10}$/;
	if (number =="") {
	form_validation = false;
	$("#input3").html("Required Field");
	} else if (!nfilter.test(number) && number != "") {
	form_validation = false;
	$("#input3").html("Enter Valid number");
	} else {
	form_validation = true;
	$("#input3").html("");
	}
	});
	$("#image").on('blur', function() {
	var image = $("#image").val();
	if (image =="") {
	form_validation = false;
	$("#input4").html("Required Field");
	} 
	else {
	form_validation = true;
	$("#input4").html("");
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

<script>
// $(document).ready(function () {
// 	var id = $(this).attr('data-id');
// 	var baseurl = "<?php print base_url(); ?>";
//         $(".img-thumbnail").on('click',function () {
// 		// alert(1);
//         });
// });
</script>
