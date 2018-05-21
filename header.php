<?php 
	
	/*
		This is the template for the hedaer
		
		@package pktechietheme
	*/
	
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo( 'name' ); wp_title(); ?></title>
        <meta name="description" content="<?php bloginfo( 'description' ); ?>" >
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        
        <!--
            Ping Back
            -->
        <?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>

        <?php wp_head(); ?>
		

		
	</head>

<body <?php body_class(); ?>>
    <div class="container-fluid">
            
        <div class="row">
            <header class="header-container background-image text-center" style="background: #f1ede4;">
                <div class="header-content table">
                    <div class="table-cell">
                        <h1 class="site-title pktechie-icon">
                            <img src="http://prazin.com/wp-content/uploads/2018/05/logo.svg" width="100" alt="pktechie" />
                            <span class="hide"><?php bloginfo( 'name' ); ?></span>
                        </h1>
                        <h2 class="site-description">
                            <?php bloginfo( 'description' ); ?>
                        </h2>
                    </div><!-- .table-cell -->
                </div><!-- .header content -->
                <div class="nav-container">
                    <nav class="navbar navbar-deafult navbar-pktechie">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'nav navbar-nav',
                                'walker' => new pktechie_Walker_Nav_Primary()
                            ) );	
                        ?>
                    </nav>
                </div><!-- .nav container -->
            </header>
        </div><!-- .row -->
            
    </div><!-- .container-fluid -->


	
	
	
	
	
	
	
	
	
	
	
	