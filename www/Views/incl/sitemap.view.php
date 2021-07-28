<?php header('Content-Type: application/xml; charset="utf8"', true); ?>
<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<?php foreach($urls as $url): ?>
  <url>
    <loc>http://<?php echo $_SERVER['HTTP_HOST'] . $url; ?></loc>
    <lastmod><?php echo date("Y-m-d"); ?></lastmod>
    <changefreq>daily</changefreq>
    <priority>1.00</priority>
  </url>
<?php endforeach; ?>

</urlset>