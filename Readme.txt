dans le htaccess de public :


<IfModule mod_rewrite.c>
  Options -Multiviews
  RewriteEngine On


  ---ici--- : modifier le noms du dosssier :   RewriteBase /traversMvcPoo/public
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule  ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>