<!DOCTYPE html>
<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>
<link href="<?php echo $theme_path ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
<div class="toolbar" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Police Station
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
            <button type="button" class="btn btn-sm btn-primary add_station" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">Add Police Station</button>
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
                            <th>Station Name</th>
							<th>Contact NO</th>     
                            <th>Emergency Contact no</th>
							<th>Landline NO</th>
							<th>Primary Attender</th>
                            <th>Address</th>
							<!-- <th>Map</th> -->
							<th>Pincode</th>
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
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <div class="modal-content">
            <div class="modal-header py-7 d-flex justify-content-between" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Add Details of Police Station</h2>
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
                <form id="form" method="post" class="form" action="<?php echo base_url();?>policestation/police_station/save_data/" enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                                <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Station Name </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="name" id="station_name" />
											<span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
										</div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Contact NO </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="number" id="number" />
											<span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
                                    <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Emergency contact </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="emergency_number" id="emergency_number" />
											<span id="input3" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
                                    <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Landline number </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="land_number" id="land_number" />
											<span id="input4" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required"> Primary attender </span>
											<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
										</label>
										<select class="form-select form-select-solid " name="attender" aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($policestation['attender'] as $row){
										       echo  '<option value="'.$row->iPoliceOfficerId.'">'.$row->vOfficerName.'</option>';
											}
											?>
										</select>	
										<!-- <span id="input4" class="val" style="color:#F00; font-style:oblique;"></span> -->
									</div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold ">
                                            <span class="required"> Address </span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                        </label>
                                        <input type="text" class="form-control form-control-lg form-control-solid validation" name="address"  id="address"/>
                                        <span id="input5" class="val" style="color:#F00; font-style:oblique;"></span>
								   </div>
                                   <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold ">
                                            <span class="required"> Map </span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                        </label>
                                        <div id="map" style="width: 300px; height: 300px;"></div>
                                        <div id="current"></div>
                                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwpXSYswuXaJyfDoBxXTxYeAYRwzZIjGE"async></script>

                                        <span id="input6" class="val" style="color:#F00; font-style:oblique;"></span>
								   </div>
                                   <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold ">
                                            <span class="required"> Pincode  </span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                        </label>
                                        <input type="text" class="form-control form-control-lg form-control-solid validation" name="pincode"  id="pincode"/>
                                        <input type="hidden" class="form-control form-control-lg form-control-solid" name="latitude"  id="latitude"/>
                                        <input type="hidden" class="form-control form-control-lg form-control-solid" name="longitude"  id="longitude"/>
                                        <span id="input7" class="val" style="color:#F00; font-style:oblique;"></span>
								   </div>
                                </div>
							   </div><br>
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

