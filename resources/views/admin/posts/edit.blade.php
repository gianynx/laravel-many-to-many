@extends('layouts.admin')

@section('page_title')
    Edit this project
@endsection

@section('content')
    <section class="container pt-5 pb-5">
        <h1 class="pb-4"><span class="text-secondary">Edit this project:</span> {{ $post['title'] }}</h1>
        <form action="{{ route('admin.posts.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Image</label>
                <input type="file" class="form-control" name="image" id="image" aria-describedby="imageHelp"
                    value="{{ old('image', $post['image']) }}">
                <div id="imageHelp" class="form-text">Insert a image!</div>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp"
                    value="{{ old('title', $post['title']) }}">
                <div id="titleHelp" class="form-text">Insert a title!</div>
            </div>
            <div class="mb-3">
                <label for="technology_id" class="form-label fw-bold">Technology</label>
                <select name="technology_id" id="technology_id"
                    class="form-select @error('technology_id') is-invalid @enderror">
                    <option selected>Open this select menu!</option>
                    @foreach ($technologies as $technology)
                        <option value="{{ $technology->id }}">
                            {{ $technology->name }}
                        </option>
                    @endforeach
                </select>
                <div id="technologyHelp" class="form-text">Insert a technology!</div>
                @error('technology_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label fw-bold">Body</label>
                <div>
                    <textarea name="body" id="body" cols="193" rows="7">
                        {{ old('body', $post['body']) }}
                    </textarea>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-label fw-bold">Collaborators</div>
                @foreach ($collaborators as $collaborator)
                    <div>
                        <input name="collaborators[]" class="form-check-input" type="checkbox"
                            value="{{ $collaborator->id }}" id="collaborators"
                            {{ $post->collaborators->contains($collaborator) ? 'checked' : '' }}>
                        <label class="form-check-label px-2" for="collaborators">
                            {{ $collaborator->name }}
                            {{ $collaborator->surname }}
                        </label>
                    </div>
                @endforeach
                <div class="form-text">Insert the collaborators!</div>
                @error('collaborators')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-outline-dark text-uppercase">Submit</button>
                <button type="reset" class="btn btn-outline-dark text-uppercase">Reset</button>
            </div>
        </form>
        <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(nicEditors.allTextAreas);
        </script>
    </section>
@endsection
