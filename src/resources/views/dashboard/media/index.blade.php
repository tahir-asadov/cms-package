@extends('tacms::layouts.private')
@section('content')
Media view: <code>{{ config('tacms.homepage') }}</code>
<input type="file" id="media-page-assets" name="files[]" multiple>
@endsection