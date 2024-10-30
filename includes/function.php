<?php

function lpaccordian_active()
{
	
$lpa_postlimit = get_option('lpa_postlimit');
$speed=get_option('lpa_speed');
$width=get_option('lpa_width');
$height=get_option('lpa_height');
if(get_option('lpa_autocollapse')==1){$autocollapse="true";}else{$autocollapse="false";}
$content_length=get_option('lpa_content_length');;

?>
<script type="text/javascript">
        $(window).load(function () {
            $('#accordion-wrapper').lpaccordion({
                speed:<?php echo $speed; ?>,
                sliderWidth:<?php echo $width; ?>,
                sliderHeight:<?php echo $height; ?>,
                autoCollapse:<?php echo $autocollapse; ?>
            });

        }); 
</script>

<div id="accordion-wrapper">
  <?php
 $loop = new WP_Query(array('posts_per_page' => $lpa_postlimit, 'orderby'=> 'date','order'=>'DESC'));
?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <div class="slide">
    <?php $url = get_post_meta($post->ID, "url", true);
          if($url!='') {

            echo '<a href="'.$url.'">';

            echo the_post_thumbnail('full');

            echo '</a>';

          } else {
            echo the_post_thumbnail('full');
          } ?>
    <div class="caption"> <a href="<?php the_permalink(); ?>">
      <h1>
        <?php the_title(); ?>
      </h1>
      </a>
      <p>
        <?php $exp=get_the_excerpt();
		echo(substr($exp,$content_length));
		?>
      </p>
    </div>
  </div>
  <?php endwhile; ?>
  <?php wp_reset_query(); ?>
</div>
<?php } ?>