<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bolder">Edit Details of Police Station</h2>
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
                <form id="editform" method="post" class="form"  action="<?php  echo base_url('policestation/police_station/update/'.$post->iPoliceStationId)?>"  enctype="multipart/form-data">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_user_header" data-kt-scroll-wrappers="#kt_modal_edit_user_scroll" data-kt-scroll-offset="300px">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                        <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Station Name </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="name" id="station_name1" />
											<span id="input8" class="val" style="color:#F00; font-style:oblique;"></span>
                                            <input type="hidden" name="policestationid" id="policestation_id"  />
                                        </div>
									<div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Contact NO </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="number" id="number1" />
											<span id="input9" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
                                    <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Emergency contact </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="emergency_number" id="emergency_number1" />
											<span id="input10" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
                                    <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-bold ">
                                                <span class="required">Landline number </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid validation" name="land_number" id="land_number1" />
											<span id="input11" class="val" style="color:#F00; font-style:oblique;"></span>
                                    </div>
									<div class="fv-row mb-10">
										<label class="d-flex align-items-center fs-5 fw-bold ">
											<span class="required"> Primary attender </span>
											<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
										</label>
										<select class="form-select form-select-solid " name="attender" id="attender1" aria-label="Select example">
											<option>SELECT</option>
											<?php
											foreach($policestation['attender'] as $row){
										       echo  '<option value="'.$row->iPoliceOfficerId.'">'.$row->vOfficerName.'</option>';
											}
											?>
										</select>	
										<!-- <span id="input4" class="val" style="color:#F00; font-style:oblique;"></span> -->
									</div>
                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold ">
                                            <span class="required"> Address </span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                        </label>
                                        <input type="text" class="form-control form-control-lg form-control-solid validation" name="address"  id="address1"/>
                                        <span id="input12" class="val" style="color:#F00; font-style:oblique;"></span>
								   </div>
                                   <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold ">
                                            <span class="required"> Map </span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                        </label>
                                        <div id="map1" style="width: 300px; height: 300px;"></div>
                                        <div id="current1"></div>
                                        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwpXSYswuXaJyfDoBxXTxYeAYRwzZIjGE"async></script> -->

                                        <span id="input15" class="val" style="color:#F00; font-style:oblique;"></span>
								   </div>

                                   <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center fs-5 fw-bold ">
                                            <span class="required"> Pincode  </span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify department"></i>
                                        </label>
                                        <input type="text" class="form-control form-control-lg form-control-solid validation" name="pincode"  id="pincode1"/>
                                        <input type="hidden" class="form-control form-control-lg form-control-solid" name="latitude"  id="latitude1"/>
                                        <input type="hidden" class="form-control form-control-lg form-control-solid" name="longitude"  id="longitude1"/>
                                        <span id="input14" class="val" style="color:#F00; font-style:oblique;"></span>
								   </div>
                                </div>
							   </div><br>
                            </div>
                          </div>
                        	<button type="submit" id="submit2" class="btn btn-lg btn-primary" >Submit</button>
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
                url:"<?php echo base_url() . 'policestation/Police_station/list_data'; ?>",  
                type:"POST"
            }
        });
	//EDIT FORM DATA
	$(document)	.on('click','.addAttr',function(){
		var id = $(this).attr('data-id');
		var baseurl = "<?php print base_url(); ?>";
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url() . 'policestation/Police_station/get';?>",
			dataType : "JSON",
			data : {id:id},
			success: function(data){
				$("#station_name1").val(data.vStationName);
				$("#number1").val(data.iPoliceStationNumber);
				$('#emergency_number1').val(data.iEmergencyNO);
				$("#land_number1").val(data.iStationLandNo);
				$("#attender1").val(data.vPrimaryAttender);
				$("#address1").val(data.vAddress);
			    $('#latitude1').val(data.vStationLatitude);    
			    $('#longitude1').val(data.vStationlongitude);    
                $("#pincode1").val(data.iPincode);
                $("#policestation_id").val(data.iPoliceStationId);
			}
		});	
		return false;
	});

</script>  
<script>
$(document).ready(function() {
    $(document).on("click", ".add_station", function(e) {
        e.preventDefault();
        
    });
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: new google.maps.LatLng(11.016844, 76.955833),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(11.033940, 76.936410),
            draggable: true
        });

        google.maps.event.addListener(myMarker, 'dragend', function (evt) {
        // console.log('Lat'+evt.latLng.lat().toFixed(3));
        // console.log('Long'+evt.latLng.lng().toFixed(3));
            document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
            $('#latitude').val(evt.latLng.lat().toFixed(3));
            $('#longitude').val(evt.latLng.lng().toFixed(3));
        });

        google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
            document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
        });

        map.setCenter(myMarker.position);
        myMarker.setMap(map);
});	

