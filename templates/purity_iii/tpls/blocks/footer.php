<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- BACK TOP TOP BUTTON -->
<div id="back-to-top" data-spy="affix" data-offset-top="300" class="back-to-top hidden-xs hidden-sm affix-top">
  <button class="btn btn-primary" title="Back to Top"><i class="fa fa-caret-up"></i></button>
</div>
<script type="text/javascript">
(function($) {
	// Back to top
	$('#back-to-top').on('click', function(){
		$("html, body").animate({scrollTop: 0}, 500);
		return false;
	});
    $(window).load(function(){
        // hide button to top if the document height not greater than window height*2;using window load for more accurate calculate.    
        if ((parseInt($(window).height())*2)>(parseInt($(document).height()))) {
            $('#back-to-top').hide();
        } 
    });
})(jQuery);
</script>
<!-- BACK TO TOP BUTTON -->

<!-- FOOTER -->
<footer id="t3-footer" class="wrap t3-footer">

	<?php if ($this->checkSpotlight('footer-sl', 'footer-1, footer-2, footer-3, footer-4, footer-5, footer-6')) : ?>
		<!-- FOOTER SPOTLIGHT -->
		<div class="container hidden-xs">
			<?php $this->spotlight('footer-sl', 'footer-1, footer-2, footer-3, footer-4, footer-5, footer-6') ?>
		</div>
		<!-- //FOOTER SPOTLIGHT -->
	<?php endif ?>

	<section class="t3-copyright">
		<div class="container">
			<div class="row">
				<div class="<?php echo $this->getParam('t3-rmvlogo', 1) ? 'col-md-8' : 'col-md-12' ?> copyright <?php $this->_c('footer') ?>">
					<jdoc:include type="modules" name="<?php $this->_p('footer') ?>" />
					<!-- <small>
						<a href="http://twitter.github.io/bootstrap/" title="Bootstrap by Twitter" target="_blank">Bootstrap</a> is a front-end framework of Twitter, Inc. Code licensed under <a href="https://github.com/twbs/bootstrap/blob/master/LICENSE" title="MIT License" target="_blank">MIT License.</a>
					</small>
					<small>
						<a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome</a> font licensed under <a href="http://scripts.sil.org/OFL">SIL OFL 1.1</a>.
					</small> -->
					<span style="display: inline-flex; align-items: center; gap: 6px; color: #22543d; font-size: 13px; font-weight: 600; padding: 4px 12px; background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%); border-radius: 20px; border: 1px solid #9ae6b4;">
						<svg style="width: 14px; height: 14px; fill: currentColor;" viewBox="0 0 24 24">
							<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
						</svg>
						Developed by IT Section, UOBS.
					</span>				</div>
				<?php if ($this->getParam('t3-rmvlogo', 1)): ?>
					<!-- <div class="col-md-4 poweredby text-hide">
						<a class="t3-logo t3-logo-color" href="http://t3-framework.org" title="Powered By T3 Framework"
						   target="_blank" <?php echo method_exists('T3', 'isHome') && T3::isHome() ? '' : 'rel="nofollow"' ?>>Powered by <strong>T3 Framework</strong></a>
					</div> -->
				<?php endif; ?>
			</div>
		</div>
	</section>

</footer>
<!-- //FOOTER -->