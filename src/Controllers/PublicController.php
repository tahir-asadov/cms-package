<?php

namespace Tahir\CMS\Controllers;

use Illuminate\Http\Request;

class PublicController {
  public function index() {
    return view('tacms::index');
  }
}