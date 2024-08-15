<?php

function chek_session()
{
    $CI = &get_instance();
    $session = $CI->session->userdata;
    if ($session['status_login'] != 'oke') {
        redirect('auth/login');
    }
}

function chek_role_finance()
{
    $CI = &get_instance();
    $session = $CI->session->userdata;
    if ($session['status_login'] != 'oke') {
        redirect('auth/login');
    } else if ($session['akses'] != 2) {
        show_error('Hanya finance yang dapat mengakses halaman ini', 403, 'akses terlarang');
    }
}

function chek_role_sales()
{
    $CI = &get_instance();
    $session = $CI->session->userdata;
    if ($session['status_login'] != 'oke') {
        redirect('auth/login');
    } else if ($session['akses'] != 3) {
        show_error('Hanya sales yang dapat mengakses halaman ini', 403, 'akses terlarang');
    }
}
