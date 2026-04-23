<?php if // This hides nav element on the PPC page template.
      ( !is_page_template( 'page-ppc.php' ) ): ?> 
      
      <nav id="site-navigation" class="main-navigation meganav " aria-label="site naviation">

            <?php if ( have_rows( 'mega_navigation', 'option' ) ) : ?>
                  <ul class="main-navigation">
                        <?php while ( have_rows( 'mega_navigation', 'option' ) ) : the_row(); ?>

                              <?php if ( get_sub_field('sub_nav') ) : ?>
                                    <?php $hasSubNav = 'has-subnav'; ?>
                              <?php else : ?>
                                    <?php $hasSubNav = 'no-subnav'; ?>
                              <?php endif ; ?>

                              <li class="top-nav-links  <?php echo $hasSubNav;?>">

                                    <?php $top_level_links = get_sub_field( 'top_level_links' ); ?>
                                    <?php if ( $top_level_links ) : ?>
                                          <a href="<?php echo esc_url( $top_level_links['url'] ); ?>" target="<?php echo esc_attr( $top_level_links['target'] ); ?>"><?php echo esc_html( $top_level_links['title'] ); ?></a>
                                    <?php endif; ?>


                                    <?php if ( have_rows( 'sub_nav' ) ) : ?>
                                          <div class="subnav-wrapper ">
                                                <div class="sn-inner">
                                                      <ul class="subnav ">
                                                            <?php while ( have_rows( 'sub_nav' ) ) : the_row(); ?>

                                          
                                                                  <?php $subnav_links = get_sub_field( 'subnav_links' ); ?>
                                                                  <?php if ( $subnav_links ) : ?>
                                                                  
                                                                        <li class="subnav-links">
                                                                        
                                                                              <a class="subnav-top-link" href="<?php echo esc_url( $subnav_links['url'] ); ?>" target="<?php echo esc_attr( $subnav_links['target'] ); ?>">
                                                                                    <?php echo esc_html( $subnav_links['title'] ); ?>
                                                                              </a>
                                                                              
                                                                              
                                                                              <?php if ( have_rows( 'sub_nav_2' ) ) : // Subnav Tier 2 ?>
                                                                                    <ul class="subnav-2">
                                                                                    <?php while ( have_rows( 'sub_nav_2' ) ) : the_row(); ?>
                                                                                          <li> 
                                                                                           
                                                                                                <?php $sub_nav_icon = get_sub_field( 'sub_nav_font_icon' ); ?>
                                                                                             
                                                                                                <?php if ( $sub_nav_icon ) : ?>
                                                                                                      <i class="<?php echo $sub_nav_icon; ?> subnav-icon"></i>
                                                                                                <?php endif; ?>

                                                                                                <?php $sub_nav_2_link = get_sub_field( 'sub_nav_2_link' ); ?>
                                                                                                <a href="<?php echo esc_url( $sub_nav_2_link['url'] ); ?>" target="<?php echo esc_attr( $sub_nav_2_link['target'] ); ?>"><?php echo esc_html( $sub_nav_2_link['title'] ); ?></a>
                                                                                          </li>
                                                                                    <?php endwhile; ?>
                                                                                    </ul>
                                                                              <?php endif; ?>
                                                                        </li>
                                                                  <?php endif; ?>
                                                                              
                                                            <?php endwhile; ?>

                                                      </ul>  
                                                      
                                                      <?php if ( get_sub_field( 'option' ) === 'link-block' ) : // Subnav Block Options?>


                                                            <?php if ( have_rows( 'block_links' ) ) : ?>
                                                                  <div class="sn-block-wrapper">
                                                                        <?php while ( have_rows( 'block_links' ) ) : the_row(); ?>

                                                                              <?php $blockStyle = get_sub_field( 'block_style' );
                                                                              if ( $blockStyle == 'block-style--image' ) : ?>

                                                                                    <?php $block_link_cta = get_sub_field( 'block_link_cta' ); ?>
                                                                                    
                                                                                    <div class="sn-block-link ">
                                                                                          <?php $block_link_image = get_sub_field( 'block_link_image' ); ?>
                                                                                          <?php $size = 'medium'; ?>
                                                                                          <?php if ( $block_link_image ) : ?>
                                                                                                <picture>
                                                                                                      <?php echo wp_get_attachment_image( $block_link_image, $size ); ?>
                                                                                                      <div class="overlay--dark"></div>
                                                                                                </picture>
                                                                                          <?php endif; ?>
                                                                                          
                                                                                          <a href="<?php echo esc_url( $block_link_cta['url'] ); ?>" target="<?php echo esc_attr( $block_link_cta['target'] ); ?>">
                                                                                                <p class="title"><?php the_sub_field( 'block_link_title' ); ?></p>
                                                                                                <button class="btn btn--text btn--text-light"><span><?php echo esc_html( $block_link_cta['title'] ); ?></span></button>
                                                                                          </a>
                                                                                          
                                                                                    </div>
                                                                                    
                                                                              <?php else : ?>

                                                                                    <?php $block_link_cta = get_sub_field( 'block_link_cta' ); ?>
                                                                                    
                                                                                    <div class="sn-block-link sn-block-link-icon">
                                                                                          <?php $block_link_icon = get_sub_field( 'block_link_icon' ); ?>
                                                                                          
                                                                                          <a href="<?php echo esc_url( $block_link_cta['url'] ); ?>" target="<?php echo esc_attr( $block_link_cta['target'] ); ?>">
                                                                                                <i class="<?php echo $block_link_icon; ?> subnav-icon"></i>

                                                                                                <p class="title"><?php the_sub_field( 'block_link_title' ); ?></p>
                                                                                                <button class="btn btn--text btn--text-primary"><span><?php echo esc_html( $block_link_cta['title'] ); ?></span></button>
                                                                                          </a>
                                                                                          
                                                                                    </div>

                                                                                    
                                                                              <?php endif ; ?>
                                                                              
                                                                        <?php endwhile; ?>
                                                                  </div>
                                                
                                                            <?php endif; ?>

                                                
                                                            
                                                      <?php endif ; ?>

                                                      
                                                </div>

                                          </div>

                                    
                                    <?php endif; ?>

                              </li> 

                        <?php endwhile; ?>
                  </ul> <!-- ul.main navigation -->
            <?php endif; ?>



      </nav><!-- END #site-navigation -->


<?php endif;?>