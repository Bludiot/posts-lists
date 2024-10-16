<?php
/**
 * Posts list options
 *
 * @package    Posts Lists
 * @subpackage Views
 * @category   Forms
 * @since      1.0.0
 */

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/Posts_Lists';

?>
<style>
.form-control-has-button {
	display: flex;
	align-items: center;
	flex-wrap: nowrap;
	gap: 0.25em;
	width: 100%;
	margin: 0;
	padding: 0;
}
</style>
<div class="alert alert-primary alert-posts-lists" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$guide_page}'>posts lists guide</a> page." ); ?></p>
</div>

<fieldset class="mt-4">
	<legend class="screen-reader-text mb-3"><?php $L->p( 'Sidebar List Options' ) ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="in_sidebar"><?php echo ucwords( $L->get( 'Sidebar List' ) ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="in_sidebar" name="in_sidebar">
				<option value="true" <?php echo ( $this->getValue( 'in_sidebar' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>

				<option value="false" <?php echo ( $this->getValue( 'in_sidebar' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			</select>
			<small class="form-text"><?php $L->p( 'Display a posts list in the sidebar ( <code>siteSidebar</code> hook required in the theme ).' ); ?></small>
		</div>
	</div>

	<div id="posts-lists-options" style="display: <?php echo ( $this->getValue( 'in_sidebar' ) == true ? 'block' : 'none' ); ?>;">

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for=""><?php $L->p( 'List Label' ); ?></label>
			<div class="col-sm-10">
				<div class="form-control-has-button">
					<input type="text" id="label" name="label" value="<?php echo $this->getValue( 'label' ); ?>" placeholder="<?php echo $this->dbFields['label']; ?>" />
					<span class="btn btn-secondary btn-md button hide-if-no-js" onClick="$('#label').val('<?php echo $this->dbFields['label']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text text-muted"><?php $L->p( 'List title in the sidebar. Save as empty for no title.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="label_wrap"><?php $L->p( 'Label Wrap' ); ?></label>
			<div class="col-sm-10">
				<div class="form-control-has-button">
					<input type="text" id="label_wrap" name="label_wrap" value="<?php echo $this->getValue( 'label_wrap' ); ?>" placeholder="<?php $L->p( 'h2' ); ?>" />
					<span class="btn btn-secondary btn-md button hide-if-no-js" onClick="$('#label_wrap').val('<?php echo $this->dbFields['label_wrap']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text text-muted"><?php $L->p( 'Wrap the label in an element, such as a heading. Accepts HTML tags without brackets (e.g. h3), and comma-separated tags (e.g. span,strong,em). Save as blank for no wrapping element.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="list_items"><?php $L->p( 'List Items' ); ?></label>
			<div class="col-sm-10 row form-range-row">
				<div class="form-range-controls">
					<span class="form-range-value ch-range-value"><span id="list_items_value"><?php echo $this->getValue( 'list_items' ); ?></span></span>
					<input type="range" class="form-control-range" onInput="$('#list_items_value').html($(this).val())" id="list_items" name="list_items" value="<?php echo $this->getValue( 'list_items' ); ?>" min="1" max="100" step="1" />
					<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#list_items_value').text('<?php echo $this->dbFields['list_items']; ?>');$('#list_items').val('<?php echo $this->dbFields['list_items']; ?>');"><?php $L->p( 'Default' ); ?></span>
				</div>
				<small class="form-text text-muted form-range-small"><?php $L->p( 'Maximum number of published posts to list in reverse chronological order. You may want to choose a larger number if using the dropdown option.' ); ?></small>
			</div>
		</div>

		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="show_dates"><?php echo ucwords( $L->get( 'Show Dates' ) ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="show_dates" name="show_dates">
					<option value="show" <?php echo ( $this->getValue( 'show_dates' ) === 'show' ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>

					<option value="hide" <?php echo ( $this->getValue( 'show_dates' ) === 'hide' ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'Display month & year of the posts.' ); ?></small>
			</div>
		</div>

		<div id="date_display_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'show_dates' ) === 'show' ? 'flex' : 'none' ); ?>;">
			<label class="form-label col-sm-2 col-form-label" for="date_display"><?php echo ucwords( $L->get( 'Date Display' ) ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="date_display" name="date_display">
					<option value="headings" <?php echo ( $this->getValue( 'date_display' ) === 'headings' ? 'selected' : '' ); ?>><?php $L->p( 'List with Headings' ); ?></option>

					<option value="select" <?php echo ( $this->getValue( 'date_display' ) === 'select' ? 'selected' : '' ); ?>><?php $L->p( 'Dropdown Select' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'Show dates as simple list month/year headings or as a dropdown box to select month/year.' ); ?></small>
			</div>
		</div>

		<div id="date_code_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'show_dates' ) === 'show' ? 'flex' : 'none' ); ?>;">
			<label class="form-label col-sm-2 col-form-label" for="date_code"><?php echo ucwords( $L->get( 'Date Format' ) ); ?></label>
			<div class="col-sm-10">
				<select class="form-select" id="date_code" name="date_code">
					<option value="F Y" <?php echo ( $this->getValue( 'date_code' ) === 'F Y' ? 'selected' : '' ); ?>><?php echo date( 'F Y' ); ?></option>

					<option value="Y F" <?php echo ( $this->getValue( 'date_code' ) === 'Y F' ? 'selected' : '' ); ?>><?php echo date( 'Y F' ); ?></option>

					<option value="M Y" <?php echo ( $this->getValue( 'date_code' ) === 'M Y' ? 'selected' : '' ); ?>><?php echo date( 'M Y' ); ?></option>

					<option value="Y M" <?php echo ( $this->getValue( 'date_code' ) === 'Y M' ? 'selected' : '' ); ?>><?php echo date( 'Y M' ); ?></option>

					<option value="n Y" <?php echo ( $this->getValue( 'date_code' ) === 'n Y' ? 'selected' : '' ); ?>><?php echo date( 'n Y' ); ?></option>

					<option value="Y n" <?php echo ( $this->getValue( 'date_code' ) === 'Y n' ? 'selected' : '' ); ?>><?php echo date( 'Y n' ); ?></option>

					<option value="m Y" <?php echo ( $this->getValue( 'date_code' ) === 'm Y' ? 'selected' : '' ); ?>><?php echo date( 'm Y' ); ?></option>

					<option value="Y m" <?php echo ( $this->getValue( 'date_code' ) === 'Y m' ? 'selected' : '' ); ?>><?php echo date( 'Y m' ); ?></option>
				</select>
				<small class="form-text"><?php $L->p( 'How to display the post month & year.' ); ?></small>
			</div>
		</div>
	</div>
</fieldset>

<script>
jQuery(document).ready( function($) {
	$( '#in_sidebar' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'true' ) {
			$( "#posts-lists-options" ).fadeIn( 250 );
		} else if ( show == 'false' ) {
			$( "#posts-lists-options" ).fadeOut( 250 );
		}
	});
	$( '#show_dates' ).on( 'change', function() {
		var show = $(this).val();
		if ( show == 'show' ) {
			$( "#date_code_wrap, #date_display_wrap" ).css( 'display', 'flex' );
		} else if ( show == 'hide' ) {
			$( "#date_code_wrap, #date_display_wrap" ).css( 'display', 'none' );
		}
	});
});
</script>
