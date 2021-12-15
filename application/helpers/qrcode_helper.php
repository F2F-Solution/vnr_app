<?php
//QR Code Creation
function Generate_QRCode($qr_code,$name){

    $ci = & get_instance();
    // $client_id= $ci->session->userdata('iCompanyId');
    $ci->load->library('Ci_qrcode');
    $upload_path = FCPATH . 'uploads/qr_codes/';
    if(!file_exists($upload_path)) 
        mkdir($upload_path, 0755, true);
    $data['qr_code_name'] = $qr_code_name = $qr_code;
    $encrypt_qrcode_name = $name;
    //QRCode Scan Data
    $data['qr_code_scan_data']=$qr_code;
    $qr_image = $encrypt_qrcode_name.'.png';
    $params['data'] = base64_encode($qr_code);//$qr_code_name;
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] = FCPATH . "uploads/qr_codes/".$qr_image;
    if ($ci->ci_qrcode->generate($params)) {
        return $qr_image;
    }
}

?>