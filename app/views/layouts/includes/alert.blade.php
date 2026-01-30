@if(isset($_SESSION['success']))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{$_SESSION['success']}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(isset($_SESSION['error']))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{$_SESSION['error']}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@php
unset($_SESSION['success']);
unset($_SESSION['error']);
@endphp