<?php

namespace Tahir\CMS\Http\Controllers;

use Illuminate\Http\Request;

class PublicController {
  public function index() {
    return view('tacms::index');
  }
}