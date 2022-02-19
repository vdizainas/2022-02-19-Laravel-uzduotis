@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3 bg-white sidebar p-3">        
        <div class="col mb-3">
          <a class="btn btn-primary w-100" href="{{route('post.create')}}">Create new post</a>
        </div>
         {{-- sort --}}
        <div class="col">
          <h5>Sort</h5>
          <form method="GET" action="{{route('post.indexpagination')}}">
            @csrf
            <select class="form-select mb-3" name="sortCollumn">
              @foreach ($select_array as $key=>$item)

                @if ($item == $sortCollumn || ($key == 0 && empty($sortCollumn)) )
                  <option value='{{$item}}' selected>{{$item}}</option>
                @else
                  <option value="{{$item}}">{{$item}}</option>  
                @endif
                  
              @endforeach
            </select>
            <select class="form-select mb-3" name="sortOrder">
              @if ($sortOrder == 'desc' || empty($sortOrder))
                <option value='desc' selected>New post</option>
                <option value='asc'>Old post</option>
              @else
                <option value='desc'>New post</option>                    
                <option value='asc' selected>Old post</option>
              @endif
            </select>
            <button class="btn btn-secondary w-100" type="submit">Sort</button>
          </form>
        </div>
        {{-- END --}}
      </div>
      <div class="col-md-9">

        <div class="row justify-content-end">              

           {{-- pagintation --}}          
           <div class="col-auto">
            {{$posts->links()}}             
          </div>
          {{-- END --}}   

        </div>

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
                  <div class="col-6"><small class="author-name text-muted">Author: {{$post->author}}</small></div>
                  <div class="col-6 text-end"><small class="author-name text-muted">category: {{$post->postCategory->name}}</small></div>
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
        {{-- END posts row --}}

        {{-- pagintation --}}
        <div class="row">
          <div class="col-auto mt-3 mx-auto">
            {{$posts->links()}}             
          </div>
        </div>
        {{-- END --}}

      </div>
    </div>
</div>
@endsection
