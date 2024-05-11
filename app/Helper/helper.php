<?php


if (!function_exists('setting')) {
    function setting() {
        return \App\Setting::orderBy('id', 'desc')->first();
    }
}

if (!function_exists('years_between_two_date')) {
    function years_between_two_date($first) {
        $d1 = new DateTime($first);
        $d2 = new DateTime(date('Y-m-d'));

        $diff = $d2->diff($d1);

        return $diff->y;
    }
}

if (!function_exists('admin')) {
    function admin() {
        return auth()->guard('admin');
    }


}
if (!function_exists('user')) {
    function user() {
        return auth()->guard('user');
    }
}

if (!function_exists('aurl')) {
    function aurl($url = null) {
        return url('admin/'.$url);
    }
}

if (!function_exists('get_file')) {
    function get_file($file){
        if ($file){
            $file_path=asset('storage/uploads').'/'.$file;
        }else{
            $file_path=asset('admin/no_image.png');
        }
        return $file_path;
    }//end
}


if (!function_exists('get_slider_theme')) {
    function get_slider_theme($admin)
    {
        if ($admin->slider_theme == null) {
            return '';
        } else if ($admin->slider_theme == 'bg-dark') {
            {
                return 'sidebar-dark';
            }
            return 'sidebar-light';
        }//end
    }
}


if (!function_exists('get_slider_bg')) {
    function get_slider_bg($admin)
    {
        if ($admin->slider_theme == null) {
            return '';
        } else if ($admin->slider_theme == 'bg-dark') {
            {
                return 'bg-dark';
            }
            return 'bg-light';
        }//end
    }
}


if (!function_exists('get_nav_bg')) {
    function get_nav_bg($admin)
    {
        if ($admin->header_theme == null) {
            return 'navbar-default';
        }
        return $admin->header_theme;
    }//end


}
