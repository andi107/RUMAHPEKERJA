<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>{{env('APP_URL')}}</loc>
        <lastmod>2022-10-04T22:02:41+07:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    @foreach ($res->data as $key => $r)
        <url>
            <loc>{{ env('APP_URL').'/c/'. $r->fncategory .'/'. $r->ftuniq .'/'.$r->fttitle_url }}</loc>
            <lastmod>{{ $carbon::createFromFormat('Y-m-d H:i:s', $r->updated_at, 'UTC')->setTimezone('Asia/Jakarta')->toIso8601String() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>