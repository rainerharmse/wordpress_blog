<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Rainer Harmse</title>
		<?php wp_head(); ?>
<!--        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>-->
	</head>
	
	<?php 
		
		if( is_front_page() ):
			$awesome_classes = array( 'awesome-class', 'my-class' );
		else:
			$awesome_classes = array( 'no-awesome-class' );
		endif;

	?>
	
	<body <?php body_class( $awesome_classes ); ?>>

        <div class="page">

		    <div class="container">
                <div id="nav-bar">
<!--                    <a class="logo" href="http://rainerharmse.com">-->
<!--                        <div>-->
<!--                            <p>Rainer</p>-->
<!--                            <img src="" alt="">-->
<!--                        </div>-->
<!--                    </a>-->
                    <nav class="en desktop">
                        <?php $base_url =  "http://" . $_SERVER['SERVER_NAME'] . "/";?>

                        <a rel="index" href="<?php echo $base_url ?>/wordpress-test" class="home-link active">
                            <i class="fas fa-home"></i>
                        </a>
                        <a rel="about" href="<?php echo $base_url ?>wordpress-test/about" class="">
                            <i class="fas fa-child"></i>
                        </a>
                        <a rel="skills" href="<?php echo $base_url ?>wordpress-test/skills" class="">
                            <i class="fas fa-laptop"></i>
                        </a>
                        <a rel="blog" href="<?php echo $base_url ?>wordpress-test/blog" class="">
                            <i class="fas fa-book-open"></i>
                        </a>
                        <a rel="contact" href="<?php echo $base_url ?>wordpress-test/contact" class="">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </nav>
                    <div class="social-icons">
                        <ul>
                            <li>
                                <a href="https://twitter.com/JeznachJacek" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://pl.linkedin.com/pub/jacek-jeznach/40/9b6/a9" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/pages/JJ-Front-End-Web-Developer/1065969103428564" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://jacekjeznach.com/feed/" target="_blank">
                                    <i class="fa fa-rss"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mobile-burger">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="mobile-navigation-container">
                        <nav class="en mobile">
                            <a rel="index" href="https://jacekjeznach.com/" class="home-link active">
                                <i class="fas fa-home"></i>
                            </a>
                            <a rel="about" href="https://jacekjeznach.com/about/" class="">
                                <i class="fas fa-child"></i>
                            </a>
                            <a rel="skills" href="https://jacekjeznach.com/skills/" class="">
                                <i class="fas fa-laptop"></i>
                            </a>
                            <a rel="gallery" href="https://jacekjeznach.com/portfolio/" class="">
                                <i class="icon-eye"></i>
                            </a>
                            <a rel="contact" href="https://jacekjeznach.com/contact/" class="">
                                <i class="icon-mail"></i>
                            </a>
                        </nav>
                    </div>
                </div>



