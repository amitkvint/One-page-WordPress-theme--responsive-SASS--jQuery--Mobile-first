<?php
global $wpdb;

if( isset( $_GET['wpmdb-profile'] ) ){
	$loaded_profile = $this->get_profile( $_GET['wpmdb-profile'] );
}
else{
	$loaded_profile = $this->default_profile;
}

$is_default_profile = isset( $loaded_profile['default_profile'] );
?>
<script type='text/javascript'>
	var wpmdb_default_profile = <?php echo ( $is_default_profile ? 'true' : 'false' ); ?>;
	var wpmdb_export_with_prefix = <?php echo ( $loaded_profile['table_migrate_option'] == 'migrate_only_with_prefix' ? 'true' : 'false' ); ?>;
	<?php if( isset( $loaded_profile['select_tables'] ) && ! empty( $loaded_profile['select_tables'] ) ) : ?>
		var wpmdb_loaded_tables = '<?php echo json_encode( $loaded_profile['select_tables'] ); ?>';
	<?php endif; ?>
</script>
	
<div class="migrate-tab content-tab">

	<form method="post" id="migrate-form" action="#migrate" enctype="multipart/form-data">

		<?php if( count( $this->settings['profiles'] ) > 0 ){ ?>
			<a href="<?php echo $this->plugin_base; ?>" class="return-to-profile-selection clearfix">&larr; Back to select a saved profile</a>
		<?php } ?>
	
		<div class="option-section">

			<ul class="option-group migrate-selection">
				<li>
					<label for="savefile">
					<input id="savefile" type="radio" value="savefile" name="action"<?php echo ( $loaded_profile['action'] == 'savefile' ? ' checked="checked"' : ''  ); ?> />
					Export File
					</label>
					<ul>
						<li>
							<label for="save_computer">
							<input id="save_computer" type="checkbox" value="1" name="save_computer"<?php echo ( isset( $loaded_profile['save_computer'] ) ? ' checked="checked"' : ''  ); ?> />
							Save as file to your computer
							</label>
						</li>
						<?php if ( $this->gzip() ) : ?>
							<li>
								<label for="gzip_file">
									<input id="gzip_file" type="checkbox" value="1" name="gzip_file"<?php echo ( isset( $loaded_profile['gzip_file'] ) ? ' checked="checked"' : ''  ); ?> />
									Compress file with gzip
								</label>
							</li>
						<?php endif; ?>
					</ul>
				</li>
				<li class="pull-list">
					<label for="pull">
					<input id="pull" type="radio" value="pull" name="action"<?php echo ( $loaded_profile['action'] == 'pull' ? ' checked="checked"' : ''  ); ?> />
					Pull<span class="option-description">Replace this site's db with remote db</span>
					</label>
					<ul>
						<li></li>
					</ul>
				</li>
				<li class="push-list">
					<label for="push">
					<input id="push" type="radio" value="push" name="action"<?php echo ( $loaded_profile['action'] == 'push' ? ' checked="checked"' : ''  ); ?> />
					Push<span class="option-description">Replace remote db with this site's db</span>
					</label>
					<ul>
						<li></li>
					</ul>
				</li>
			</ul>
			
			<div class="connection-info-wrapper clearfix">
				<textarea class="pull-push-connection-info" name="connection_info" placeholder="Connection Info - Site URL &amp; Secret Key"><?php echo ( isset( $loaded_profile['connection_info'] ) ? $loaded_profile['connection_info'] : '' ); ?></textarea>
				<br />
				<input class="button connect-button" type="submit" value="Connect" name="Connect" autocomplete="off" />
			</div>
		
		</div>
	
		<div class="import-button">
			<input class="button-primary import-db-button" type="submit" value="Import DB" name="import-db" autocomplete="off" />
		</div>

		<p class="connection-status">Please enter the connection information above to continue.</p>
		
		<div class="step-two">

			<div class="option-section">
				<div class="header-wrapper clearfix">
					<div class="option-heading find-heading">Find</div>
					<div class="option-heading replace-heading">Replace</div>
				</div>
				
				<p class="no-replaces-message">Doesn't look we have any replaces yet, <a href="#" class="js-action-link add-replace">add one?</a></p>
				
				<table class="clearfix replace-fields">
					<tr class="replace-row original-repeatable-field">
						<td class="old-replace-col">
							<input type="text" size="40" name="replace_old[]" class="code" placeholder="Old value" autocomplete="off" />
						</td>
						<td class="arrow-col">
							<span class="right-arrow">&rarr;</span>
						</td>
						<td class="replace-right-col">
							<input type="text" size="40" name="replace_new[]" class="code" placeholder="New value" autocomplete="off" />
							<span class="replace-remove-row"></span>
							<span class="replace-add-row"></span>
						</td>
					</tr>
					<?php if( $is_default_profile ) : ?>
						<tr class="replace-row">
							<td class="old-replace-col">
								<input type="text" size="40" name="replace_old[]" class="code" id="old-url" placeholder="Old URL" value="<?php echo htmlentities( home_url() ); ?>" autocomplete="off" />
							</td>
							<td class="arrow-col">
								<span class="right-arrow">&rarr;</span>
							</td>
							<td class="replace-right-col">
								<input type="text" size="40" name="replace_new[]" class="code" id="new-url" placeholder="New URL" autocomplete="off" />
								<span class="replace-remove-row"></span>
								<span class="replace-add-row"></span>
							</td>
						</tr>
						<tr class="replace-row">
							<td class="old-replace-col">
								<input type="text" size="40" name="replace_old[]" class="code" id="old-path" placeholder="Old file path" value="<?php echo htmlentities( $this->absolute_root_file_path ); ?>" autocomplete="off" />
							</td>
							<td class="arrow-col">
								<span class="right-arrow">&rarr;</span>
							</td>
							<td class="replace-right-col">
								<input type="text" size="40" name="replace_new[]" class="code" id="new-path" placeholder="New file path" autocomplete="off" />
								<span class="replace-remove-row"></span>
								<span class="replace-add-row"></span>
							</td>
						</tr>
						<?php if( is_multisite() ) : ?>
							<tr class="replace-row">
								<td class="old-replace-col">
									<input type="text" size="40" name="replace_old[]" class="code" id="old-domain" placeholder="Old domain" value="<?php echo htmlentities( DOMAIN_CURRENT_SITE ); ?>" autocomplete="off" />
								</td>
								<td class="arrow-col">
									<span class="right-arrow">&rarr;</span>
								</td>
								<td class="replace-right-col">
									<input type="text" size="40" name="replace_new[]" class="code" id="new-domain" placeholder="New domain" autocomplete="off" />
									<span class="replace-remove-row"></span>
									<span class="replace-add-row"></span>
								</td>
							</tr>
						<?php endif; ?>
					<?php else :
						$i = 1;
						foreach( $loaded_profile['replace_old'] as $replace_old ) : ?>
							<tr class="replace-row">
								<td class="old-replace-col">
									<input type="text" size="40" name="replace_old[]" class="code" placeholder="Old value" value="<?php echo $replace_old; ?>" autocomplete="off" />
								</td>
								<td class="arrow-col">
									<span class="right-arrow">&rarr;</span>
								</td>
								<td class="replace-right-col">
									<input type="text" size="40" name="replace_new[]" class="code" placeholder="New value" value="<?php echo ( isset( $loaded_profile['replace_new'][$i] ) ? $loaded_profile['replace_new'][$i] : '' ); ?>" autocomplete="off" />
									<span class="replace-remove-row"></span>
									<span class="replace-add-row"></span>
								</td>
							</tr>
						<?php
						++$i;
						endforeach; ?>
					<?php endif; ?>
				</table>

			</div>

			<div class="option-section">
				<?php $tables = $this->get_tables(); ?>
				<div class="header-expand-collapse clearfix">
					<?php
						if( isset( $loaded_profile['table_migrate_option'] ) && $loaded_profile['table_migrate_option'] == 'migrate_select' ){
							$collapse = '';
						}
						else{
							$collapse = ' collapsed';
						}
					?>
					<div class="expand-collapse-arrow<?php echo $collapse; ?>">&#x25BC;</div>
					<div class="option-heading tables-header">Tables</div>
				</div>

				<div class="indent-wrap expandable-content table-select-wrap" style="display: <?php echo ( $collapse == '' ? 'block' : 'none' ); ?>;">

					<ul class="option-group table-migrate-options">
						<li>
							<label for="migrate-only-with-prefix">
							<input id="migrate-only-with-prefix" type="radio" value="migrate_only_with_prefix" name="table_migrate_option"<?php echo ( $loaded_profile['table_migrate_option'] == 'migrate_only_with_prefix' ? ' checked="checked"' : '' ); ?> />
							Migrate all tables with prefix "<span class="table-prefix"><?php echo $wpdb->prefix; ?></span>"
							</label>
						</li>
						<li>
							<label for="migrate-selected">
							<input id="migrate-selected" type="radio" value="migrate_select" name="table_migrate_option"<?php echo ( $loaded_profile['table_migrate_option'] == 'migrate_select' ? ' checked="checked"' : '' ); ?> />
							Migrate only selected tables below
							</label>
						</li>
					</ul>

					<div class="select-tables-wrap">
						<select multiple="multiple" name="select_tables[]" id="select-tables" autocomplete="off">
						<?php foreach( $tables as $table ) :
							if( ! empty( $loaded_profile['select_tables'] ) && in_array( $table, $loaded_profile['select_tables'] ) ){
								printf( '<option value="%1$s" selected="selected">%1$s</option>', $table );
							}
							else{
								printf( '<option value="%1$s">%1$s</option>', $table );
							}
						endforeach; ?>
						</select>
						<br />
						<a href="#" class="tables-select-all js-action-link">Select All</a>
						<span class="select-deselect-divider">/</span>
						<a href="#" class="tables-deselect-all js-action-link">Deselect All</a>
						<span class="select-deselect-divider">/</span>
						<a href="#" class="tables-invert-selection js-action-link">Invert Selection</a>
					</div>
				</div>
			</div>
			
			<div class="option-section">
				<div class="header-expand-collapse clearfix">
					<div class="expand-collapse-arrow collapsed">&#x25BC;</div>
					<div class="option-heading tables-header">Advanced Options</div>
				</div>
				
				<div class="indent-wrap expandable-content">
					
					<ul>
						<li>
							<label for="replace-guids">
							<input id="replace-guids" type="checkbox" value="1" name="replace_guids"<?php echo ( isset( $loaded_profile['replace_guids'] ) ? ' checked="checked"' : '' ); ?> />
							Replace GUIDs
							</label>

							<a href="#" class="general-helper replace-guid-helper js-action-link"></a>

							<div class="replace-guids-info helper-message">
								Although the <a href="http://codex.wordpress.org/Changing_The_Site_URL#Important_GUID_Note" target="_blank">WordPress Codex emphasizes</a>
								that GUIDs should not be changed, this is limited to sites that are already live.
								If the site has never been live, I recommend replacing the GUIDs. For example, you may be
								developing a new site locally at dev.somedomain.com and want to 
								migrate the site live to somedomain.com.
							</div>
						</li>
						<li>
							<label for="exclude-spam">
							<input id="exclude-spam" type="checkbox" autocomplete="off" value="1" name="exclude_spam"<?php echo ( isset( $loaded_profile['exclude_spam'] ) ? ' checked="checked"' : '' ); ?> />
							Exclude spam comments
							</label>
						</li>
						<li>
							<label for="exclude-revisions">
							<input id="exclude-revisions" type="checkbox" autocomplete="off" value="1" name="exclude_revisions"<?php echo ( isset( $loaded_profile['exclude_revisions'] ) ? ' checked="checked"' : '' ); ?> />
							Exclude post revisions
							</label>
						</li>
						<li class="backup-options">
							<label for="create-backup">
							<input id="create-backup" type="checkbox" value="1" autocomplete="off" name="create_backup"<?php echo ( isset( $loaded_profile['create_backup'] ) ? ' checked="checked"' : '' ); ?> />
							Backup the database that will be overwritten and save to the "uploads" folder
							</label>
						</li>
					</ul>

				</div>
			</div>
			
			<div class="option-section save-migration-profile-wrap">
				<label for="save-migration-profile" class="save-migration-profile">
				<input id="save-migration-profile" type="checkbox" value="1" name="save_migration_profile"<?php echo ( ! $is_default_profile ? ' checked="checked"' : '' ); ?> />
				Save Migration Profile<span class="option-description">Save the above settings for the next time you do a similiar migration</span>
				</label>
				
				<div class="indent-wrap expandable-content">
					<ul class="option-group">
						<?php
							foreach( $this->settings['profiles'] as $key => $profile ){ ?>
								<li>
									<span class="delete-profile" data-profile-id="<?php echo $key; ?>"></span>
									<label for="profile-<?php echo $key; ?>">
									<input id="profile-<?php echo $key; ?>" type="radio" value="<?php echo $key; ?>" name="save_migration_profile_option"<?php echo ( $loaded_profile['name'] == $profile['name'] ? ' checked="checked"' : '' ); ?> />
									<?php echo $profile['name']; ?>
									</label>
								</li>
							<?php }
						?>
						<li>
							<label for="create_new" class="create-new-label">
							<input id="create_new" type="radio" value="new" name="save_migration_profile_option"<?php echo (  $is_default_profile ? ' checked="checked"' : '' ); ?> />
							Create new profile
							</label>
							<input type="text" placeholder="e.g. Live Site" name="create_new_profile" class="create-new-profile" />
						</li>
					</ul>
				</div>
			</div>

			<div class="prefix-notice pull">
				<p>Whoa! We've detected that the database table prefix differs between installations. Clicking the Migrate DB button below will create new database tables in your local database with prefix "<span class="remote-prefix"></span>".</p>

				<p>However, your local install is configured to use table prefix "<?php echo $wpdb->prefix; ?>" and will ignore the migrated tables. So, <b>AFTER</b> migration is complete, you will need to edit your local install's wp-config.php and change the $table_prefix variable to "<span class="remote-prefix"></span>".</p>

				<p>This will allow your local install the use the migrated tables. Once you do this, you shouldn't have to do it again.</p>
			</div>

			<div class="prefix-notice push">
				<p>Whoa! We've detected that the database table prefix differs between installations. Clicking the Migrate DB button below will create new database tables in the remote database with prefix "<?php echo $wpdb->prefix; ?>".</p>

				<p>However, your remote install is configured to use table prefix "<span class="remote-prefix"></span>" and will ignore the migrated tables. So, <b>AFTER</b> migration is complete, you will need to edit your remote install's wp-config.php and change the $table_prefix variable to "<?php echo $wpdb->prefix; ?>".</p>

				<p>This will allow your remote install the use the migrated tables. Once you do this, you shouldn't have to do it again.</p>
			</div>

			<p class="migrate-db">
				<input type="hidden" class="remote-json-data" name="remote_json_data" autocomplete="off" />
				<input class="button-primary migrate-db-button" type="submit" value="Migrate DB" name="Submit" autocomplete="off" />
				<input class="button save-settings-button" type="submit" value="Save Profile" name="submit_save_profile" autocomplete="off" />
			</p>
			
		</div>

		<?php
		if( count( $this->settings['profiles'] ) > 0 ){ ?>
			<a href="<?php echo $this->plugin_base; ?>" class="return-to-profile-selection clearfix bottom">&larr; Back to select a saved profile</a>
		<?php } ?>

	</form>
	<?php
	$this->template( 'migrate-progress' );
	?>

</div> <!-- end .migrate-tab -->