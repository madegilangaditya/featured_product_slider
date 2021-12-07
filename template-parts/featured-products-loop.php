<?php

$post_id   = get_the_ID();
$merchant  = get_the_terms( $post_id, 'deal_merchant' );
$content   = get_the_content();
$post_link = esc_url( get_permalink() );

?>


    <div class="tc-featured-products-listing__item">
            <a class="tc-featured-products-image" href="<?php echo $post_link; ?>"><div class="tc-featured-products-img" style="<?php  
                if(get_the_post_thumbnail_url( $post_id )){
                    echo 'background-image:url('.get_the_post_thumbnail_url($post_id).');'; 
                } else{
                    echo 'background:#DBDBDB;';
                }
                ?>">
                    <?php //echo get_the_post_thumbnail( $post_id, 'full' ); ?>
                </div>
            </a>
        
            <div class="tc-featured-products-listing-wrapper__content">
                <div class="tc-featured-products-listing__title"><?php the_title(sprintf( '<h2><a href="%s">', $post_link ), '</a></h2>' ); ?></div>
                <div class="tc-featured-products-listing__price-wrap">
                    <span class="tc-featured-regular-price <?php if(get_field( 'tc_cross_price', $post_id )) echo "has-cross-price"; ?>">$<?php echo get_field('tc_deal_price', $post_id); ?></span> 
                    <?php if(get_field( 'tc_cross_price', $post_id )): 
                        echo '<span class="tc-featured-cross-price"><strike>$'. get_field( 'tc_cross_price', $post_id ) .'</strike></span>'; 
                        endif;?>
                </div>
                <div class="tc-featured-products-listing__content-item"><?php echo substr($content,0,180). '...'; ?></div>
                <div class="tc-featured-products-listing__btn-wrap">
                    <a href="<?php echo $post_link; ?>" class="tc-featured-btn"><?php _e( 'Get Deal', 'townscentral' ); ?></a>
                    <div class="tc-featured-merchant-wrap">
                        <?php  
                            if( $merchant ):
                                $term_id = $merchant[0]->term_id;
                                $image   = get_field( 'tc_logo', 'deal_merchant_' . $term_id );
                                if( $image ) echo sprintf( '<img src="%s" alt="%s" />', $image['sizes']['medium'], $image['alt'] );
                            endif;
                        ?>
                    </div>

                </div>
            </div>
    </div>
