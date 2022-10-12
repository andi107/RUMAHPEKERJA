<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach ($res->data as $key => $r)
        <url>
            <loc>{{route('post-detail',[$r->fttitle_url.'@'.$r->ftuniq])}}</loc>
            
            <lastmod>{{ $carbon::createFromFormat('Y-m-d H:i:s', $r->updated_at, 'UTC')->setTimezone('Asia/Jakarta')->toIso8601String() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
            <image:image>
                <image:loc>{{ route('image-view', [$r->ftgalery_folder,$r->ftgalery_ext,$r->ftgalery_name]) }}</image:loc>
                <image:caption>{{ $r->ftdescription }}</image:caption>
            </image:image>
        </url>
    @endforeach
</urlset>