<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?><?php if (!defined('WPSEO_VERSION')) { bloginfo('name'); } ?></title>

<?php wp_head(); ?>
<!-- Hotjar Tracking Code for https://advantagesportmed.ca/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2705748,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
	
	<script type='application/ld+json'>
{
  "@context": "http://www.schema.org",
  "@type": "Physician",
  "name": "Advantage sportsmed",
  "url": "https://advantagesportmed.ca/",
  "logo": "https://advantagesportmed.ca/wp-content/uploads/2019/08/logo-h.png",
  "priceRange": "$",
  "image": "https://advantagesportmed.ca/",
  "description": "State-of-the-art Physiotherapy and Sport medicine Clinic in Edmonton & St.Albert. Specializing orthopaedic and sport injuries. To book An Appointment Call (780) 229-0174",
  "address": {
     "@type": "PostalAddress",
     "streetAddress": "575 100 St SW #302, Edmonton, AB T6X 0S8, Canada",
     "addressLocality": "Edmonton",
     "addressRegion": "Edmonton",
     "postalCode": "575 100",
     "addressCountry": "Canada"
  },
  "hasMap": "https://www.google.com/maps/dir/28.5891444,77.3810573/advantagesportmed/@3.1081879,75.3145385,3z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x53a023ada6669c87:0xe2ec8641b4635d56!2m2!1d-113.4848657!2d53.4271774",
  "telephone": "(780) 229 0174"
}
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MVZSM3K');</script>
<!-- End Google Tag Manager -->
	
	<meta name="google-site-verification" content="fGrMeniLKZ3zDUl69QTuuUAAgSlxWLKgsvIlrqqWQUk" />
</head>
	
	
<body <?php body_class($class); ?>>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MVZSM3K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="preloader">
	<span class="loader">
		<span class="loader-img">
        	<?php if ( of_get_option( 'loading_image' ) ) { ?>
            	<img src="<?php echo of_get_option( 'loading_image' ); ?>" alt="Loading" class="animated swing infinite">
            <?php } else { ?>
              	<img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" alt="Loading" class="animated swing infinite">
            <?php } ?>
		</span>
    </span>
</div>
<div class="page-wrapper">
<div class="site-overlay"></div>
<?php
	if( is_page_template('template-landing.php') ){
	?>
	<section class="top-bar clearfix">
  <div class="container">
    <div class="row">
      <div class="top-b-left top-bar-block">
        <div class="top-block">
        <?php 
		$page_id = get_queried_object_id();
		if( get_field('email_address',$page_id)){
			echo '<div class="top-email"><a href="mailto:'.get_field('email_address',$page_id).'">'.get_field('email_address',$page_id).'</a></div>';
		}else{
			echo '<div class="top-email"><a href="mailto:'.of_get_option('email').'">'.of_get_option('email').'</a></div>';
		} 
		?>
        <?php if(of_get_option('phone')) { 
			$phone = str_replace(' ', '-',of_get_option('phone'));
   			$phone = preg_replace('/[^0-9]/', '', $phone);
			echo '<div class="top-phone"><a href="tel:'.$phone.'">'.of_get_option('phone').'</a></div>';
		} ?>
      	</div>
      </div>
      <div class="top-b-right top-bar-block">
        <div class="top-block">
			<?php if ( of_get_option( 'social_media' ) ) { echo '<div class="social-icons">'.of_get_option( 'social_media' ).'</div>'; } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }else{?>
<header class="main-header">
	<div class="container">
    <div class="main-logo">
    	<?php if ( of_get_option( 'header_logo' ) ) { ?>
            	<a href="<?php echo home_url(); ?>"><img src="<?php echo of_get_option( 'header_logo' ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
            <?php } else { ?>
              	<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() . '/images/logo-h.png'; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
            <?php } ?>
    	</div>
        <div class="menu-link"><a href="javascript:void(0)" class="nav-link" style="width:50px;right:-50px;"><span></span></a></div>
    </div>
<div class="main-navigation">
	<div class="menu-wrapper">
    <div class="nav-topbar">
    <?php if ( of_get_option( 'social_media' ) ) { echo '<div class="social-icons">'.of_get_option( 'social_media' ).'</div>'; } ?>
    <div class="menu-link "><a href="javascript:void(0)" class="nav-link" style="width:50px;right:-20px;"><span></span></a></div>
   </div>
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
								<?php
									wp_nav_menu(
										array(
											'container'       => 'nav',
											'theme_location' => 'primary',
											'menu_class' => 'main-menu',
											'container_id' => 'site-navigation',
											'container_class' => 'site-navigation',
											'depth'       => 3,
											'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
											'walker'          => new WP_Bootstrap_Navwalker(),
										)
									);
								?>
						<?php endif; ?>
         <?php if ( has_nav_menu( 'policy-menu' ) ) : ?>
							<?php
									wp_nav_menu(
										array(
											'container'       => 'nav',
											'theme_location' => 'policy-menu',
											'menu_class' => 'policy-menu',
											'container_id' => 'policy-nav',
											'container_class' => 'policy-nav',
											'depth'       => 1,
										)
									);
								?>
						<?php endif; ?>
            </div>
</div>
</header>
<?php } ?>
<?php $page_id = get_queried_object_id(); ?>
<?php if( get_field('header_showhide',$page_id) == "show" ): ?>	
<div class="banner-section">
<div class="banner-hero">
  <div class="overlay"></div>
  <?php if(get_field('background_type',$page_id) == "video"){ ?>
		<?php if(get_field('mp4_video',$page_id)){ ?>
	<div class="videoWrapper">
          <video playsinline="playsinline" autoplay muted="muted" loop class="video">
            <source src="<?php echo get_field('mp4_video',$page_id); ?>" type="video/mp4" >
          </video>
	 <img src="https://advantagesportmed.ca/wp-content/uploads/2019/08/2-2.png" style="display: none;">
		</div>
      <?php } ?>
  <?php } else { ?>
		<?php if(get_field('banner_image',$page_id)){ echo wp_get_attachment_image(get_field('banner_image',$page_id),'full',"",array("class"=>"banner-img")); } ?>
  <?php } ?>
  <div class="banner-inner">
    <div class="banner-content">
      <div class="container">
      <?php if(get_field('custom_title',$page_id)){ ?>
        <div class="banner-heading"><h1 class="heading"><?php echo get_field('custom_title',$page_id); ?></h1></div>
      <?php }else{ ?>
      	<div class="banner-heading"><h1 class="heading"><?php echo get_the_title($page_id); ?></h1></div>
      <?php } ?>
      <?php if(get_field('content',$page_id)){ ?>
        <div class="banner-sheading"><?php echo get_field('content',$page_id); ?></div>
     <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
<?php endif; ?>
