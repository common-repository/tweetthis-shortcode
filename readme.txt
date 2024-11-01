=== TweetThis Shortcode ===
Contributors: douglaskarr
Tags: twitter, tweet, tweet this, tweetthis, bitly, shortcode, twitter status, twitter status update,
Version: 1.8.0
Stable tag: 1.8.0
Tested up to: 4.9
Requires at least: 3.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: https://dknewmedia.com

A plugin to add a link after a phrase that auto-populates a tweet on twitter. 

== Description ==

I could not find a simple plugin that enabled me to wrap a portion of text on a shortcode that would enable me to publish a link to automatically tweet the quote. So, we built one. There are not many features to the plugin currently. You can set your Twitter name to always include it in every Tweet and optionally use the Bit.ly API to shorten your URL. 

Obtain your credentials from Bit.ly from your [Advanced Settings](https://bitly.com/a/settings/advanced) page. If you do not use Bit.ly, the plugin will default to Twitter to shorten the link.

Hashtags can be used within the content or within a variable within the tweetthis shortcode.

Utilizes the [Web Intent URL](https://dev.twitter.com/web/tweet-button/web-intent)

= Usage: =
* [tweetthis]Fantastic shortcode #plugin to automatically populate a tweet![/tweetthis]
* [tweetthis hashtag="wordpress"]Fantastic shortcode plugin to automatically populate a tweet![/tweetthis]
* [tweetthis hashtag="wordpress plugin"]Fantastic shortcode plugin to automatically populate a tweet![/tweetthis]

You can view the result of this Tweet on my [TweetThis Shortcode](https://www.marketingtechblog.com/tweetthis-shortcode/) article.

Built by [DK New Media](http://www.dknewmedia.com), visit the [Marketing Technology Blog](https://www.marketingtechblog.com) to keep up on this plugin and other marketing tools to help you grow your online presence!

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to `Settings - TweetThis Shortcode` and enter your Twitter handle and Bit.ly credentials.

== Frequently Asked Questions ==

= How can I automatically add my Twitter Handle? =

Just go to `Settings - TweetThis Shortcode` and enter your Twitter handle.

= Does this plugin allow use of other shorteners? =

Not currently, but we are looking forward to expand its capabilities.

= Why is some of the content not being displayed? =

If your content, hashtags, twitter user and URL exceed 280 characters, Twitter will clip off content to ensure it fits.


== Screenshots ==

1. View of the shortcode and output link created.
2. View of a report section with the posts and Bit.ly reporting links.

== Changelog ==

= 1.8.0 = 
* Now supporting the 280 character limit with Twitter.

= 1.7.0 = 
* Corrected a bug where tags were stripped from the HTML content that is displayed.

= 1.6.0 =
* Added a section with your latest shortened links using Bit.ly and a link to open the link in Bit.ly reporting.

= 1.5.0 =
* Saved the Bit.ly link as a meta field for the post. This reduces the chances that the Bit.ly API rate limit is exceeded. Each time the shortcode is executed, it checks to see if the Bit.ly link already exists.

= 1.4.1 =
* Added support for a hashtag in the output tweet

= 1.4.0 =
* Added filter so unpublished posts do not use the Bit.ly API

= 1.3.2 =
* Modified URL inclusion over to Web Intent querystring variable

= 1.3.1 =
* Corrected URL encoding

= 1.3.0 =
* Corrected URL inclusion logic to Tweet

= 1.2.9 =
* Enhanced logic for populating text in Tweet URL

= 1.2.8 =
* Bug fix and optimized logic for populating text in Tweet

= 1.2.7 =
* Bug fix for populating text in Tweet

= 1.2.6 =
* Bug fix for populating text in Tweet

= 1.2.5 =
* Updated trimming logic for Tweet length

= 1.2.4 =
* Corrected via query variable

= 1.2.3 =
* Corrected cutoff calculation

= 1.2.2 =
* Adjusting cutoff logic. Added Twitter Intent API query variables for via, hashtags and url shortening

= 1.2.1 =
* Adjusting cutoff logic

= 1.2.0 =
* If the tweet exceeded the length limit of Twitter, it would generate a blank page on Twitter. The plugin now cuts off the content to accommodate

= 1.1.1 =
* Simplified URL encoding

= 1.1.0 =
* Simplified URL encoding

= 1.0.9 =
* Simplified URL encoding

= 1.0.8 =
* Corrected URL encoding

= 1.0.7 =
* Corrected URL encoding

= 1.0.6 =
* Corrected URL encoding

= 1.0.5 =
* Corrected URL encoding

= 1.0.4 =
* Corrected URL encoding for Twitter App opening on mobile device

= 1.0.3 =
* Updated documentation

= 1.0.2 =
* Updated text domain

= 1.0.1 =
* Updated documentation

= 1.0.0 =
* Initial Release

== Upgrade Notice ==

= 1.7.0 = 
* Corrected a bug where tags were stripped from the HTML content that is displayed.

= 1.6.0 =
* Added a section with your latest shortened links using Bit.ly and a link to open the link in Bit.ly reporting.

= 1.5.0 =
* Saved the Bit.ly link as a meta field for the post. This reduces the chances that the Bit.ly API rate limit is exceeded. Each time the shortcode is executed, it checks to see if the Bit.ly link already exists.

= 1.4.1 =
* Added support for a hashtag in the output tweet

= 1.4.0 =
* Added filter so unpublished posts do not use the Bit.ly API

= 1.3.2 =
* Modified URL inclusion over to Web Intent querystring variable

= 1.3.1 =
* Corrected URL encoding

= 1.3.0 =
* Corrected URL inclusion logic to Tweet

= 1.2.9 =
* Enhanced logic for populating text in Tweet URL

= 1.2.8 =
* Bug fix and optimized logic for populating text in Tweet

= 1.2.7 =
* Bug fix for populating text in Tweet

= 1.2.6 =
* Bug fix for populating text in Tweet

= 1.2.5 =
* Updated trimming logic for Tweet length

= 1.2.4 =
* Corrected via query variable

= 1.2.3 =
* Corrected cutoff calculation

= 1.2.2 =
* Adjusting cutoff logic. Added Twitter Intent API query variables for via, hashtags and url shortening.

= 1.2.1 =
* Adjusting cutoff logic

= 1.2.0 =
* If the tweet exceeded Twitter’s length limit, it would generate a blank page on Twitter. The plugin now cuts off the content to accommodate. 

= 1.1.1 =
* Simplified URL encoding

= 1.1.0 =
* Simplified URL encoding

= 1.0.9 =
* Simplified URL encoding

= 1.0.8 =
* Corrected URL encoding

= 1.0.7 =
* Corrected URL encoding

= 1.0.6 =
* Corrected URL encoding

= 1.0.5 =
* Corrected URL encoding

= 1.0.4 =
* Corrected URL encoding for Twitter App opening on mobile device

= 1.0.3 =
* Updated documentation

= 1.0.2 =
* Updated text domain

= 1.0.1 =
* Updated documentation

= 1.0.0 =
* Initial Release