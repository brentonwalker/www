<?php
global $themename;
global $shortname;
/********************************************
Follow Us and Contact WIDGET START
*********************************************/
class ThdFollowContactWidget extends WP_Widget {
    /** constructor */
    function ThdFollowContactWidget() {
		global $themename;
		$widget_ops = array('classname' => 'thdFollowContact', 'description' => __('Sketch Themes widget for Follow Us and Contact Info - bizstudio footer','bizstudio') );
		$this->WP_Widget('thdFollowcontactwidget',__('Follow Us and Contact Info -','bizstudio'). $themename ,$widget_ops);	
    }
    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		$title = esc_attr($instance['title']);
		if(empty($title))
		{
			$title=__('Get in Touch','bizstudio');
		}				
		$contact_phone = esc_attr($instance['contact_phone']);
		$contact_mail = esc_attr($instance['contact_mail']);
		$contact_address = esc_attr($instance['contact_address']);
		$contact_extra_info = esc_attr($instance['contact_extra_info']);
		$follow_linkedin = esc_attr($instance['follow_linkedin']);
		$follow_facebook = esc_attr($instance['follow_facebook']);
		$follow_twitter = esc_attr($instance['follow_twitter']);
		$follow_flickr = esc_attr($instance['follow_flickr']);
        ?>
        <?php echo $before_widget; ?>
		<?php 
        if($title)
        echo $before_title . $title . $after_title; 
        ?>
        <div class="follow-icons">
		<ul class="social clearfix"> 
		<?php if($follow_linkedin){ ?> <li> <a href="<?php echo $follow_linkedin;?>" style="background:url('<?php echo get_template_directory_uri();?>/images/linkdin_foot.png')"></a></li> <?php } ?>
		<?php if($follow_facebook){ ?> <li> <a href="<?php echo $follow_facebook;?>" style="background:url('<?php echo get_template_directory_uri();?>/images/facebook_foot.png')"></a></li> <?php } ?>
		<?php if($follow_twitter){ ?> <li> <a href="<?php echo $follow_twitter;?>" style="background:url('<?php echo get_template_directory_uri();?>/images/twitter_foot.png')"></a></li> <?php } ?>
		<?php if($follow_flickr){ ?> <li> <a href="<?php echo $follow_flickr;?>" style="background:url('<?php echo get_template_directory_uri();?>/images/flicker_foot.png')"></a></li> <?php } ?>
		 </ul>
        <div class="clear"></div>
        </div>
        <div class="contact-widget">
		<ul class="contact-info clearfix">
		<li> <img src="<?php echo get_template_directory_uri();?>/images/conatact-icon.png"/><?php echo $contact_phone;?></li>
        <li> <img src="<?php echo get_template_directory_uri();?>/images/mail-icon.png"/><?php echo $contact_mail;?></li>
        <li> <img src="<?php echo get_template_directory_uri();?>/images/address-icon.png"/><?php echo $contact_address;?></li>
		<li> <?php echo $contact_extra_info;?></li>
       </ul>
        <div class="clear"></div>
        </div>
        
