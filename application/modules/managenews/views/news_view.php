<!DOCTYPE html>
<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>
<link href="<?php echo $theme_path ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">News
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
            <button type="button" class="btn btn-sm btn-primary add_station" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">Add News</button>
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
                            <th>Subject</th>
							<th>Message</th>     
                            <th>Image</th>
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
<!-- ADD MODAL -->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <div class="modal-content">
            <div class="modal-header py-7 d-flex justify-content-between" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Add Details of News</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y m-5">
                <form id="form" method="post" class="form" action="<?php echo base_url();?>managenews/news/save_data/" enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                                <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">News subject </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="subject" id="subject" />
											<span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
										</div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Message</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <textarea class="form-control form-control-lg form-control-solid" name="message" id="message" ></textarea>
											<span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
                                    <div class="fv-row mb-10">
									<div class="col-lg-8">
										<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/avatars/blank.png')">
											<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('assets/media/svg/brand-logos/volicity-9.svg')"></div>
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
												<i class="bi bi-pencil-fill fs-7" id="upload-img"></i>
												<input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" />
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
                                <div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required"> Status </span>
											<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
										</label>
										<select class="form-select form-select-solid " name="status" aria-label="Select example">
											<option>SELECT</option>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
										</select>	
										<!-- <span id="input4" class="val" style="color:#F00; font-style:oblique;"></span> -->
									</div>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary" id="submit1" >Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
</div>
<!-- Edit -->
<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Edit Details of News</h2>
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
                <form id="editform" method="post" class="form"  action="<?php  echo base_url('managenews/news/update')?>"  enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_user_header" data-kt-scroll-wrappers="#kt_modal_edit_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                        <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
                                    <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">News subject </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="subject" id="subject1" />
                                            <input type="hidden" class="form-control form-control-lg form-control-solid" name="news_id" id="news_id" />
											<span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
										</div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Message</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <textarea class="form-control form-control-lg form-control-solid" name="message" id="message1" ></textarea>
											<span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
                                    <div class="fv-row mb-10">
									<div class="col-lg-8">
										<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/avatars/blank.png')">
											<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('assets/media/svg/brand-logos/volicity-9.svg')"></div>
											<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
												<i class="bi bi-pencil-fill fs-7" id="upload-img"></i>
												<input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" />
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
                                <div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required"> Status </span>
											<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
										</label>
										<select class="form-select form-select-solid " name="status" id="status1" aria-label="Select example">
											<option value="">SELECT</option>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
										</select>	
										<!-- <span id="input4" class="val" style="color:#F00; font-style:oblique;"></span> -->
									</div>
                                 </div>
							   </div><br>
                             </div>
                        	<button type="submit" class="btn btn-lg btn-primary" >Submit</button>
                        </div>
                    </div>
                </form>
           </div>
     </div>
</div> 

<!-- datatable -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="<?php echo $theme_path ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script>
    var table;
    table = $("#user_data").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[1, 'asc']],
            ajax: {
                url:"<?php echo base_url() . 'managenews/news/list_data'; ?>",  
                type:"POST"
            }
        });
        //EDIT FORM DATA
	$(document)	.on('click','.addAttr',function(){
		var id = $(this).attr('data-id');
		var baseurl = "<?php print base_url(); ?>";
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url() . 'managenews/news/get';?>",
			dataType : "JSON",
			data : {id:id},
			success: function(data){
                console.log(data);
                $("#news_id").val(data.inewsid);
				$("#message1").val(data.vNewsMessage);
				$("#subject1").val(data.vNewsSubject);
				$("#status1").val(data.tNewsStatus);
				// $('#image1').val(data.vNewsImage);

			}
		});	
		return false;
	});
</script>
