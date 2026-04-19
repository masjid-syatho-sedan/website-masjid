<?php

namespace App\Http\Controllers;

use App\Models\AmbulanceJournal;
use App\Models\Article;
use App\Models\GeneralJournal;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $articles = Article::published()
            ->orderByDesc('published_at')
            ->get(['slug', 'updated_at']);

        $generalJournals = GeneralJournal::published()
            ->orderByDesc('journal_date')
            ->get(['id', 'updated_at']);

        $ambulanceJournals = AmbulanceJournal::published()
            ->orderByDesc('journal_date')
            ->get(['id', 'updated_at']);

        $content = view('sitemap', compact('articles', 'generalJournals', 'ambulanceJournals'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
