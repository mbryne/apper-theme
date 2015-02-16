<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

	<head>

		<title><?php wp_title(''); ?></title>

		<?php get_template_part('content/head-meta'); ?>

		<?php wp_head(); ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header" class="wrap cf">

					<?php get_template_part('content/header-content'); ?>

				</div>

			</header>
