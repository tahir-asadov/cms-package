<?php

namespace Tahir\CMS\Controllers;

use Illuminate\Http\Request;

class PrivateController {
  public function index() {
    return view('tacms::dashboard');
  }
}