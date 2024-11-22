@extends('frontend.user.article.use')
@section('title', __('Article'))
@section('user-article-content')
    <form action="{{ route('user.profile.update-password') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h2 class="mb-4"> {{ __('Add Article') }}</h2>
            <div class="mb-3">
                <label class="form-label" for="category">{{ __('Press Release Category') }}</label>
                <input type="" name="category" id="category" class="form-control" placeholder="{{ __('') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input type="text" name="old_password" id="title" class="form-control" placeholder="{{ __('Title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_confirmation">{{ __('Meta Title') }}</label>
                <input type="text-area" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Meta Title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">{{ __('Description') }}</label>
                <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter your text here..." required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta-description">{{ __('Meta Description') }}</label>
                <textarea id="meta-description" name="meta-description" rows="4" cols="50" placeholder="Enter your text here..." required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">{{ __('Meta Keywords') }}</label>
                <input type="" name="category" id="category" class="form-control" placeholder="{{ __('') }}" required>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <x-icon name="check" height="20" class="me-1"/> {{ __('Add') }}
                </button>
            </div>
        </div>
    </form>
@endsection