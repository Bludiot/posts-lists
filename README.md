# Posts Lists

Improved posts lists plugin for Bludit CMS.

![Tested up to Bludit version 3.16.2](https://img.shields.io/badge/Bludit-3.16.2-42a5f5.svg?style=flat-square "Tested up to Bludit version 3.16.2")
![Minimum PHP version is 7.4](https://img.shields.io/badge/PHP_Min-7.4-8892bf.svg?style=flat-square "Minimum PHP version is 7.4")
![Tested on PHP version 8.2.4](https://img.shields.io/badge/PHP_Test-8.2.4-8892bf.svg?style=flat-square "Tested on PHP version 8.2.4")

## Sidebar Posts List

The sidebar posts list requires no coding and is enabled by default. It can be disabled on the settings page. The HTML markup and the CSS classes for the list are nearly identical to the original Bludit posts plugin for those who have already written custom CSS for the sidebar posts list.

When enabled, the sidebar posts list has several options for customizing to your needs.
Default Settings

The array below is the complete array of arguments used to construct a posts list. Any of these can be overridden with an array of arguments passed to a function call. These are also used by the sidebar posts list but array values are overridden by the plugin with settings values.

``` php
<?php
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
?>
```

## Template Tags

The posts list function accepts an array of arguments to override the function defaults. It is also namespaced so the function must be preceded by the namespace or aliased.

Following is an example of displaying a default list in a theme template.
Note the PostLists namespace and backslash before the function call.

``` php
<?php PostLists\posts_list(); ?>
```

The following example demonstrates the addition of a list label.

``` php
<?php PostLists\posts_list( [ 'label' => $L->get( 'Posts Archive' ) ] ); ?>
```

The following example hides the date headings, modifies the label element, and changes the maximum number of posts.

``` php
<?php
$posts_list = [
	'show_dates' => 'hide',
	'label_el'   => 'h3',
	'list_items' => 20
];
echo PostLists\posts_list( $posts_list );
?>
```
