<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class MY_Profiler extends CI_Profiler {
  
  function run()
  {
    $output = "<div id='codeigniter_profiler' style='clear:both;background-color:#fff;padding:10px;'>";
    $output .= '<div style="margin-left: 2%; margin-right: 1%; float: left; width: 47%;">';
    $output .= $this->_compile_uri_string();
    $output .= $this->_compile_get();
    $output .= $this->_compile_memory_usage();
    $output .= '</div>';
    $output .= '<div style="margin-left: 51%; margin-right: 2%; width: auto;">';
    $output .= $this->_compile_controller_info();
    $output .= $this->_compile_post();
    $output .= $this->_compile_benchmarks();
    $output .= '</div>';
    $output .= '<div style="margin-left: 2%; margin-right: 2%; width: auto;">';
    $output .= $this->_compile_cookies();
    $output .= $this->_compile_queries();
    $output .= $this->_compile_session();
    $output .= '</div>';
    $output .= '</div>';
    return $output;
  }

  function _compile_session()
  {
    $output  = "\n\n";
    $output .= '<fieldset style="border:1px solid #009999;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
    $output .= "\n";
    $output .= '<legend style="color:#009999;">  ' . 'SESSION DATA' . '  </legend>';
    $output .= "\n";
    if(is_object($this->CI->session)) {
      $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";
      $sess = get_object_vars($this->CI->session);
      foreach($sess['userdata'] as $key => $val)
      {
        if( ! is_numeric($key))
        {
          $key = "'" . $key . "'";
        }
        $output .= "<tr><td width='50%' style='color:#000;
        background-color:#ddd;'>&#36;_SESSION[" . $key . "]   </td><td width='50%' style='color:#009999;font-weight:normal;background-color:#ddd;'>";
        if(is_array($val))
        {
          $output .= "<pre>" . htmlspecialchars(stripslashes(print_r($val, true))) . "</pre>";
        } else
        {
          $output .= htmlspecialchars(stripslashes($val));
        }
        $output .= "</td></tr>\n";
      }
      $output .= "</table>\n";
    }
    else
    {
      $output .= "<div style='color:#009999;font-weight:normal;padding:4px 0 4px 0'>".'No SESSION data exists'."</div>";
    }
    return $output . "</fieldset>";
  }

  function _compile_cookies()
  {
    $output  = "\n\n";
    $output .= '<fieldset style="border:1px solid red;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
    $output .= "\n";
    $output .= '<legend style="color:red;">  ' . 'COOKIES' . '  </legend>';
    $output .= "\n";
    if($_COOKIE)
    {
      $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";
      $cookies = $_COOKIE;
      foreach($cookies as $key => $val)
      {
        if( ! is_numeric($key)) {
          $key = "'" . $key . "'";
        }
        $output .= "<tr><td width='50%' style='color:#000;
        background-color:#ddd;'>&#36;_COOKIE[" . $key . "]   </td><td width='50%' style='color:red;font-weight:normal;background-color:#ddd;'>";
        if(is_array($val)) {
          $output .= "<pre>" . htmlspecialchars(stripslashes(print_r($val, true))) . "</pre>";
        } else {
          $output .= htmlspecialchars(stripslashes($val));
        }
        $output .= "</td></tr>\n";
      }
      $output .= "</table>\n";
    } else {
      $output .= "<div style='color:#009999;font-weight:normal;padding:4px 0 4px 0'>".'No COOKIE exists'."</div>";
    }
    return $output . "</fieldset>";
  }
}
