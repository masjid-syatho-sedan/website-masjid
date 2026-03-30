<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ArtikelStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalArtikel = Article::count();
        $diterbitkan = Article::where('status', 'published')->count();
        $draft = Article::where('status', 'draft')->count();
        $diarsipkan = Article::where('status', 'archived')->count();
        $totalViews = (int) Article::sum('views');
        $totalKategori = Category::count();
        $totalTag = Tag::count();
        $unggulan = Article::where('featured', true)->count();

        return [
            Stat::make('Total Artikel', $totalArtikel)
                ->description('Semua artikel di sistem')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Diterbitkan', $diterbitkan)
                ->description($draft . ' draft · ' . $diarsipkan . ' diarsipkan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Total Dilihat', number_format($totalViews, 0, ',', '.'))
                ->description('Total pembaca artikel')
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),

            Stat::make('Artikel Unggulan', $unggulan)
                ->description('Ditampilkan di halaman depan')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Kategori', $totalKategori)
                ->description($totalTag . ' tag tersedia')
                ->descriptionIcon('heroicon-m-tag')
                ->color('gray'),
        ];
    }
}
