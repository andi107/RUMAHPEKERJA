<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($res->data as $key => $r)
        <url>
            <loc>{{route('home').'/sitemap/'.$r->ftname}}</loc>
            <lastmod>{{ $carbon::now()->setTimezone('Asia/Jakarta')->toIso8601String() }}</lastmod>
            <changefreq>daily</changefreq>
        </url>
    @endforeach
</urlset>