<?php
   	$xml = new DOMDocument('1.0', 'utf-8');
   	$code = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
   	$code .= '<url><loc>'.Router::url('pages/index').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('categories/index').'</loc></url>';
   	foreach ($categories as $k=>$v) {
   		$code .= '<url><loc>'.Router::url('categories/category/slug:'.$v->Category->slug).'</loc></url>';
   		foreach ($v->Category->subcategories as $sk=>$sv) {
	   		$code .= '<url><loc>'.Router::url('categories/subcategory/cat:'.$v->Category->slug.'/subcat:'.$sv->Subcategory->slug).'</loc></url>';
	   		
	   	}
   	}
   	foreach ($services as $k=>$v) {
         $code .= '<url><loc>'.Router::url($v->Service->slug).'</loc></url>';
      }
   	$code .= '<url><loc>'.Router::url('pages/customersfaq').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('pages/expertsfaq').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('pages/contact').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('pages/imprint').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('pages/termsofuse').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('profiles/signin').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('profiles/login').'</loc></url>';
   	$code .= '<url><loc>'.Router::url('profiles/password').'</loc></url>';
   	$code .= '</urlset>';
   	$xml->loadXML($code);
   	echo $xml->saveXML();
?>