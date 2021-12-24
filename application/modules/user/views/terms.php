<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>

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
                <li class="breadcrumb-item text-dark">Terms and condition</li>
            </ul>
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
                            <th>Terms and Condition</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                        $sno = 1;
                        foreach ($terms as $row)  
                        {   
                            ?><tr>  
                             <td><?php echo $sno; ?></td>  
                            <td><?php echo $row->vTermsandConditions;?></td>  
                            <td>
                            <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 addAttr" title="Edit" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_user" data-id="<?php echo $row->iTermsandConditionsId?>"><span class="svg-icon svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path><path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path></svg></span></a>
                            <div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <div class="modal-header" id="kt_modal_add_user_header">
                                            <h2 class="fw-bolder">Edit Details of Terms and condition</h2>
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="close_edit_modal" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                    </svg>
                                                </span>
                                             </div>
                                            </div>
                                                <div class="modal-body scroll-y">
                                                    <form id="editform" method="post" class="form"  action="<?php  echo base_url('user/update/'.$row->iTermsandConditionsId)?>" >
                                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_user_header" data-kt-scroll-wrappers="#kt_modal_edit_user_scroll" data-kt-scroll-offset="300px">
                                                            <div class="flex-row-fluid">
                                                                <div class="current" data-kt-stepper-element="content">
                                                                            <div class="w-100">
                                                                                <div class="fv-row mb-10">
                                                                                        <label class="d-flex align-items-center fs-5 fw-bold ">
                                                                                        <span class="required">Terms and condition </span>
                                                                                    </label>
                                                                                    <textarea class="form-control form-control-lg form-control-solid validation"  rows="5" cols="50" name="term_name" id="term_name" ></textarea>
                                                                                    <span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
                                                                                    <input type="hidden" name="term_id" id="term_id"  />
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <button type="submit" id="submit1" class="btn btn-lg btn-primary" >Update</button>
                                                </div>
                                            </div>
                                                 </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
            
                         </td>
                         </tr>  
                     <?php }  
                     ?>  
                    </tbody>  
                </table>
            </div>
         </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document)	.on('click','.addAttr',function(){
		var id = $(this).attr('data-id');
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url() . 'user/get';?>",
			data : {id:id},
			success: function(data){
                data = JSON.parse(data)
				$("#term_name").val(data.vTermsandConditions);
                $("#term_id").val(data.iTermsandConditionsId);
			}
		});	
		return false;
	});
    $(document).ready(function () {
        $("#close_edit_modal").on('click',function () {
            $('#kt_modal_edit_user').modal('hide');
        });
});
</script>
