@extends('layouts.app')



@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if(Session::has('alert-success'))
          <div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> <strong>{!! session('alert-success') !!}</strong></div>
        @endif
        @if(Session::has('alert-danger'))

          <div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> <strong>{!! session('alert-danger') !!}</strong>  {{$errors}}</div>
        @endif

        {{-- <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
  </div> --}}


  <div id="image_modal" class="image_modal">
    <!-- Modal Content (The Image) -->
    <img class="imgModal" id="imgModal">
    <!-- Modal Caption (Image Text) -->
  </div>



  <div class="card">
    <div class="card-header">PLANC Feed</div>
    <div class="card-body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif






<feed-component></feed-component>









<button id="backToTop" class="" title="Go to top">Fly</button>

</div>
</div>
</div>
</div>
</div>




@endsection