$(document).ready(function() {
    $(document).on("click", ".addAttr", function(e) {
        e.preventDefault();
        
    });
        var map = new google.maps.Map(document.getElementById('map1'), {
            zoom: 6,
            center: new google.maps.LatLng(11.016844, 76.955833),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(11.033940, 76.936410),
            draggable: true
        });

        google.maps.event.addListener(myMarker, 'dragend', function (evt) {
        // console.log('Lat'+evt.latLng.lat().toFixed(3));
        // console.log('Long'+evt.latLng.lng().toFixed(3));
            document.getElementById('current1').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
            $('#latitude1').val(evt.latLng.lat().toFixed(3));
            $('#longitude1').val(evt.latLng.lng().toFixed(3));
        });

        google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
            document.getElementById('current1').innerHTML = '<p>Currently dragging marker...</p>';
        });

        map.setCenter(myMarker.position);
        myMarker.setMap(map);
});	
</script>

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
	$("#station_name").on('blur', function() {
	var name = $("#station_name").val();
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

	$("#number").on('blur', function() {
	var number = $("#number").val();
	var nfilter = /^(\+91-|\+91|0)?\d{10}$/;
	if (number =="") {
	form_validation = false;
	$("#input2").html("Required Field");
	} else if (!nfilter.test(number) && number != "") {
	form_validation = false;
	$("#input2").html("Enter Valid number");
	} else {
	form_validation = true;
	$("#input2").html("");
	}
	});
    $("#emergency_number").on('blur', function() {
	var number = $("#emergency_number").val();
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
    $("#land_number").on('blur', function() {
	var number = $("#land_number").val();
	var nfilter = /^(\+91-|\+91|0)?\d{10}$/;
	if (number =="") {
	form_validation = false;
	$("#input4").html("Required Field");
	} else if (!nfilter.test(number) && number != "") {
	form_validation = false;
	$("#input4").html("Enter Valid number");
	} else {
	form_validation = true;
	$("#input4").html("");
	}
	});
    $("#address").on('blur', function() {
	var name = $("#address").val();
	var filter = /^[a-zA-Z.\s]+[\S]{2,30}$/;
	if (name == "" || name == null || name.trim().length == 0) {
		form_validation = false;
		$("#input5").html("Required Field");
		// return false;
	} else if (!filter.test(name)) {
		form_validation = false;
		$("#input5").html("Alphabets and Min 3 to Max 30 without space ");
		// return false;
	} else {
		$("#input5").html("");
		form_validation = true;
		// return true;
	}
	});
	
});

$(document).ready(function () {
	$("#submit2").on('click',function (event) {
        // event.preventDefault();
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
	if(error > 0){
	return false;
	}else{
	$("editform").submit();
	}
	});
	var form_validation = false;
	$("#station_name1").on('blur', function() {
	var name = $("#station_name1").val();
	var filter = /^[a-zA-Z.\s]+[\S]{2,30}$/;
	if (name == "" || name == null || name.trim().length == 0) {
		form_validation = false;
		$("#input8").html("Required Field");
		// return false;
	} else if (!filter.test(name)) {
		form_validation = false;
		$("#input8").html("Alphabets and Min 3 to Max 30 without space ");
		// return false;
	} else {
		$("#input8").html("");
		form_validation = true;
		// return true;
	}
	});

	$("#number1").on('blur', function() {
	var number = $("#number1").val();
	var nfilter = /^(\+91-|\+91|0)?\d{10}$/;
	if (number =="") {
	form_validation = false;
	$("#input9").html("Required Field");
	} else if (!nfilter.test(number) && number != "") {
	form_validation = false;
	$("#input9").html("Enter Valid number");
	} else {
	form_validation = true;
	$("#input9").html("");
	}
	});
    $("#emergency_number1").on('blur', function() {
	var number = $("#emergency_number1").val();
	var nfilter = /^(\+91-|\+91|0)?\d{10}$/;
	if (number =="") {
	form_validation = false;
	$("#input3").html("Required Field");
	} else if (!nfilter.test(number) && number != "") {
	form_validation = false;
	$("#input10").html("Enter Valid number");
	} else {
	form_validation = true;
	$("#input10").html("");
	}
	});
    $("#land_number1").on('blur', function() {
	var number = $("#land_number1").val();
	var nfilter = /^(\+91-|\+91|0)?\d{10}$/;
	if (number =="") {
	form_validation = false;
	$("#input11").html("Required Field");
	} else if (!nfilter.test(number) && number != "") {
	form_validation = false;
	$("#input11").html("Enter Valid number");
	} else {
	form_validation = true;
	$("#input11").html("");
	}
	});
    $("#address1").on('blur', function() {
	var name = $("#address1").val();
	 var filter = /^[\S]$/;
	if (name == "" || name == null || name.trim().length == 0) {
		form_validation = false;
		$("#input12").html("Required Field");
		// return false;
	} else if (!filter.test(name)) {
		form_validation = false;
		$("#input12").html("Not valid ");
		// return false;
	} else {
		$("#input12").html("");
		form_validation = true;
		// return true;
	}
	});
	
});
</script>
