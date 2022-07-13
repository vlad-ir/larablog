@extends('layouts.main', ['title' => 'Edit post: '.$post->title])


@section('content')
<main class="blog">
    <div class="container">
        <h1 class="edica-page-title" data-aos="fade-up">Edit post: {{ $post->title }}</h1>

        <div class="row">
            <div class="col-md-12">
                <section>
                    <form method="POST" action="{{ route('post.update', $post->post_id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') ?? $post->title ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="intro" placeholder="Intro" required>{{ old('intro') ?? $post->intro ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="text" placeholder="Text" rows="7" required>{{ old('text') ?? $post->text ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        @isset($post->image)
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="remove" id="remove">
                            <label class="form-check-label" for="remove">
                                Remove uploaded image
                            </label>
                        </div>
                        <div class="form-group">
                            <img src="{{ $post->image}}" alt="{{$post->title}}" class="col-md-3">
                        </div>
                        @endisset
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