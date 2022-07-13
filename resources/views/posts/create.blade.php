@extends('layouts.main', ['title' => 'Create New Post'])


@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">New Post</h1>

        <div class="row">
            <div class="col-md-12">
                <section>
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') ?? $post->title ?? '' }}" required>
                            @error('title')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="intro" placeholder="Intro" required>{{ old('intro') ?? $post->intro ?? '' }}</textarea>
                            @error('intro')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="text" placeholder="Text" rows="7" required>{{ old('text') ?? $post->text ?? '' }}</textarea>
                            @error('text')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>

</main>
@endsection