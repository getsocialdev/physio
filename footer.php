<?php if(is_page_template('template-landing.php')){ ?>
<footer class="main-footer clerfix">
  <div class="container">
    <div class="copyright">
      <div class="copy-left">
         <?php if(of_get_option('copyright')) { echo '<p>'.do_shortcode(of_get_option('copyright')).'</p>'; } ?>
      </div>
      <div class="copy-right">
		<?php echo do_shortcode('[social-links]'); ?>
       </div>
    </div>
  </div>
</footer>
<?php }else{ ?>
<?php if ( is_active_sidebar( 'instagram-widget' ) ) : ?>
<div id="instagram-section" class="instagram-section">
	<?php dynamic_sidebar( 'instagram-widget' ); ?>
</div>
<?php endif; ?>
<div class="fdn"></div>
<?php if ( is_active_sidebar( 'bottom-widget' ) ) : ?>
    <div id="bottom-section" class="bottom-section">
    <div class="container">
		<?php dynamic_sidebar( 'bottom-widget' ); ?>
        </div>
	</div>
<?php endif; ?>
<footer>
<?php if(is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' )){ ?>
<div class="main-footer">
  <div class="container">
  	<div class="row">
  	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
    <div class="footer-widget">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
<?php endif; ?>
<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
    <div class="footer-widget">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>
<?php endif; ?>
<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
    <div class="footer-widget">
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div>
<?php endif; ?>
	</div>
  </div>
 </div>
 <?php } ?>
     <div class="copyright">
     <div class="container">
         <?php if(of_get_option('copyright')) { echo '<p>'.do_shortcode(of_get_option('copyright')).'</p>'; } ?>
    </div>
    </div>
</footer>
<?php } ?>
</div>
<div id="btt"><a href="JavaScript:Void(0);" class="btt-btn">Top</a></div>
<?php wp_footer(); ?>
<script>
$("#btnSave").bind('click', function() {
    window.location.href = $(this).attr('href');
});
</script>
</body>
</html>
