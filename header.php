<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php bloginfo('name'); ?><?php wp_title("|",true); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="author" content="Timothy Long">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="alternate" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Merriweather:400,700">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:300">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?php
// insert wp_head function in order to use actions in functions.php
// http://codex.wordpress.org/Function_Reference/wp_head
wp_head();
?>
</head>
<body>
	<header style="background:
			url(<?php echo get_template_directory_uri() . '/images/bg-overlay-mono.png'; ?>),
                        <?php 
                        $options = get_option('entropy_options');
                        if(isset($options['user_photo_id'])) {
                            $back_id_src = wp_get_attachment_image_src($options['background_photo_id'], full);
                            echo "url($back_id_src[0])";
                        } else {
                            echo 'url(' . get_template_directory_uri() . '/images/hero-bg.jpg)';
                        }
                        ?> center center; 
                        -webkit-background-size: cover;
                        -moz-background-size: cover;
                        -o-background-size: cover;
                        background-size: cover;">
		<div class="header-inner">
			<div id="photo" style="
                             background: url(<?php
                             if(isset($options['user_photo_id'])) {
                                 $user_id_src = wp_get_attachment_image_src($options['user_photo_id'], full);
                                 echo $user_id_src[0];
                             } else {
                                 echo get_template_directory_uri() . '/images/user.jpg'; 
                             } 
                             ?>) center center no-repeat;">
				<a href="<?php echo get_settings('home'); ?>">&nbsp;</a>
			</div>
			<div class="title">
				<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></h1>
				<p><?php bloginfo('description'); ?></p>
			</div>
		</div>
	</header>
