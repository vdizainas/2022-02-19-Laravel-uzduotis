@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div  class="col-md-3 bg-white sidebar p-3">
        sidebar
        <a class="btn btn-primary w-100" href="{{route('post.create')}}">Create new post</a>
        <form method="GET" action="{{route('post.catfilter')}}">
          @csrf
          <select  class="form-select my-3" name="category_id">
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>                
            @endforeach
          </select>
          <button class="btn btn-secondary w-100" type="submit">Filter</button>
        </form>
      </div>
      <div class="col-md-9">

        @if (count($posts) == 0)
          <p>Įrašų nėra</p>
        @endif

        {{-- posts --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">     

          @foreach ($posts as $post)              
          
          <div class="col">
            <div class="card post-card shadow-sm">
              <div class="img-wrapper">
                <img src="{{$post->thumbnail}}" />
              </div>
  
              <div class="card-body">
                <h5 class="post-title fw-bold">{{$post->title}}</h5>   
                <div class="row">
                  <div class="col-6"><small class="author-name text-muted">{{$post->author}}</small></div>
                  <div class="col-6 text-end"><small class="author-name text-muted">{{$post->postCategory->name}}</small></div>
                </div>                
                <p class="card-text">{{$post->content}}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary" href="{{route('post.show', [$post])}}">View</a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{route('post.edit', [$post])}}">Edit</a>
                    <form method="POST" action="{{route('post.destroy', [$post])}}">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                  </div>
                  <small class="post-date text-muted">{{$post->data}}</small>
                </div>
              </div>
            </div>
          </div>  

          @endforeach

        </div>
        {{-- END posts items row --}}

      </div>
    </div>
</div>
@endsection
