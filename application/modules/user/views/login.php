<?php $theme_path = $this->config->item('theme_locations') . 'vnrpolice';?>
<!--begin::Wrapper-->
<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
  <!--begin::Form-->
  <form class="form w-100" method="post" novalidate="novalidate" id="kt_sign_in_form" action="<?php echo base_url('user/verify_user') ?>">
    <!--begin::Heading-->
    <div class="text-center mb-10">
      <!--begin::Title-->
      <h1 class="text-dark mb-3">Sign In to VNR Police  </h1>
      <!--end::Title-->
      <!--begin::Link-->
      <div class="text-gray-400 fw-bold fs-4">New Here?
      <a href="<?php echo base_url();?>user/register_view/" class="link-primary fw-bolder">Create an Account</a></div>
      <!--end::Link-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
      <!--begin::Label-->
      <label class="form-label fs-6 fw-bolder text-dark">Email</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
      <!--end::Input-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
      <!--begin::Wrapper-->
      <div class="d-flex flex-stack mb-2">
        <!--begin::Label-->
        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
        <!--end::Label-->
        
      </div>
      <!--end::Wrapper-->
      <!--begin::Input-->
      <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
      <!--end::Input-->
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center">
      <!--begin::Submit button-->
      <!-- kt_sign_in_submit -->
      <button type="submit" id="" class="btn btn-lg btn-primary w-100 mb-5">
        <span class="indicator-label">Continue</span>
      </button>
      <!--end::Submit button-->
      <div class="powered_by_text">
                <a href="<?php echo base_url('user/forget_password') ?>" class="forget_password" style="margin-right:  119px;">Forget Password?</a>
                <a href="<?php echo base_url('user/register_view') ?>" class="register">Register </a>
            </div>
      <!--begin::Separator-->
    <!--end::Actions-->
  </form>
  <!--end::Form-->
</div>
<!--end::Wrapper-->