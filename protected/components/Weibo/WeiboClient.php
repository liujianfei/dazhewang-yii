<?php
/**
 * 新浪微博 OAuth 认证类(旧)
 *
 */
class WeiboClient extends SaeTClient
{
	function __construct( $consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL )
	{
		parent::__construct( $consumer_key, $consumer_secret, $oauth_token , $oauth_token_secret );
	}
}

?>