
    <?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>

<div class="post d-flex flex-column-fluid" id="kt_post">
<div id="kt_content_container" class="container-xxl">
<div class="card">
<div class="card-header border-0 pt-6">
<div class="card-title">
</div>
<div class="card-toolbar">
<!--begin::Toolbar-->
<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

<!--begin::Menu 1-->
<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
<!--begin::Header-->
<!--begin::Content-->
</div>
<!--begin::Add user-->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
<span class="svg-icon svg-icon-2">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
</svg>
</span>
<!--end::Svg Icon-->Add User</button>
<!--end::Add user-->
</div>
<!--end::Toolbar-->

<!--begin::Modal - Adjust Balance-->

<!--end::Modal - New Card-->
<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
<!--begin::Modal dialog-->
<div class="modal-dialog modal-dialog-centered mw-650px">
<!--begin::Modal content-->
<div class="modal-content">
    <!--begin::Modal header-->
    <div class="modal-header" id="kt_modal_add_user_header">
        <!--begin::Modal title-->
        <h2 class="fw-bolder">Add User</h2>
        <!--end::Modal title-->
        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Close-->
    </div>
    <!--end::Modal header-->
    <!--begin::Modal body-->
    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
        <!--begin::Form-->
        <form id="kt_modal_add_user_form" method="post" class="form" action="<?php echo base_url();?>master/group/save_data/">
            <!--begin::Scroll-->
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">Group</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="group_name" class="form-control form-control-solid mb-3 mb-lg-0"/>
                    <span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="mb-7">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-5">Status</label>
                    <!--end::Label-->
                    <!--begin::Roles-->
                    <!--begin::Input row-->
                    <div class="d-flex fv-row">
                        <!--begin::Radio-->
                        <div class="form-check form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input class="form-check-input me-3" name="status" type="radio" value="0" id="kt_modal_update_role_option_0" />
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label" for="kt_modal_update_role_option_0">
                                <div class="fw-bolder text-gray-800">Active</div>
                            </label>
                            <!--end::Label-->
                        </div>
                        <!--end::Radio-->
                    </div>
                    <!--end::Input row-->
                    <div class='separator separator-dashed my-5'></div>
                    <!--begin::Input row-->
                    <div class="d-flex fv-row">
                        <!--begin::Radio-->
                        <div class="form-check form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input class="form-check-input me-3" name="status" type="radio" value="1" id="kt_modal_update_role_option_1" />
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label" for="kt_modal_update_role_option_1">
                                <div class="fw-bolder text-gray-800">Inactive</div>
                            </label>
                            <!--end::Label-->
                        </div>
                        <!--end::Radio-->
                        <span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
                    </div>
            </div>
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                <button type="submit"  id="submit1" class="btn btn-primary">
                    <span class="indicator-label" id="submit1">Submit</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Modal body-->
    </div>
</div>
<!--end::Modal content-->
</div>
<!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->
</div>
<!--end::Card toolbar-->
</div>

<!--end::Card header-->
<!--begin::Card body-->
<div class="card-body pt-0">
<!--begin::Table-->
<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
<!--begin::Table head-->
<thead>
<!--begin::Table row-->
<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
<th>S.No</th>
<th class="min-w-125px">Group</th>
<th class="min-w-125px">Status</th>
<th class="min-w-125px">Actions</th>
</tr>
<!--end::Table row-->
</thead>
<!--end::Table head-->
<!--begin::Table body-->
<tbody class="text-gray-600 fw-bold">
<!--begin::Table row-->
<?php  
$sno = 1;
foreach ($group->result() as $row)  
{  
?><tr>  
<td><?php echo $sno; ?></td>  
<td><?php echo $row->vGroupName;?></td>  
<td><?php 
if ($row->tStatus == 0) {
echo ("<div class=\"badge badge-light-success fw-bolder\">Active</div>");
}else{
echo ("<div class=\"badge badge-light-danger fw-bolder\">Inactive</div>");
}
$sno++;
?></td>  
<td>
<a class="btn btn-info btn-sm"  data-bs-toggle="modal" data-bs-target="#kt_modal_edit_user" href="<?php echo base_url('master/group/edit/'.$row->iGroupid)?>"><i class="fa fa-edit"></i></a>
<a  class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url('master/group/delete/'.$row->iGroupid) ?>"> <i class="fa fa-trash"></i></a>
<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
<!--begin::Modal dialog-->
<div class="modal-dialog modal-dialog-centered mw-650px">
    <!--begin::Modal content-->
    <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header" id="kt_modal_add_user_header">
            <!--begin::Modal title-->
            <h2 class="fw-bolder">Edit User</h2>
            <!--end::Modal title-->
            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Close-->
        </div>
        <!--end::Modal header-->

        <!--begin::Modal body-->
        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
            <!--begin::Form-->
            <form id="kt_modal_edit_user_form" method="post" class="form" action="<?php echo base_url('master/group/update/'.$row->iGroupid)?>">
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-bold fs-6 mb-2">Group</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="group_name" class="form-control form-control-solid mb-3 mb-lg-0 required"  value="<?php echo $row->vGroupName ?>"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-7">
                        <!--begin::Label-->
                        <label class="required fw-bold fs-6 mb-5">Status</label>
                        <!--end::Label-->
                        <!--begin::Roles-->
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" name="status" type="radio" value="0" id="kt_modal_update_role_option_0" 
                                <?php
                                    if($row->tStatus=='0')
                                {
                                echo "checked";
                                }
                                ?>>Active
                                <!--end::Input-->
                                <!--begin::Label-->
                                <!-- <label class="form-check-label" for="kt_modal_update_role_option_0">
                                    <div class="fw-bolder text-gray-800">Active</div>
                                </label> -->
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        <div class='separator separator-dashed my-5'></div>
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" name="status" type="radio" value="1" id="kt_modal_update_role_option_1"
                                <?php
                                    if($row->tStatus =='1')
                                {
                                echo "checked";
                                }
                                ?>>Inactive
                                <!--end::Input-->
                                <!--begin::Label-->
                                <!-- <label class="form-check-label" for="kt_modal_update_role_option_1">
                                    <div class="fw-bolder text-gray-800">Inactive</div>
                                </label> -->
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                    <button type="submit" id="submit1" class="btn btn-primary">
                        <span class="indicator-label" id="submit1">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Modal body-->
    </div>
</div>
<!--end::Modal content-->
</div>

</td>
</tr>  

<?php }  
?>  
</tbody>
<!--end::Table body-->
</table>
<!--end::Table-->
</div>
<!--end::Card body-->
</div>
<!--end::Card-->
</div>
<!--end::Container-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
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
</script>
