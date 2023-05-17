<?php

namespace Tahir\CMS\Controllers;

use Illuminate\Http\Request;

class CMSController {
  public function index() {
    return view('cms::index');
  }
}