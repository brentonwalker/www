<?php

function focus_premium_upgrade_content($content){
	$content['premium_title'] = __('Upgrade To Focus Premium', 'focus');
	$content['premium_summary'] = __("If you've enjoyed using Focus, you'll going to love Focus Premium. It's a robust upgrade to Focus that gives you loads of cool features and support. For just a few dollars, it's a cost effective way to give your site a professional edge.", 'focus');

	$content['buy_url'] = 'http://siteorigin.fetchapp.com/sell/tghofooh';
	$content['buy_price'] = '$14';
	$content['buy_message_1'] = __("If you're not delighted with Focus Premium, I'll give you a full refund", 'focus');
	$content['buy_message_2'] = __("Buy now and enjoy continued updates", 'focus');
	
	$content['features'] = array();

	$content['features'][] = array(
		'heading' => __("Responsive Layout", 'focus'),
		'content' => __("Take your videos to the mobile web with a fully responsive site layout.", 'focus'),
	);

	$content['features'][] = array(
		'heading' => __("Multiple Video Types", 'focus'),
		'content' => __("Have multiple versions of a video, showing different version to your paying customers. Easy integrations with membership plugins like S2Member.", 'focus'),
	);
	
	$content['features'][] = array(
		'heading' => __('Remove Attribution Links', 'focus'),
		'content' => __('Focus premium gives you the option to easily remove the "Powered by WordPress, Theme by SiteOrigin" text from your footer. ', 'focus'),
	);

	$content['features'][] = array(
		'heading' => __("Ajax Comments", 'focus'),
		'content' => __("Want to keep the conversation flowing? Ajax comments means your visitors can comment without reloading your page. So commenting wont interrupt a video or lose their position in one of your galleries.", 'focus'),
	);

	$content['features'][] = array(
		'heading' => __("CSS Editor", 'focus'),
		'content' => __("A simple CSS editor that lets you easily add code that changes the look of Focus. You can count on our support staff to help you with CSS snippets to get the look you're after. Best of all, your changes will persist across updates.", 'focus'),
	);

	$content['features'][] = array(
		'heading' => __('Premium Support', 'focus'),
		'content' => __("Need help setting up Focus? Upgrading to Focus Premium gives you prioritized support on our support forums.", 'focus'),
	);

	$content['features'][] = array(
		'heading' => __("Continued Updates", 'focus'),
		'content' => __("You'll get continued updates, ensuring that your Focus powered site keeps on working with the latest version of WordPress for years to come.", 'focus'),
	);
	
	return $content;
}
add_filter('siteorigin_premium_content', 'focus_premium_upgrade_content');