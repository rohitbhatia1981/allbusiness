<?php //include "private/settings.php";


/*function htCategoryName($catName)
	{

			$categoryName=str_replace(" ","-",$catName);
			$categoryName=str_replace("/","-",$categoryName);
			$categoryName=str_replace(",","",$categoryName);
			$categoryName=str_replace("ä","a",$categoryName);
			$categoryName=str_replace(".com","",$categoryName);
			$categoryName=str_replace("|","",$categoryName);
			$categoryName=str_replace("&amp;","",$categoryName);
			$categoryName=str_replace("&","",$categoryName);
			$categoryName=str_replace("---","-",$categoryName);
			$categoryName=str_replace("--","-",$categoryName);
			$categoryName=str_replace("'","",$categoryName);
			$categoryName=str_replace('"',"",$categoryName);
			$categoryName=str_replace("?","",$categoryName);
			$categoryName=str_replace("#","",$categoryName);
			$categoryName=str_replace("!","",$categoryName);
			$categoryName=str_replace(":","",$categoryName);
			$categoryName=str_replace("(","-",$categoryName);
			$categoryName=str_replace(")","-",$categoryName);
			return urlencode(strtolower($categoryName));

	}*/




			






 $sqlAll_serv="select * from tbl_cities where city_status=1";
 $resAll_serv=$database->get_results($sqlAll_serv);
 $TotalAll_serv = count($resAll_serv);
			if ($TotalAll_serv>0)

			{		

				for ($i = 0; $i < $TotalAll_serv; $i++) 
						{

						$rowAll_serv=$resAll_serv[$i];	
						$cityName=htCategoryName($rowAll_serv['city_name']);
						$postcode=$rowAll_serv['city_postcode'];	
						$state=strtolower($rowAll_serv['city_state']);					

						if ($cityName!="") 					

						$htaccess_str.="RewriteRule  ^business-for-sale/".$state."/".$cityName."$ cms/buy-business.php?lid=".$postcode."&landing=city [L] \n";

						}

			}
	
	 $sqlAll_serv="select * from tbl_business_category where bc_status=1 ";
 	 $resAll_serv=$database->get_results($sqlAll_serv);
	 $TotalAll_serv = count($resAll_serv);
			if ($TotalAll_serv>0)

			{		

				for ($i = 0; $i < $TotalAll_serv; $i++) 
						{

						$rowAll_serv=$resAll_serv[$i];	
						$bizCatname=htCategoryName($rowAll_serv['bc_name']);
						$bizcatId=$rowAll_serv['bc_id'];

						if ($bizCatname!="") 					

						$htaccess_str.="RewriteRule  ^".$bizCatname."-for-sale$ cms/buy-business.php?category=".$bizcatId."&landing=category [L] \n";

						}

			}

			

	//RewriteRule ^food-hospitality$ cms/buy-business.php?category=5 [L]








$htaccess = <<<ENDHTACCESS

RewriteEngine On
Options +FollowSymLinks

<IfModule mod_security.c>
    SecFilterEngine Off
    SecFilterScanPOST Off
</IfModule>


#RewriteCond %{HTTP_HOST} ^allbusiness.com.au [NC] 
#RewriteRule ^(.*)$ https://www.allbusiness.com.au/$1 [L,R=301]

#RewriteCond %{HTTP_HOST} allbusiness\.com.au [NC]
#RewriteCond %{SERVER_PORT} 80
#RewriteRule ^(.*)$ https://www.allbusiness.com.au/$1 [R,L]

RewriteRule ^business-for-sale/vic$ cms/buy-business.php?state=VIC&landing=state [L]

RewriteRule ^business-for-sale/act$ cms/buy-business.php?state=ACT&landing=state [L]
RewriteRule ^business-for-sale/nsw$ cms/buy-business.php?state=NSW&landing=state [L]
RewriteRule ^business-for-sale/nt$ cms/buy-business.php?state=NT&landing=state [L]
RewriteRule ^business-for-sale/qld$ cms/buy-business.php?state=QLD&landing=state [L]
RewriteRule ^business-for-sale/sa$ cms/buy-business.php?state=SA&landing=state [L]
RewriteRule ^business-for-sale/tas$ cms/buy-business.php?state=TAS&landing=state [L]
RewriteRule ^business-for-sale/vic$ cms/buy-business.php?state=VIC&landing=state [L]
RewriteRule ^business-for-sale/wa$ cms/buy-business.php?state=WA&landing=state [L]



$htaccess_str

RewriteRule ^([^/]+)/vic/melbourne/([0-9]+)/([0-9]+)$ cms/buy-business.php?type=$1&lid=$2&category=$3&landing=city [L,QSA]

#ErrorDocument 404 /pharmahealth/pages/404.php

RewriteRule  ^buy-business cms/buy-business.php [L,NC,END]
RewriteRule  ^private-sellers cms/private-sellers.php [L,NC,END]
RewriteRule  ^for-brokers cms/for-brokers.php [L,NC,END]

RewriteRule ^business-(.*)-(.*)$ cms/bdetail?id=$2 [L]



RewriteRule  ^buyer-signup cms/signup.php [L,NC,END]
RewriteRule  ^news cms/news.php [L,NC,END]
RewriteRule ^detail-(.*)-(.*)$ cms/news-detail?id=$2 [L]

RewriteRule  ^private-seller cms/private-seller-signup.php [L,NC,END]

RewriteRule ^login cms/login?id=$2 [L]


RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([^\.]+)$ $1.php [NC,L]

<ifModule mod_gzip.c>
  mod_gzip_on Yes
  mod_gzip_dechunk Yes
  mod_gzip_item_include file \.(html?|txt|css|js|php|pl)$
  mod_gzip_item_include mime ^application/x-javascript.*
  mod_gzip_item_include mime ^text/.*
  mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
  mod_gzip_item_exclude mime ^image/.* 
  mod_gzip_item_include handler ^cgi-script$
</ifModule>

# Leverage Browser Caching
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/jpg "access 1 year"
  ExpiresByType image/webp "access 1 year"
  ExpiresByType image/jpeg "access 1 year"
  ExpiresByType image/gif "access 1 year"
  ExpiresByType image/png "access 1 year"
  ExpiresByType text/css "access 1 year"
  ExpiresByType text/js "access 1 year"
  ExpiresByType text/html "access 1 year"
  ExpiresByType application/pdf "access 1 year"
  ExpiresByType text/x-javascript "access 1 year"
  ExpiresByType application/x-shockwave-flash "access 1 year"
  ExpiresByType image/x-icon "access 1 year"
  ExpiresDefault "access 1 year"
</IfModule>

<IfModule mod_headers.c>
  <filesmatch "\.(ico|flv|jpg|jpeg|png|gif|css|swf|webp)$">
  Header set Cache-Control "max-age=31536000 , public"
  </filesmatch>
  <filesmatch "\.(html|htm)$">
  Header set Cache-Control "max-age=31536000 , private, must-revalidate"
  </filesmatch>
  <filesmatch "\.(pdf)$">
  Header set Cache-Control "max-age=31536000 , public"
  </filesmatch>
  <filesmatch "\.(js)$">
  Header set Cache-Control "max-age=31536000 , private"
  </filesmatch>
</IfModule>



ENDHTACCESS;







	

	//@unlink('.htaccess');

	@file_put_contents(PATH.'.htaccess', $htaccess);







?>

<!--
for live site
<FilesMatch \.php$>

        SetHandler proxy:fcgi://magicbricks-php81

</FilesMatch>-->