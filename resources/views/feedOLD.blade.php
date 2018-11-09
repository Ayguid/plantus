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



  @if (Auth::user())
    <div class="post_button">
      <button id="post_button" type="button" name="button">PLANK IT!!</button>
    </div>
    <div id="post_input" class="card post_input">

      <form method="post" action="{{route('make_post')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <input type="number" name="user_id" value="{{Auth::user()->id}}" hidden>

          <textarea rows="4" id="content" class="form-control" type="text"  name="content"  aria-describedby="emailHelp" placeholder="Post Something" required></textarea>
        </div>

        <div class="form-group">
          <input id="has_image" class="form-control" type="file" name="has_image[]" placeholder="Something cool" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

      </form>

    </div>
    <br>
  @endif

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


      {{-- @foreach ($posts as $post)
      <div class="post_box">
      <p>{{$post->content}}</p><br>
      <span class="user_name">{{$post->user->name}}</span><br>
      @if ($post->has_image)
      @foreach ($post->images as $image)
      <img class="post_image" src="{{asset('storage/uploads/PostMedia/'.$image->image_path)}}" alt="" width="100%">
    @endforeach
  @endif
</div>


@if (Auth::guard('admin')->check())
<form class="" action="{{route('destroy_post')}}" method="post">
{{ csrf_field() }}
<input type="text" name="post_id" value="{{$post->id}}" hidden>

<input type="submit" name="" value="Delete Post">
</form>
@endif



<br>
@endforeach --}}
{{-- {{ $posts->appends(Illuminate\Support\Facades\Input::except('page'))->links() }} --}}
{{-- {{$posts->links()}} --}}

{{-- @if (Auth::guard('admin')->check())
<form class="" action="{{route('destroy_post')}}" method="post">
{{ csrf_field() }}
<input type="text" name="post_id" value="{{$post->id}}" hidden>

<input type="submit" name="" value="Delete Post">
</form>
@endif --}}


<posts-component id="posts" class="posts"></posts-component>


</div>
</div>
</div>
</div>
</div>


{{-- <script src="{{ asset('js/posts.js') }}" defer></script> --}}



@endsection
