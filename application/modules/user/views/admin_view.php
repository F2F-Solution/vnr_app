<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';
$this->load->library('session');
$this->db->select('*')->from('vnr_user');
$this->db->where('iUserId',$this->session->userdata('UserId'));
$query = $this->db->get()->row_array();
// print_r($query);exit;
?>

<link href="<?php echo $theme_path ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Admin
            <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="<?php echo base_url();?>user/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark">profile</li>
            </ul>
        </div>
        <div class="d-flex align-items-center py-1">
            <button type="button" class="btn btn-sm btn-primary edit_admin" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_user">Edit </button>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata('UserId'); ?>">
        </div>
    </div>
</div>
<div class="card mb-5 mb-xl-10">
   <div class="card-body pt-9 pb-0">
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
          <div class="me-7 mb-4">
              <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                <img src="<?php echo base_url();?>uploads/<?php echo $query['vImage']; ?>" alt="image">
                <!-- <img src="<?php //echo $theme_path ?>/assets/media/avatars/150-26.jpg" alt="image"> -->
                   <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                   </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"><?php echo $query['vUserName'];?></a>
                                        <span class="svg-icon svg-icon-1 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"></path>
                                                <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
                                            </svg>
                                        </span></a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5 mb-xl-10" >
        <div class="card-header cursor-pointer">
           <div class="card-title m-0">
             <h3 class="fw-bolder m-0">Profile Details</h3>
           </div>
        </div>
        <div class="card-body p-9">
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">User Name</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800"><?php echo $query['vUserName']; ?></span>
                    </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">Email</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800"><?php echo $query['vEmail']; ?></span>
                    </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">Phone Number</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800"><?php echo $query['iPhoneNumber']; ?></span>
                    </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">Gender</label>
                    <div class="col-lg-8">
                        <span class="fw-bolder fs-6 text-gray-800"><?php echo $query['vGender']; ?></span>
                    </div>
            </div>
       </div>
   </div>
<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Edit Details of Admin</h2>
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
                <form id="editform" method="post" class="form"  action="<?php  echo base_url('User/admin/update/')?>"  enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_user_header" data-kt-scroll-wrappers="#kt_modal_edit_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                            <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <div class="fv-row mb-10">
                                                <label class="d-flex align-items-center fs-5 fw-bold ">
                                                    <span class="required">Name</span>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                                </label>
                                                <input class="form-control form-control-lg form-control-solid required" type="text" id="name" placeholder="" name="username" autocomplete="off" />
                                                <span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
                                                <input type="hidden" name="adminid" id="admin_id"  />
                                        </div>
                                        <div class="fv-row mb-10">
                                                <label class="d-flex align-items-center fs-5 fw-bold ">
                                                    <span class="required">Email</span>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                                </label>
                                                <input class="form-control form-control-lg form-control-solid" id="email" type="email" placeholder="" name="email" autocomplete="off" />
                                                <span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
                                        </div>
                                        <div class="fv-row mb-10">
                                                <label class="d-flex align-items-center fs-5 fw-bold ">
                                                    <span class="required">Phone Number </span>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                                </label>
                                                <input class="form-control form-control-lg form-control-solid" id="number" type="number" placeholder="" name="phone-number" autocomplete="off" />
                                                <span id="input3" class="val" style="color:#F00; font-style:oblique;"></span>
                                        </div>
                                        <div class="fv-row mb-10">
                                                <label class="d-flex align-items-center fs-5 fw-bold ">
                                                    <span class="required">Gender </span>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                                </label>
                                            <div class="form-check form-check-custom form-check-solid me-10">
                                                <input class="form-check-input" type="radio" name="gender" value="female" id="gender_female"/>
                                                <label class="form-check-label" for="flexRadioLg"> Female </label>
                                            </div><br>
                                            <div class="form-check form-check-custom form-check-solid me-10">
                                                <input class="form-check-input" type="radio" name="gender" value="male" id="gender_male"/>
                                                <label class="form-check-label" for="flexRadioLg">Male </label>
                                        </div>
                                        <span id="input4" class="val" style="color:#F00; font-style:oblique;"></span>
                                        </div>
                                        <input type="text" name="old_image" id="old_image">
                                    <div class="fv-row mb-10">
									<div class="col-lg-8">
										<div class="image-input image-input-outline"  data-kt-image-input="true" style="background-image: url('..assets/media/avatars/blank.png')">
											<div class="image-input-wrapper w-125px h-125px bgi-position-center profile" style="background-size: 75%; background-image: url('')"></div>
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
												<i class="bi bi-pencil-fill fs-7"></i>
												<input type="file"  name="image" accept=".png, .jpg, .jpeg" id="image">
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
									</div>
                                </div><br>
                            </div>
                           
                        </div>
                     </div>
                     <button type="submit" class="btn btn-lg btn-primary" >Submit</button>
                   </div>
        </div>
    </div>
              </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document)	.on('click','.edit_admin',function(){
		// var id = $(this).attr('data-id');
        var id = $('#user_id').val();
		var baseurl = "<?php print base_url(); ?>";
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url() . 'user/admin/get';?>",
			dataType : "JSON",
			data : {id:id},
			success: function(data){
                console.log(data);
				$("#name").val(data[0].vUserName);
				$("#email").val(data[0].vEmail);
				$("#number").val(data[0].iPhoneNumber);
				if(data[0].vGender == 'female')
				$("#gender_female").prop("checked", true);
				else 
				$("#gender_male").prop("checked", true);
                $("#admin_id").val(data[0].iUserId);
                $('.profile').css('background-image', 'url(../uploads/'+data[0].vImage + ')');
                $('#old_image').val(data[0].vImage);

			}
		});	
		return false;
	});
</script>