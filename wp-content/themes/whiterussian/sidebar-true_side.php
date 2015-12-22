<!-- t: sidebar-true_side  -->
		<div class="b-sidebar">
			
			<h2 class="h2">Новостной центр</h2>

			<ul class="b-side-news__list">
			<?php $sticky = get_option('sticky_posts');$recent = new WP_Query(array( 'post__in' => $sticky,'post_type'=>'post','category_name' => 'news','posts_per_page' => 3)); while($recent->have_posts()) : $recent->the_post();?>
				<li class="b-side-news__item">					
				<?php if ( has_post_thumbnail()) { ?>
				   <div class="b-side-news__item-img-wrapper"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('medium'); ?></a>
				   </div>
				<?php } ?>
					<time class="b-side-news__item-date"><?php echo get_the_date(); ?></time>
					<a href="<?php the_permalink() ?>"  class="b-side-news__item-title"><?php the_title(); ?></a>
					<div class="b-side-news__item-text"><?php the_excerpt(); ?></div>
				</li>
				<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			<?php $recent = new WP_Query(array( 'post__not_in' => $sticky,'post_type'=>'post','category_name' => 'news','posts_per_page' => 3)); while($recent->have_posts()) : $recent->the_post();?>
				<li class="b-side-news__item">					
				<?php if ( has_post_thumbnail()) { ?>
				   <div class="b-side-news__item-img-wrapper" style="width:auto; height:100%;max-width:220px;max-height:136px;"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('medium'); ?></a>
				   </div>
				<?php } ?>
					<time class="b-side-news__item-date"><?php echo get_the_date(); ?></time>
					<a href="<?php the_permalink() ?>"  class="b-side-news__item-title"><?php the_title(); ?></a>
					<div class="b-side-news__item-text"><?php the_excerpt(); ?></div>
				</li>
				<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			</ul>
			
			<div class="b-side-news__goto-all-wrapper">
				<a href="/category/news/" class="b-side-news__goto-all-link">Смотреть все</a>
			</div>

		</div>
		</div>