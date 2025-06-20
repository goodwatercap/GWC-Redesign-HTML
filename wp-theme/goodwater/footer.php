<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goodwater
 */
 $footnote = "";
?>
<?php if( array_key_exists('footnote', $args )){
    $footnote = $args['footnote'];
}?>
    <dialog id="korea-warning">
        <h3>사칭 범죄 유의 안내</h3>
        <p>최근 당사(굿워터캐피탈)의 명칭, 로고, 소속 직원 등을 무단 도용한 사칭 범죄가 다수 발생하고 있습니다. 특히 투자 관련 리딩방 개설, 미끼용 웹사이트 접속 유도 또는 악성 앱 설치 등을 통해 투자금을 편취하는 사례가 확인되고 있으므로, 각별히 주의하여 주시기 바랍니다.</p>
        <p>당사는 개인 명의 이메일, 문자메시지, SNS(텔레그램 등)를 통한 투자 권유, 불특정 다수 대상의 투자 리딩방 개설 및 초대, 외부 사이트나 앱 설치를 통한 투자 유도를 하지 않고 있으며, 위와 같은 사칭 범죄는 당사와 무관함을 알려드립니다.</p>
        <p>만약 위와 같이 사칭이 의심되는 메시지나 링크를 수신하신 경우, 개인정보 및 금전피해를 방지하기 위해 절대 클릭하지 마시고, 당사(info@goodwatercap.com) 또는 경찰(112)로 신고 후 삭제해 주시기 바랍니다:</p>
        <div>
            <button class="l-btn l-btn--dark" type="submit" id="korea-warning-button">확인</button>
        </div>
    </dialog>
    <script>
      (function () {
        if (navigator.language.startsWith('ko') && !localStorage.getItem('korea-warning-acked')) {
          const dialog = document.getElementById("korea-warning");
          const dialogClose = document.getElementById("korea-warning-button");

          dialog.showModal();
          dialogClose.addEventListener("click", () => {
            localStorage.setItem('korea-warning-acked', "true");
            dialog.close();
          });
        }
      })();
    </script>
	<footer class="gwc footer">
        <div class="container container--lg">
            <?php echo $footnote; ?>
          	<div class="footer__brand">
            	<div class="footer__logo">
            		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Logo"><?php echo get_image(array('imgid'=>get_theme_mod('custom_logo'))); ?> </a>
            	</div>
            	<div class="footer__text">
            		<?php if( get_field('normal_text', 'option') && get_field('italic_text', 'option') ):?>
              			<h2><?php echo esc_html(get_field('normal_text', 'option'));?> <i><?php echo esc_html(get_field('italic_text', 'option'));?> </i></h2>
              		<?php endif;
              		if( have_rows('social_media_items', 'option') ):?>
	              		<ul class="is--mobile"> 
	              			<?php while( have_rows('social_media_items', 'option') ) : the_row();
	                            $link = get_sub_field('link');
	                            if( $link ):?>
	                            	<li><a href="<?php echo esc_url( $link['url'] );?>" title="<?php echo $link['title'];?>" target="<?php echo $link['target'];?>"> <?php echo get_image(array('url'=>get_sub_field('icon'))); ?></a></li>
	                            <?php endif;
                            endwhile;?>
	              		</ul>
	              	<?php endif;?>
            	</div>
          	</div>
          	<div class="footer__nav is--desktop">
            	<div class="footer__col">
              		<div class="footer__subcol"> 
              			<!-- <?php //if( get_field('login_button', 'option') ):
		              	//$login = get_field('login_button', 'option');?>
              				<a class="l-btn l-btn--blue" href="<?php //echo $login['url'];?>" title="<?php //echo $login['title'];?>" target="<?php //echo $login['target'];?>"><?php //echo $login['title'];?><i> <svg width="11" height="11" viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.21047 1.17139H9.41407M9.41407 1.17139L9.17486 9.3715M9.41407 1.17139L0.500392 9.82837" stroke="white" stroke-width="1.25"></path></svg></i></a>
              			<?php //endif;?> -->
                		<div class="footer__contact"> 
                  			<?php if( have_rows('address_rows', 'option') ):
                  				if( get_field('contact_heading', 'option') ):?>
                  					<h3><?php echo esc_html( get_field('contact_heading', 'option') );?></h3>
                  				<?php endif;?>
	                  			<ul> 
	                  				<?php while( have_rows('address_rows', 'option') ) : the_row();?>
				                    	<li><p><?php echo esc_html( get_sub_field('address') );?></p></li>
				                    <?php endwhile;?>
				          		</ul>
				          	<?php endif;?>	
			          		<ul>
			                    <?php if( get_field('email_id', 'option') ):?>
			                    	<li> <a href="mailto:<?php echo sanitize_email( get_field('email_id', 'option') );?>" title="mail"><?php echo esc_html( get_field('email_id', 'option') );?></a></li>
			                    <?php endif;?>
                  			</ul>
                		</div>
              		</div>
              		<div class="footer__subcol">
                		<div class="footer__careers"> 
                  			<?php if( get_field('careers_heading', 'option') ):?>
                  				<h3><?php echo esc_html( get_field('careers_heading', 'option') );?></h3>
                  			<?php endif;?>
                  			<!-- Career Menu -->
                  			<?php get_template_part('template-parts/menu/career');?>
                		</div>
                        <div class="footer__thesis">
                            <?php if( get_field('thesis_heading', 'option') ):?>
                                <h3><?php echo esc_html( get_field('thesis_heading', 'option') );?></h3>
                            <?php endif;?>
                            <!-- Thesis Menu -->
                            <?php get_template_part('template-parts/menu/thesis');?>
                        </div>
                		<!-- <div class="footer__resources"> -->
                  			<?php //if( get_field('resources_heading', 'option') ):?>
	                      		<!-- <h3><?php //echo esc_html( get_field('resources_heading', 'option') );?></h3> -->
	                      	<?php //endif;?>
	                      	<!-- Resources Menu -->
	                      	<?php //get_template_part('template-parts/menu/resources');?>
                		<!-- </div> -->
                		<?php if( have_rows('social_media_items', 'option') ):?>
	                		<div class="footer__social"> 
	                  			<?php if( get_field('social_heading', 'option') ):?>
                  					<h3><?php echo esc_html( get_field('social_heading', 'option') );?></h3>
                  				<?php endif;?>
	                  			<ul> 
				                    <?php while( have_rows('social_media_items', 'option') ) : the_row();
                                		$link = get_sub_field('link');
                                		if( $link ):?>
					                      	<li><a href="<?php echo esc_url( $link['url'] );?>" title="<?php echo $link['title'];?>" target="<?php echo $link['target'];?>"> <?php echo get_image(array('url'=>get_sub_field('icon'))); ?></a></li>
				                      	<?php endif;
                            		endwhile;?>
	                  			</ul>
	                		</div>
	                	<?php endif;?>
              		</div>
            	</div>
	            <div class="footer__col">
	              	<div class="footer__thumb"><?php echo get_image(array('imgid'=> 82)); ?></div>
	            </div>
       	 	</div>
	        <div class="footer__bottom"> 
	            <div class="footer__copyright"> 
	              	<?php echo apply_filters('the_content',get_field('copyright','option')); ?>
	            </div>
	            <div class="footer__menu"> 
	              	<?php 
					    wp_nav_menu( 
					        array( 
					            'theme_location' => 'legal', 
					            'container' => 'ul'
					        )
					    ); 
					?>
	            </div>
	        </div>
    	</div>
	</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>