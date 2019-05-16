<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Html_lib {

    function get_css() {
        $arrayCss = '<link href="' . base_url('assets/css/style.default.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/css/jquery.tagsinput.css') . '" rel="sylesheet">
        <link href="' . base_url('assets/css/toggles.css') . '" rel="sylesheet">
        <link href="' . base_url('assets/css/bootstrap-timepicker.min.css') . '" rel="sylesheet">
        <link href="' . base_url('assets/css/morris.css') . '" rel="sylesheet">
        <link href="' . base_url('assets/css/select2.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/css/colorpicker.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/css/dropzone.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/css/sweetalert.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/css/style.datatables.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/css/dataTables.responsive.css') . '" rel="stylesheet">
        <link href="' . base_url('assets/css/style.calendar.css') . '" rel="stylesheet">
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#428BCA">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#428BCA">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">';
        return $arrayCss;
    }

    function get_javascript() {
        $arrayJavaScript = '
            <script> base_url = "' . base_url() . '";</script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery-1.11.1.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery-migrate-1.2.1.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/bootstrap.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/modernizr.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/pace.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/retina.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.cookies.js') . '"></script>
            ';
        if (strpos($_SERVER['REQUEST_URI'], 'dashboard') || strpos($_SERVER['REQUEST_URI'], 'estoque_de_produtos')) {
            $arrayJavaScript .= '<script type="text/javascript" src="' . base_url('assets/js/flot/jquery.flot.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/flot/jquery.flot.resize.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/flot/jquery.flot.spline.min.js') . '"></script>';
        }
        $arrayJavaScript .= '
            <script type="text/javascript" src="' . base_url('assets/js/jquery.autogrow-textarea.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.mousewheel.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.tagsinput.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/toggles.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/bootstrap-timepicker.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.maskedinput.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/colorpicker.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/dropzone.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.sparkline.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/morris.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/raphael-2.1.0.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/bootstrap-wizard.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery-ui-1.10.3.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.dataTables.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/dataTables.bootstrap.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/dataTables.responsive.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.validate.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/select2.min.js') . '"></script>
                
            <script type="text/javascript" src="' . base_url('assets/js/moment.js') . '"></script> <!-- // documentação do formato https://momentjs.com/ -->
            <script type="text/javascript" src="' . base_url('assets/js/fullcalendar.min.js') . '"></script>    
            <script type="text/javascript" src="' . base_url('assets/js/jquery.ui.touch-punch.min.js') . '"></script>
                
            <script type="text/javascript" src="' . base_url('assets/js/custom.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/sweetalert.min.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/sweetalert-dev.js') . '"></script>
            <script type="text/javascript" src="' . base_url('assets/js/jquery.maskMoney.js') . '" ></script> <!-- Doc http://plentz.github.io/jquery-maskmoney/ -->
        ';
        $arrayJavaScript .= '<script type="text/javascript" src="' . base_url('assets/js/raiz.js') . '"></script> ';
        $arrayJavaScript .= $this->get_swal();
        return $arrayJavaScript;
    }

    function get_swal() {
        $verificaSwal = 0;
        $swal = '';
        if (isset($_GET['created'])) {
            $swal .= ' swal("Sucesso", "Novo usuário cadastrado com Sucesso", "success"); ';
            $verificaSwal++;
        }
        
        if (isset($_GET['product_created'])) {
            $swal .= ' swal("Sucesso", "Produto criado com sucesso", "success"); ';
            $verificaSwal++;
        }
        
        if (isset($_GET['product_updated'])) {
            $swal .= ' swal("Sucesso", "Produto atualizado com sucesso", "success"); ';
            $verificaSwal++;
        }
       
        if (isset($_GET['product_deleted'])) {
            $swal .= ' swal("Sucesso", "Produto deletado com sucesso.", "success"); ';
            $verificaSwal++;
        }
        
         if (isset($_GET['product_create_error'])) {
            $swal .= ' swal("Oops!", "Erro ao criar o produto. Verifique se os dados foram inseridos corretamente.", "error"); ';
            $verificaSwal++;
        }
        
        if (isset($_GET['product_update_error'])) {
            $swal .= ' swal("Oops!", "Erro ao editar o produto. Verifique se os dados foram inseridos corretamente.", "error"); ';
            $verificaSwal++;
        }
        
        if (isset($_GET['product_delete_error'])) {
            $swal .= ' swal("Oops!", "Erro ao editar deletear o produto. Contate o administrador.", "error"); ';
            $verificaSwal++;
        }
        
        
        if ($verificaSwal > 0) {
            $retorno = "<script>" . $swal . "</script>";
        } else {
            $retorno = "";
        }
        return $retorno;
    }

}
