<?php

namespace Tahir\CMS\Http\Controllers;

use Illuminate\Http\Request;

class PrivateController {
  public function index() {
    return view('tacms::dashboard');
  }
}