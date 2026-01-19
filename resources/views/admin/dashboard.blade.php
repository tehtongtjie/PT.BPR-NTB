@extends('admin.layouts.app')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | BPR NTB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/js/app.js'])
</head>
<body>

<div class="admin-wrapper">

    {{-- CONTENT --}}
    <main class="admin-content">
        {{-- STAT CARDS --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:20px; margin-bottom:30px;">
            
            <div class="admin-card">
                <h4>Total Articles</h4>
                <p style="font-size:2rem; font-weight:700; margin:0;">
                    {{ $totalArticles ?? 0 }}
                </p>
            </div>

            <div class="admin-card">
                <h4>Articles Publish</h4>
                <p style="font-size:2rem; font-weight:700; margin:0;">
                    {{ $publishedArticles ?? 0 }}
                </p>
            </div>

            <div class="admin-card">
                <h4>Draft Articles</h4>
                <p style="font-size:2rem; font-weight:700; margin:0;">
                    {{ $draftArticles ?? 0 }}
                </p>
            </div>

        </div>

        {{-- RECENT ARTICLES --}}
        <div class="admin-card">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                <h3 style="margin:0;">Berita Terbaru</h3>
                <a href="/admin/articles" class="btn-primary">Kelola Articles</a>
            </div>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestArticles ?? [] as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>
                                {{ $article->is_published ? 'Publish' : 'Draft' }}
                            </td>
                            <td>{{ $article->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Belum ada artikel</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>

</body>
</html>