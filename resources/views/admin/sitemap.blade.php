<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($singles as $single)
        @foreach($single->translations as $key => $translation)
            <url>
                <loc>{{ url('/') . ($key>0 ? '/' . $translation->locale : '') . '/' . $translation->slug }}</loc>
                <priority>1.0</priority>
                <lastmod>{{ $single->created_at->tz('UTC')->toAtomString() }}</lastmod>
            </url>
        @endforeach
    @endforeach
    @foreach($blogs as $single)
        @foreach($single->translations as $key => $translation)
            <url>
                <loc>{{ url('/') . ($key>0 ? '/' . $translation->locale : '') . '/' . $translation->slug }}</loc>
                <priority>1.0</priority>
                <lastmod>{{ $single->created_at->tz('UTC')->toAtomString() }}</lastmod>
            </url>
        @endforeach
    @endforeach
    @foreach($products as $single)
        @foreach($single->translations as $key => $translation)
            <url>
                <loc>{{ url('/') . ($key>0 ? '/' . $translation->locale : '') . '/' . $translation->slug }}</loc>
                <priority>1.0</priority>
                <lastmod>{{ $single->created_at->tz('UTC')->toAtomString() }}</lastmod>
            </url>
        @endforeach
    @endforeach
    @foreach($categories as $single)
        @foreach($single->translations as $key => $translation)
            <url>
                <loc>{{ url('/') . ($key>0 ? '/' . $translation->locale : '') . '/' . $translation->slug }}</loc>
                <priority>1.0</priority>
                <lastmod>{{ $single->created_at->tz('UTC')->toAtomString() }}</lastmod>
            </url>
        @endforeach
    @endforeach
</urlset>
