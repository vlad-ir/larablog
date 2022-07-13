@extends('layouts.main', ['title' => $post->title])

@section('content')
<main class="blog-post">
    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible mt-4" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $message }}
        </div>
        @endif
        <h1 class="edica-page-title aos-init aos-animate" data-aos="fade-up">{{$post->title}}</h1>
        <p class="edica-blog-post-meta aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">Author: {{ $post->author }} Date: {{ date_format($post->created_at, 'd.m.Y H:i') }}</p>
        @if ($post->image)
        <section class="blog-post-featured-img aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
            <img src="{{ $post->image }}" alt="{{$post->title}}" class="w-100">
        </section>
        @endif
        <section class="post-content">
            <div class="row">
                <div class="col-lg-9 mx-auto aos-init aos-animate" data-aos="fade-up">
                    <p>{{ $post->text }}</p>
                </div>
            </div>
        </section>

        <section class="edica-footer-banner-section pt-5">
            <div class="container">
                <div class="footer-banner aos-init aos-animate" data-aos="fade-up">

                @if (auth()->id() != $post->author_id)
                <form action="{{ route('post.subscribe', $post->post_id) }}" method="post" class="d-inline">
                        @csrf
                        <input type="email" class="form-control" name="email" placeholder="You email" value="{{ old('email') ?? '' }}" required>
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                        <input type="submit" class="btn btn-danger" value="Subscribe for author posts">
                </form>
                @endif

                    
                    @auth
                    @if (auth()->id() == $post->author_id || auth()->id() == 1)
                    <a href="{{route('post.edit', $post->post_id)}}" class="btn btn-dark float-center">Edit post</a>
                    <form action="{{ route('post.delete', $post->post_id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this post?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
        </section>

    </div>
</main>
@endsection