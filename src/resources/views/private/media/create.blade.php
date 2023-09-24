@extends('tacms::layouts.private')
@section('content')
<div class="notifications">
  @if ($errors->any())
      @foreach ($errors->all() as $error)
          <div class="error">
              <span>{{ $error }}</span>
              <button class="no-btn">×</button>
          </div>
      @endforeach
  @endif
  @if (session('success'))
  <div class="success">
      <span>{{ session('success') }}</span>
      <button class="no-btn">×</button>
  </div>
  @endif
  @if (session('error'))
  <div class="error">
      <i>
          @includeIf('icons.flash-error')
      </i>
      <span>{{ session('error') }}</span>
      <button class="no-btn">×</button>
  </div>
  @endif
  @if (session('info'))
  <div class="default">
      <span>{{ session('info') }}</span>
      <button class="no-btn">×</button>
  </div>
  @endif
</div>
<form action="{{ route('media.store') }}" enctype="multipart/form-data" method="post">
  @csrf
  <input type="file" name="files[]" multiple>
  <input type="submit">
</form>
@endsection