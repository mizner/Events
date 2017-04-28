<?php
/**
 * Archive People Fallback Template
 *
 * @package mkdo\ted_hughes_core
 */

$prefix = 'people_';

get_header(); ?>

    <div class="container">
        <div class="people">
			<?php while ( have_posts() ) : the_post();
				$email_url    = get_post_meta( get_the_ID(), $prefix . 'email_url', true );
				$phone_number = get_post_meta( get_the_ID(), $prefix . 'phone_number', true );
				$facebook_url = get_post_meta( get_the_ID(), $prefix . 'facebook_url', true );
				$twitter_url  = get_post_meta( get_the_ID(), $prefix . 'twitter_url', true );
				?>
                <section class="people-single">
                    <header>
                        <a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
                        </a>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                        </a>
                    </header>
                    <article>
                        <a href="<?php echo esc_attr( $email_url ) ?>"><?php esc_html_e( 'Email', 'ted-hughes' ); ?></a>
                        <a href="<?php echo esc_attr( $phone_number ) ?>"><?php esc_html_e( 'Phone', 'ted-hughes' ); ?></a>
                        <a href="<?php echo esc_attr( $facebook_url ) ?>"><?php esc_html_e( 'Facebook', 'ted-hughes' ); ?></a>
                        <a href="<?php echo esc_attr( $twitter_url ) ?>"><?php esc_html_e( 'Twitter', 'ted-hughes' ); ?></a>
                    </article>
                </section>
			<?php endwhile; ?>
        </div>
    </div>

<?php get_footer();
