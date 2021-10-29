<?php
$theme_path = $this->config->item('theme_locations') . 'vnrpolice';
?>
<!DOCTYPE html>
	<html lang="en">
   		 <head>
			<meta charset="utf-8">

			<meta http-equiv="X-UA-Compatible" content="IE=edge">

			<meta name="viewport" content="width=device-width, initial-scale=1">

			<title>Login</title>

			<link rel="shortcut icon" href="<?php echo $theme_path ?>/assets/media/logos/favicon.ico" />

			<!--begin::Fonts-->
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
			<!--end::Fonts-->
			<!--begin::Global Stylesheets Bundle(used by all pages)-->
			<link href="<?php echo $theme_path ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
			<link href="<?php echo $theme_path ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />      
       </head>
    <body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<!--begin::Content-->
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<!--begin::Logo-->
							<a href="#" class="py-9 mb-5">
								<img alt="Logo" src="<?php echo $theme_path; ?>/assets/media/logos/logo-2.svg" class="h-60px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to VNR Police</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<p class="fw-bold fs-2" style="color: #986923;">We Rise by lifting
							<br />Others</p>
							<!--end::Description-->
						</div>
						<!--end::Content-->
						<!--begin::Illustration-->
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(../assets/media/illustrations/sketchy-1/13.png"></div>
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
							<?php echo $content;?>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Main-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?php echo $theme_path; ?>/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo $theme_path; ?>/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="<?php echo $theme_path; ?>/assets/js/custom/authentication/sign-in/general.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
</html>

