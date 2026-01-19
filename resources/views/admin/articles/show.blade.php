@extends('admin.partials.app')

@section('title', 'Articles')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Articles</h4>
    <a href="/admin/articles/create" class="btn btn-primary">+ Tambah</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Status</th>
            <th width="160">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <td>{{ $article->title }}</td>
            <td>
                {{ $article->is_published ? 'Publish' : 'Draft' }}
            </td>
            <td>
                <a href="/admin/articles/{{ $article->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="/admin/articles/{{ $article->id }}" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus berita?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
