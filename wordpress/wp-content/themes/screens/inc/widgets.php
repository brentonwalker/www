<?php
/*********************/
/***********FLICKR**********/
     class screens_flickr_widget extends WP_Widget {
     function screens_flickr_widget() {
     $widget_ops = array( 'description' => __('Flickr gallery','screens') );
     $this->WP_Widget('', 'Screens - Flickr', $widget_ops);
     $this->flick_numbers = array(
            "1" => "1",
            "2" => "2",
            "3" => "3",
            "4" => "4",
            "5" => "5",
            "6" => "6",
            "8" => "8",
            "9" => "9",
            "10" => "10",
        );
     }
     function widget($args, $instance) {
     extract($args, EXTR_SKIP);
      
     $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
     $idflickr = empty($instance['idflickr']) ? ' ' : apply_filters('widget_entry_title', $instance['idflickr']);
     $numberflickr = $instance['numberflickr'];

     echo $before_widget;
     if ( $title ) echo $before_title . $title . $after_title; 
       
     echo '<div id="flickr"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$numberflickr.'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$idflickr.'"></script><div class="clear"></div></div>';
     echo $after_widget;
     }
      
     function update($new_instance, $old_instance) {
     $instance = $old_instance;
     $instance['title'] = strip_tags($new_instance['title']);
     $instance['idflickr'] = strip_tags($new_instance['idflickr']);
     $instance['numberflickr'] = $new_instance['numberflickr'];
      
     return $instance;
     }
      
     function form($instance) {
     $instance = wp_parse_args( (array) $instance, array( 'title' => 'Flickr', 'idflickr' => '', 'numberflickr' => '6' ) );
     $title = strip_tags($instance['title']);
     $idflickr = strip_tags($instance['idflickr']);
     $numberflickr = $instance['numberflickr'];

?>
<p>
	<label for="<?php echo $this -> get_field_id('title');?>"> <?php _e('Title:', 'screens');?><input class="widefat" id="<?php echo $this -> get_field_id('title');?>" name="<?php echo $this -> get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('idflickr');?>">
				<?php	printf(__('"Flickr"- ID. <a href="%s" target="_blank">idgettr.com</a>', 'screens'), sprintf(esc_url(__('http://idgettr.com/', 'screens'))));?>
		
		<input class="widefat" id="<?php echo $this -> get_field_id('idflickr');?>" name="<?php echo $this -> get_field_name('idflickr');?>" type="text" value="<?php echo esc_attr($idflickr);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('numberflickr');?>"><?php _e('Number of photo to display:', 'screens');?></label>
	<select name="<?php echo $this -> get_field_name('numberflickr');?>" id="<?php echo $this -> get_field_id('numberflickr');?>" class="widefat">
		<?php foreach ($this->flick_numbers as $key => $nmb) {
		?>
		<option value="<?php echo $key;?>" <?php
		if($instance['numberflickr'] == $key) { echo " selected ";
		}
		?>><?php echo $nmb;?></option>
		<?php }?>
	</select>
</p>
<?php
}
}
register_widget('screens_flickr_widget');
/***********TWITTER**********/
class screens_twitter_widget extends WP_Widget {
function screens_twitter_widget() {
$widget_ops = array('classname' => 'twitter_bg', 'description' =>
__('A widget to enable people to follow you on Twitter','screens'));
$this->WP_Widget('', 'Screens - Twitter', $widget_ops);
$this->twitt_numbers = array(
"1" => "1",
"2" => "2",
"3" => "3",
"4" => "4",
"5" => "5",
"6" => "6",
);
}

function widget($args, $instance) {
extract($args, EXTR_SKIP);

$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
$twitter = empty($instance['twitter']) ? '' : apply_filters('widget_entry_title', $instance['twitter']);
$numbertwitter = $instance['numbertwitter'];
$follow = empty($instance['follow']) ? '' : apply_filters('widget_entry_title', $instance['follow']);

echo $before_widget;
if (!empty($title)) {echo $before_title . $title . $after_title;   }

echo '<div class="twitterbar"><div id="twitter_div">
<ul id="twitter_update_list"><li>&nbsp;</li></ul>
<div id="twi"></div>
</div>
<span id="twitter-follow"><a id="twitter-link" href="http://twitter.com/'.$twitter.'">'.$follow.'</a></span>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$twitter.'.json?callback=twitterCallback2&amp;count='.$numbertwitter.'"></script>
</div>';

echo $after_widget;
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
$instance['twitter'] = strip_tags($new_instance['twitter']);
$instance['numbertwitter'] = $new_instance['numbertwitter'];
$instance['follow'] = strip_tags($new_instance['follow']);
return $instance;
}

function form($instance) {
$instance = wp_parse_args( (array) $instance, array( 'title' => 'Twitter', 'twitter' => '', 'numbertwitter' => '3', 'follow' => __('follow me on Twitter','screens') ) );
$title = strip_tags($instance['title']);
$twitter = strip_tags($instance['twitter']);
$numbertwitter = $instance['numbertwitter'];
$follow = strip_tags($instance['follow']);
?>
<p>
	<label for="<?php echo $this -> get_field_id('title');?>"> <?php _e('Title:', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('title');?>" name="<?php echo $this -> get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('twitter');?>"><?php _e('User:', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('twitter');?>" name="<?php echo $this -> get_field_name('twitter');?>" type="text" value="<?php echo esc_attr($twitter);?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('follow');?>"><?php _e('Text:', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('follow');?>" name="<?php echo $this -> get_field_name('follow');?>" type="text" value="<?php echo esc_attr($follow);?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('numbertwitter');?>"><?php _e('Number of Tweets to display:', 'screens');?></label>
	<select name="<?php echo $this -> get_field_name('numbertwitter');?>" id="<?php echo $this -> get_field_id('numbertwitter');?>" class="widefat">
		<?php foreach ($this->twitt_numbers as $key => $nmb) {
		?>
		<option value="<?php echo $key;?>" <?php
		if($instance['numbertwitter'] == $key) { echo " selected ";
		}
		?>><?php echo $nmb;?></option>
		<?php }?>
	</select>
</p>
<?php
}
}
register_widget('screens_twitter_widget');
/***********SOCIAL**********/
class screens_social_widget extends WP_Widget {
function screens_social_widget() {
$widget_ops = array( 'description' => __('User profiles', 'screens') );
$this->WP_Widget('screens_social_widget', __('Screens - Social Media Profiles', 'screens'), $widget_ops);
}

function widget($args, $instance) {
extract($args, EXTR_SKIP);
$feed = empty($instance['feed']) ? '' : apply_filters('widget_entry_title', $instance['feed']);
$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
$facebook = empty($instance['facebook']) ? '' : apply_filters('widget_entry_title', $instance['facebook']);
$tube = empty($instance['tube']) ? '' : apply_filters('widget_entry_title', $instance['tube']);
$lastfm = empty($instance['lastfm']) ? '' : apply_filters('widget_entry_title', $instance['lastfm']);
$twitter = empty($instance['twitter']) ? '' : apply_filters('widget_entry_title', $instance['twitter']);
$deviant = empty($instance['deviant']) ? '' : apply_filters('widget_entry_title', $instance['deviant']);
$behance = empty($instance['behance']) ? '' : apply_filters('widget_entry_title', $instance['behance']);
$linkedin = empty($instance['linkedin']) ? '' : apply_filters('widget_entry_title', $instance['linkedin']);
$dribbble = empty($instance['dribbble']) ? '' : apply_filters('widget_entry_title', $instance['dribbble']);
$google = empty($instance['google']) ? '' : apply_filters('widget_entry_title', $instance['google']);

echo $before_widget;
if (!empty($title)) {echo $before_title . $title . $after_title;}

echo '<ul class="s_social">';
if (!empty($feed)) {echo '<li><a title="'.__('Syndicate this site using RSS','screens').'" href="'.esc_url($feed).'">'.__('<abbr title="Really Simple Syndication">RSS</abbr>','screens').'</a></li>';}
if (!empty($facebook)) {  echo '<li class="fb"><a title="'.__('Facebook profile','screens').'" href="'.esc_url($facebook).'">Facebook profile</a></li>'; }
if (!empty($google)) {  echo '<li class="go"><a title="'.__('Google Plus profile','screens').'" href="'.esc_url($google).'">Google Plus profile</a></li>'; }
if (!empty($twitter)) {  echo '<li class="tw"><a title="'.__('Twitter profile','screens').'" href="'.esc_url($twitter).'">Twitter profile</a></li>';  }
if (!empty($tube)) {  echo '<li class="tb"><a title="'.__('YouTube profile','screens').'" href="'.esc_url($tube).'">YouTube profile</a></li>';  }
if (!empty($lastfm)) {  echo '<li class="fm"><a title="'.__('LastFm profile','screens').'" href="'.esc_url($lastfm).'" >Last FM profile</a></li>';  }
if (!empty($deviant)) {  echo '<li class="dv"><a title="'.__('DevianArt profile','screens').'" href="'.esc_url($deviant).'" >DeviantArt profile</a></li>';  }
if (!empty($behance)) {  echo '<li class="be"><a title="'.__('Behance profile','screens').'" href="'.esc_url($behance).'" >Behance profile</a></li>';  }
if (!empty($linkedin)) {  echo '<li class="li"><a title="'.__('Linkedin profile','screens').'" href="'.esc_url($dribbble).'" >Linkedin profile</a></li>';  }
if (!empty($dribbble)) {  echo '<li class="dr"><a title="'.__('Dribbble profile','screens').'" href="'.esc_url($dribbble).'" >Dribbble profile</a></li>';  }
echo '</ul><div class="clear"></div>';

echo $after_widget;
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['feed'] = strip_tags($new_instance['feed']);
$instance['title'] = strip_tags($new_instance['title']);
$instance['facebook'] = strip_tags($new_instance['facebook']);
$instance['google'] = strip_tags($new_instance['google']);
$instance['tube'] = strip_tags($new_instance['tube']);
$instance['lastfm'] = strip_tags($new_instance['lastfm']);
$instance['twitter'] = strip_tags($new_instance['twitter']);
$instance['deviant'] = strip_tags($new_instance['deviant']);
$instance['behance'] = strip_tags($new_instance['behance']);
$instance['linkedin'] = strip_tags($new_instance['linkedin']);
$instance['dribbble'] = strip_tags($new_instance['dribbble']);

return $instance;
}

function form($instance) {
$instance = wp_parse_args( (array) $instance, array( 'feed' => '', 'title' => '', 'deviant' => '',
'facebook' => '','twitter' => '','google' => '', 'tube' => '', 'lastfm' => '', 'behance' =>'','dribbble' =>'' ) );
$feed = strip_tags($instance['feed']);
$title = strip_tags($instance['title']);
$facebook = strip_tags($instance['facebook']);
$google = strip_tags($instance['google']);
$tube = strip_tags($instance['tube']);
$lastfm = strip_tags($instance['lastfm']);
$twitter = strip_tags($instance['twitter']);
$deviant = strip_tags($instance['deviant']);
$behance = strip_tags($instance['behance']);
$linkedin = strip_tags($instance['linkedin']);
$dribbble = strip_tags($instance['dribbble']);
?>
<p>
	<label for="<?php echo $this -> get_field_id('title');?>"> <?php _e('Title', 'screens');?><input class="widefat" id="<?php echo $this -> get_field_id('title');?>" name="<?php echo $this -> get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('feed');?>"> <?php _e('Enter feed url,
e.g. http://feedburner.com/userid', 'screens');?>
		<input   class="widefat" id="<?php echo $this -> get_field_id('feed');?>" name="<?php echo $this -> get_field_name('feed');?>" type="text" value="<?php echo esc_attr($feed);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('facebook');?>"> <?php _e('Enter <strong>Facebook</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('facebook');?>" name="<?php echo $this -> get_field_name('facebook');?>" type="text" value="<?php echo esc_attr($facebook);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('google');?>"> <?php _e('Enter <strong>Google Plus</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('google');?>" name="<?php echo $this -> get_field_name('google');?>" type="text" value="<?php echo esc_attr($google);?>" /></label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('twitter');?>"><?php _e('Enter <strong>Twitter</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('twitter');?>" name="<?php echo $this -> get_field_name('twitter');?>" type="text" value="<?php echo esc_attr($twitter);?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('tube');?>"><?php _e('Enter <strong>YouTube</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('tube');?>" name="<?php echo $this -> get_field_name('tube');?>" type="text" value="<?php echo esc_attr($tube);?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('lastfm');?>"><?php _e('Enter <strong>LastFM</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('lastfm');?>" name="<?php echo $this -> get_field_name('lastfm');?>" type="text" value="<?php echo esc_attr($lastfm);?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this -> get_field_id('deviant');?>"><?php _e('Enter <strong>DeviantArt</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('deviant');?>" name="<?php echo $this -> get_field_name('deviant');?>" type="text" value="<?php echo esc_attr($deviant);?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('behance');?>"><?php _e('Enter <strong>Behance</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('behance');?>" name="<?php echo $this -> get_field_name('behance');?>" type="text" value="<?php echo esc_attr($behance);?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('linkedin');?>"><?php _e('Enter <strong>Linkedin</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('linkedin');?>" name="<?php echo $this -> get_field_name('linkedin');?>" type="text" value="<?php echo esc_attr($linkedin);?>" />
	</label>
</p>
<p>
	<label for="<?php echo $this -> get_field_id('dribbble');?>"><?php _e('Enter <strong>Dribbble</strong>  account url', 'screens');?>
		<input class="widefat" id="<?php echo $this -> get_field_id('dribbble');?>" name="<?php echo $this -> get_field_name('dribbble');?>" type="text" value="<?php echo esc_attr($dribbble);?>" />
	</label>
</p>
<?php
}
}
register_widget('screens_social_widget');
?>
