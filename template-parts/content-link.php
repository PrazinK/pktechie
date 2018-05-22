<?php

/*
	
@package pktechietheme
-- Link Post Format

*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pktechie-format-link' ); ?>>
	
	<header class="entry-header text-center">
		
		<?php 
			$link = pktechie_grab_url();
			the_title( '<h1 class="entry-title"><a href="' . $link . '" target="_blank">', '<div class="link-icon"><span class="pktechie-icon pktechie-link"></span></div></a></h1>'); 
		?>
		
	</header>

</article>