<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>{{env('APP_URL')}}</loc>
        <lastmod>{{ $carbon::now()->setTimezone('Asia/Jakarta')->toIso8601String() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        <image:image>
            <image:loc>{{ asset('src/images/icons/logo-01.png') }}</image:loc>
            <image:caption>Rumah Pekerja Hebat</image:caption>
        </image:image>
    </url>
</urlset>