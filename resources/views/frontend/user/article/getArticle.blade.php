@extends('frontend.user.article.use')
@section('title', __('Article'))
@section('user-article-content')
    <div class="card border-0 mb-4">
        <div class="card-body px-2">
            <div class="table-responsive rounded mb-3">
                <table class="table card-table table-vcenter text-nowrap mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>{{ __('id') }}</th>
                        <th>{{ __('title') }}</th>
                        <th>{{ __('content') }}</th>
                        <th>{{ __('description') }}</th>
                        <th>{{ __('alt tag') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($article as $item) <!-- Loop through each article -->
                        <tr>
                            <td>{{ $item->id }}</td> <!-- Display the article ID -->
                            <td>{{ $item->title }}</td> <!-- Display the article title -->
                            <td>{{ $item->content }}</td> <!-- Display the article content -->
                            <td>{{ $item->description ?? 'N/A' }}</td> <!-- Display the description, if available -->
                            <td>{{ $item->alt_tag}}</td> <!-- Display the alt tag, if available -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection





