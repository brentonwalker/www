<?php $theme = basename( get_template_directory() ); ?>
<?php
printf(
	__( "<a href='%s'>Contact</a> SiteOrigin support if you need help. ", 'siteorigin' ),
	'http://siteorigin.com/#support'
);
printf(
	__( "If you like %s, please <a href='%s' target='_blank'>rate it</a>. Your rating helps a lot! ", 'siteorigin' ),
	ucfirst($theme),
	'http://wordpress.org/support/view/theme-reviews/'.$theme
);
?>

<div class="social">
	<div class="follow twitter">
		<iframe allowtransparency="true" frameborder="0" scrolling="no" src="https://platform.twitter.com/widgets/follow_button.html?screen_name=siteorigin&show_count=false&show_screen_name=true" style="width:122px; height:20px;"></iframe>
	</div>

	<div class="follow facebook">
		<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2FSiteOrigin&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=222225781217824" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
	</div>
</div>