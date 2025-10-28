# Reemplazar VirtualHost por uno compatible en producción
RUN printf '%s\n' "<VirtualHost *:10000>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/public
    ServerName taxi-express-ywvu.onrender.com

    <IfModule mod_headers.c>
        Header always set X-Frame-Options \"SAMEORIGIN\"
    </IfModule>

    SetEnvIf Authorization .+ HTTP_AUTHORIZATION=\$0

    <FilesMatch \"\.(html|htm|php)\">
        Header set Cache-Control \"no-cache, no-store, must-revalidate\"
        Header set Pragma \"no-cache\"
        Header set Expires 0
    </FilesMatch>

    <Directory /var/www/html/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted

        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_URI} (.+)/\$
            RewriteRule ^ %1 [L,R=301]
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^ index.php [L]
        </IfModule>
    </Directory>

    <Directory /var/www/html/public/build>
        Options -Indexes
        AllowOverride None
        Require all granted

        <FilesMatch \"\.(css|js|map|json|svg|woff|woff2|ttf|eot|ico)\">
            SetHandler default-handler
        </FilesMatch>

        <IfModule mod_expires.c>
            ExpiresActive On
            ExpiresByType text/css \"access plus 1 year\"
            ExpiresByType application/javascript \"access plus 1 year\"
            ExpiresByType image/svg+xml \"access plus 1 year\"
            ExpiresByType font/woff \"access plus 1 year\"
            ExpiresByType font/woff2 \"access plus 1 year\"
            ExpiresByType application/json \"access plus 1 year\"
        </IfModule>

        <IfModule mod_headers.c>
            Header set Cache-Control \"public, max-age=31536000, immutable\"
            Header set Access-Control-Allow-Origin \"*\"
        </IfModule>
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
    LogLevel warn
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf
