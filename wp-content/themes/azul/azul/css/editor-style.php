<?php 
    require_once('../../../../wp-load.php');
?>

<?php 
function getExtCustomFonts($font) {
    $dir = get_template_directory().'/fonts'; 
        if ($handle = opendir($dir)) { 
            $arr = array();
            // Get all files and store it to array
            while(false !== ($entry = readdir($handle))) {
                $explode_font=explode('.',$entry);
                if(strtolower($font)==strtolower($explode_font[0]))
                    $arr[] = $entry;
            }          
            closedir($handle); 
            // Remove . and ..
            unset($arr['.'], $arr['..']); 
            return $arr;
        }
}

switch(get_option('font_source_1')) {
    case('System fonts') :
        $fonts = urldecode(get_option('font_type_1'));
        $type = 0;
        break;
    case('Custom fonts') :
        //$fonts = get_template_directory_uri()."/fonts/".getExtCustomFonts(get_option('font_type_1'));
        $fonts = get_option('font_type_1');
        $type = 1;
        break;
    case('Google fonts') :
        $fonts = get_option('font_type_1');
        $type = 2;
        break;
}

switch(get_option('font_source_2')) {
    case('System fonts') :
        $fonts2 = urldecode(get_option('font_type_2'));
        $type2 = 0;
        break;
    case('Custom fonts') :
        $fonts2 = get_option('font_type_2');
        $type2 = 1;
        break;
    case('Google fonts') :
        $fonts2 = get_option('font_type_2');
        $type2 = 2;
        break;
}

?>
<?php if($type==1) : ?>

	@font-face {
		font-family: '<?php echo $fonts ?>';
		src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $fonts; ?>.eot');
		src: <?php foreach(getExtCustomFonts($fonts) as $item) : ?> 
                    <?php $explode_item = explode(".", $item);                     
                    if($explode_item[1]=='eot') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.eot?#iefix') format('embedded-opentype'),
                    <?php endif; 
                    if($explode_item[1]=='woff') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.woff') format('woff'),
                    <?php endif; 
                    if($explode_item[1]=='ttf') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.ttf') format('truetype');
                <?php endif; 
                endforeach; ?>
	}

<?php endif; ?>
<?php if($type2==1) : ?>

	@font-face {
		font-family: '<?php echo $fonts2 ?>';
		src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $fonts2; ?>.eot');
		src: <?php foreach(getExtCustomFonts($fonts2) as $item) : ?> 
                    <?php $explode_item = explode(".", $item);                     
                    if($explode_item[1]=='eot') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.eot?#iefix') format('embedded-opentype'),
                    <?php endif; 
                    if($explode_item[1]=='woff') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.woff') format('woff'),
                    <?php endif; 
                    if($explode_item[1]=='ttf') : ?>
                    url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo $explode_item[0]; ?>.ttf') format('truetype');
                <?php endif; 
                endforeach; ?>
	}

<?php endif; ?>

<style>
	body {
		display: none !important;
	}

	html .mceContentBody img {
		max-width: 100%;
		height: auto;	
	}

	html img.mcewpmore {
		width: 95%;
		height: 12px
	}

	html .mceContentBody h1 {
		color: red;
	}

	html .mceContentBody h1, html .mceContentBody h2, html .mceContentBody h3, html .mceContentBody h4, html .mceContentBody h5 {
		border: 1px solid #ccc;
		border-style: none none dashed none;
		color: #000;
		line-height: 1.3em;
		padding-bottom: 7px;
		text-transform: uppercase;
	}

	html .mceContentBody a {
		color: #005691;
		text-decoration: none;
	}

	html .mceContentBody a:hover {
		color: #0084DF;
	}

	html .mceContentBody hr {
		border: 1px solid #ccc;
		border-style: dashed none none none;	
	}





	/*  CUSTOM STYLES */



	/* Main text font size */

	html .mceContentBody h1 {
		font-size: <?php echo get_option('heading1', '30'); ?>px;
	}

	html .mceContentBody h2 {
		font-size: <?php echo get_option('heading2', '24'); ?>px;
	}

	html .mceContentBody h3, html .mceContentBody .statement-box h2 {
		font-size: <?php echo get_option('heading3', '20'); ?>px;
	}

	html .mceContentBody h4 {
		font-size: <?php echo get_option('heading4', '14'); ?>px;
	}

	html .mceContentBody h5 {
		font-size: <?php echo get_option('heading5', '12'); ?>px;
	}
        
    html .mceContentBody * {
        font-family: <?php echo $fonts2 ?> !important;
    }

	html .mceContentBody h1, html .mceContentBody h2, html .mceContentBody h3, html .mceContentBody h4, html .mceContentBody h5, 
	html .mceContentBody blockquote, html .mceContentBody .pricing-table-price, html .mceContentBody .pricing-table-title  {
		font-family: Museo_Slab_500 !important;
		font-weight: 300 !important;
	}

</style>