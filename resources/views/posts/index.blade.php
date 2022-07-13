@extends('layouts.main')


@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Blog</h1>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible mt-4" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $message }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <section>
                    <div class="row blog-post-row">
                        @foreach($posts as $post)
                        <div class="col-md-4 blog-post" data-aos="fade-up">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{ $post->image ?? asset('assets/images/no_photo.jpg') }}" alt="{{$post->title}}">
                            </div>
                            <p class="blog-post-category">{{ $post->intro }}</p>
                            <a href="{{route('post.show', $post->post_id)}}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{$post->title}}</h6>
                            </a>
                            <span class="float-left">
                                Author: {{ $post->author }}
                                <br>
                                Date: {{ date_format($post->created_at, 'd.m.Y H:i') }}
                            </span>
                            <a href="{{route('post.show', $post->post_id)}}" class="btn btn-dark float-right">Read more</a>
                        </div>
                        @endforeach
                    </div>
                    {{$posts->links()}}
                </section>
            </div>

        </div>
    </div>

</main>
@endsection