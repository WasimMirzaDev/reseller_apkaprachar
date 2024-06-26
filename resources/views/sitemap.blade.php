<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
<loc>https://apkaprachar.com/</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/flash-deals/1</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>0.8</priority>
</url>
<url>
<loc>https://apkaprachar.com/brands</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/shop-cart</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/track-order</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/contacts</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/helpTopic</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/about-us</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/privacy-policy</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/terms-and-condition</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/refund-policy</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/return-policy</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/cancellation-policy</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/customer/auth/recover-password</loc>
<lastmod>2024-02-27T13:40:43+01:00</lastmod>
<priority>0.6</priority>
</url>
<url>
<loc>https://apkaprachar.com/brands?order_by=asc</loc>
<lastmod>2024-02-27T13:41:00+01:00</lastmod>
<priority>1.0</priority>
</url>
<url>
<loc>https://apkaprachar.com/brands?order_by=desc</loc>
<lastmod>2024-02-27T13:41:01+01:00</lastmod>
<priority>1.0</priority>
</url>
    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/') }}/product/{{ $post->slug }}</loc>
            <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>