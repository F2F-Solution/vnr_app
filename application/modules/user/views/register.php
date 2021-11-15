<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>
<div class="d-flex flex-column flex-root">
	<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
		<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
			<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
				<form class="form w-100" method="post" id="form" action="<?php echo base_url('user/login_user') ?>" novalidate="novalidate" id="kt_sign_up_form" enctype="multipart/form-data">
					<div class="mb-10 text-center">
						<h1 class="text-dark mb-3">Create an Account</h1>
						<div class="text-gray-400 fw-bold fs-4">Already have an account?
						<a href="<?php echo base_url();?>user/" class="link-primary fw-bolder">Sign in here</a></div>
					</div>
					<div class="row fv-row mb-7">
						<div class="col-xl-6">
							<label class="form-label fw-bolder text-dark fs-6">Name</label>
							<input class="form-control form-control-lg form-control-solid validation" type="text" id="name" placeholder="" name="username" autocomplete="off" />
							<span id="input1" class="val" style="color:#F00; font-style:oblique;"></span>
						</div>
						<div class="col-xl-6 ">
							<label class="form-label fw-bolder text-dark fs-6 ">Email</label>
							<input class="form-control form-control-lg form-control-solid validation" id="email" type="email" placeholder="" name="email" autocomplete="off" />
							<span id="input2" class="val" style="color:#F00; font-style:oblique;"></span>
						</div>
					</div>
					<div class="row fv-row mb-7 ">
						<div class="col-xl-6">
							<label class="form-label fw-bolder text-dark fs-6 ">Phone number</label>
							<input class="form-control form-control-lg form-control-solid validation" id="number" type="number" placeholder="" name="phone-number" autocomplete="off" />
							<span id="input3" class="val" style="color:#F00; font-style:oblique;"></span>
						</div>
						<div class="col-xl-6">
						<label class="form-label fw-bolder text-dark fs-6 ">Gender</label>
							<div class="form-check form-check-custom form-check-solid me-10">
								<input class="form-check-input validation" type="radio" name="gender" value="female" id="flexRadioLg"/>
								<label class="form-check-label" for="flexRadioLg"> Female </label>
							</div><br>
							<div class="form-check form-check-custom form-check-solid me-10">
								<input class="form-check-input " type="radio" name="gender" value="male" id="flexRadioLg"/>
								<label class="form-check-label" for="flexRadioLg">Male </label>
							</div>
							<span id="input4" class="val" style="color:#F00; font-style:oblique;"></span>
						</div>
					</div>
					<div class="mb-10 fv-row" data-kt-password-meter="true">
						<div class="mb-1">
							<label class="form-label fw-bolder text-dark fs-6 ">Password</label>
							<div class="position-relative mb-3 ">
								<input class="form-control form-control-lg form-control-solid validation" id="password" type="password" placeholder="" name="password" autocomplete="off" />
								<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
									<i class="bi bi-eye-slash fs-2"></i>
									<i class="bi bi-eye fs-2 d-none"></i>
								</span>
								<span id="input5" class="val" style="color:#F00; font-style:oblique;"></span>
							</div>
							<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
								<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
							</div>
						</div>
						<div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
					</div>
					<div class="form-control form-control-lg form-control-solid">
						<h6 class="m-b-10">Profile Image</h6>
						<label class="file">
						<input class="validation" type="file" id="image" name="image"> 
						<span id="input6" class="val" style="color:#F00; font-style:oblique;"></span>
					</div><br>
					<div class="text-center">
						<button type="submit" id="submit1" class="btn btn-lg btn-primary">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>var hostUrl = "<?php echo $theme_path ?>/assets/js/authentication";</script>									
<script src="<?php echo $theme_path ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo $theme_path ?>/assets/js/scripts.bundle.js"></script>
<script src="<?php echo $theme_path ?>/assets/js/custom/authentication/sign-up/general.js"></script>
<script>
 $(document).ready(function () {
	$("#submit1").on('click',function (event) {
		event.preventDefault();
			var error = 0;
			$('#form').find('.validation').each(function(){
					var _val = $(this).val();
					var type = $(this).attr('type');
				if(type == 'radio'){
					var gender = $('input[name="gender"]:checked').length;
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
			}); //alert(error);
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
					
					} else if (!filter.test(name)) {
						form_validation = false;
						$("#input1").html("Alphabets and Min 3 to Max 30 without space ");
						
					} else {
						$("#input1").html("");
						form_validation = true;
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
});
</script>
		

		