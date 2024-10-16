<?php
/**
 * Posts lists guide
 *
 * @package    Posts Lists
 * @subpackage Views
 * @category   Guides
 * @since      1.0.0
 */

// Form page URL.
$form_page = DOMAIN_ADMIN . 'configure-plugin/Posts_Lists';

?>
<style>
	pre.posts-code,
	code.posts-code {
		user-select: all;
		cursor: pointer;
	}
	pre.posts-code {
		max-width: 720px;
		margin: 1rem 0;
		white-space: pre-wrap;
	}
</style>

<h1><span class="page-title-icon fa fa-book"></span> <span class="page-title-text"><?php $L->p( 'Posts Lists Guide' ) ?></span></h1>

<div class="alert alert-primary alert-posts-lists" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$form_page}'>sidebar settings</a> page." ); ?></p>
</div>

<h2 class="form-heading "><?php $L->p( 'Sidebar Posts List' ) ?></h2>

<p><?php $L->p( 'The sidebar posts list requires no coding and is enabled by default. It can be disabled on the settings page. The HTML markup and the CSS classes for the list are nearly identical to the original Bludit posts plugin for those who have already written custom CSS for the sidebar posts list.' ) ?></p>

<p><?php $L->p( 'When enabled, the sidebar posts list has several options for customizing to your needs.' ) ?></p>

<h2 class="form-heading "><?php $L->p( 'Default Settings' ) ?></h2>

<p><?php $L->p( 'The array below is the complete array of arguments used to construct a posts list. Any of these can be overridden with an array of arguments passed to a function call. These are also used by the sidebar posts list but array values are overridden by the plugin with settings values.' ) ?></p>

<pre lang="PHP" class="posts-code">
&lt;?php
$defaults = [
	'wrap'         => false,
	'wrap_class'   => 'list-wrap posts-list-wrap',
	'list_class'   => 'posts-list standard-posts-list',
	'label'        => false,
	'label_el'     => 'h2',
	'list_items'   => 7,
	'show_dates'   => 'show', // `show` or `hide`
	'date_display' => 'headings', // `headings` or `select`
	'date_code'    => 'F Y' // PHP date code
];
?&gt;
</pre>

<h2 class="form-heading "><?php $L->p( 'Template Tags' ) ?></h2>

<p><?php $L->p( 'The posts list function accepts an array of arguments to override the function defaults. It is also namespaced so the function must be preceded by the namespace or aliased.' ); ?></p>

<p><?php $L->p( 'Following is an example of displaying a default list in a theme template.<br />Note the PostLists namespace and backslash before the function call.' ); ?></p>

<pre lang="PHP">&lt;?php PostLists\posts_list(); ?&gt;</pre>

<p><?php $L->p( 'The following example demonstrates the addition of a list label.' ); ?></p>

<pre lang="PHP">&lt;?php PostLists\posts_list( [ 'label' => $L->get( '<?php $L->p( 'Posts Archive' ) ?>' ) ] ); ?&gt;</pre>

<p><?php $L->p( 'The following example hides the date headings, modifies the label element, and changes the maximum number of posts.' ); ?></p>

<pre lang="PHP" class="posts-code">
&lt;?php
$posts_list = [
	'show_dates' => 'hide',
	'label_el'   => 'h3',
	'list_items' => 20
];
echo PostLists\posts_list( $posts_list );
?&gt;
</pre>

<p><?php $L->p( 'Please raise issues and make suggestions on the plugin\'s GitHub page: <a href="https://github.com/Bludiot/posts-lists">https://github.com/Bludiot/posts-lists</a>' ); ?></p>