        <?php echo $after_widget; ?>
        <?php
    }
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['contact_phone'] = strip_tags($new_instance['contact_phone']);
	$instance['contact_mail'] = strip_tags($new_instance['contact_mail']);
	$instance['contact_address'] = strip_tags($new_instance['contact_address']);
	$instance['contact_extra_info'] = strip_tags($new_instance['contact_extra_info']);
	$instance['follow_linkedin'] = strip_tags($new_instance['follow_linkedin']);
	$instance['follow_facebook'] = strip_tags($new_instance['follow_facebook']);
	$instance['follow_twitter'] = strip_tags($new_instance['follow_twitter']);
	$instance['follow_flickr'] = strip_tags($new_instance['follow_flickr']);
        return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {
      if(isset($instance['title'])){
		$title = esc_attr($instance['title']);				
	}
     if(isset($instance['contact_phone'])){
		$contact_phone = esc_attr($instance['contact_phone']);
	}
       if(isset($instance['contact_mail'])){
		$contact_mail = esc_attr($instance['contact_mail']);
	  }
       if(isset($instance['contact_address'])){
		$contact_address = esc_attr($instance['contact_address']);
	  }
     if(isset($instance['contact_extra_info'])){
		$contact_extra_info = esc_attr($instance['contact_extra_info']);
	}
     if(isset($instance['follow_linkedin'])){
			$follow_linkedin = esc_attr($instance['follow_linkedin']);
        }
	 if(isset($instance['follow_facebook'])){
		$follow_facebook = esc_attr($instance['follow_facebook']);
     }
	 if(isset($instance['follow_twitter'])){
		$follow_twitter = esc_attr($instance['follow_twitter']);
    }
	 if(isset($instance['follow_flickr'])){
		$follow_flickr = esc_attr($instance['follow_flickr']);
      }
        ?>
         <p>
         <label for="<?php echo $this->get_field_id('title'); ?>">
		 <?php _e('Title:','bizstudio'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title','bizstudio'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)){ echo $title; } ?>" />
         </label></p>
         <p>
         <label for="<?php echo $this->get_field_id('contact_phone'); ?>"><?php _e('Contact Number','bizstudio'); ?> <input class="widefat" id="<?php echo $this->get_field_id('contact_phone'); ?>" name="<?php echo $this->get_field_name('contact_phone');?>" type="text" value="<?php if(isset($contact_phone)){ echo $contact_phone; }?>" /></label>
         </p>
         <p>
         <label for="<?php echo $this->get_field_id('contact_mail'); ?>"><?php _e('Contact Email','bizstudio'); ?> <input class="widefat" id="<?php echo $this->get_field_id('contact_mail'); ?>" name="<?php echo $this->get_field_name('contact_mail'); ?>" type="text" value="<?php if(isset($contact_mail)){ echo $contact_mail; }?>" /></label>
         </p>
         <p>
         <label for="<?php echo $this->get_field_id('contact_address'); ?>"><?php _e('Contact Address','bizstudio'); ?> <textarea class="widefat" id="<?php echo $this->get_field_id('contact_address'); ?>" name="<?php echo $this->get_field_name('contact_address'); ?>" type="text"><?php if(isset($contact_address)){ echo nl2br($contact_address); }?></textarea></label>
         </p>
         <p>
         <label for="<?php echo $this->get_field_id('contact_extra_info'); ?>"><?php _e('Contact Extra Info','bizstudio'); ?> <textarea class="widefat" id="<?php echo $this->get_field_id('contact_extra_info'); ?>" name="<?php echo $this->get_field_name('contact_extra_info'); ?>" type="text"><?php if(isset($contact_extra_info)){ echo $contact_extra_info;}?></textarea></label>
         </p>
         <p>
         <label for="<?php echo $this->get_field_id('follow_linkedin'); ?>"><?php _e('Link for Linkedin','bizstudio'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_linkedin'); ?>" name="<?php echo $this->get_field_name('follow_linkedin'); ?>" type="text" value="<?php if(isset($follow_linkedin)){ echo $follow_linkedin; }?>" /></label>
         </p>
         <p>
         <label for="<?php echo $this->get_field_id('follow_facebook'); ?>"><?php _e('Link for Facebook','bizstudio'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_facebook'); ?>" name="<?php echo $this->get_field_name('follow_facebook'); ?>" type="text" value="<?php if(isset($follow_facebook)){ echo $follow_facebook; }?>" /></label>
         </p>
         <p>
         <label for="<?php echo $this->get_field_id('follow_twitter'); ?>"><?php _e('Link for Twitter','bizstudio'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_twitter'); ?>" name="<?php echo $this->get_field_name('follow_twitter'); ?>" type="text" value="<?php if(isset($follow_twitter)){ echo $follow_twitter; }?>" /></label>
         </p>
         <p>
         <label for="<?php echo $this->get_field_id('follow_flickr'); ?>"><?php _e('Link for Flickr','bizstudio'); ?> <input class="widefat" id="<?php echo $this->get_field_id('follow_flickr'); ?>" name="<?php echo $this->get_field_name('follow_flickr'); ?>" type="text" value="<?php if(isset($follow_flickr)){ echo $follow_flickr; }?>" /></label>
         </p>
        <?php 
    }
}
add_action('widgets_init', create_function('', 'return register_widget("ThdFollowContactWidget");'));
/********************************************
Follow us and contact WIDGET END
*********************************************/
