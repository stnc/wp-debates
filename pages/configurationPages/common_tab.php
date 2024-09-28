<?php
add_action( 'admin_init', 'tvsDebate_CommonSettings_init' );

$CommonSettingsOptions = get_option( 'tvsDebate_CommonSettings' );
function tvsDebate_CommonSettings_init(  ) {
    register_setting( 'tvsDebate_doSettingsSections', 'tvsDebate_CommonSettings' );


    add_settings_section(
        'tvsDebate_CommonConfig_section',
        __( 'Common', 'wordpress' ),
        'tvsDebate_CommonConfig_section_callback',
        'tvsDebate_doSettingsSections'
    );

    add_settings_field(
        'tvsDebate_usedAjax',
        __( 'Open all pages with modal box', 'wordpress' ),
        'tvsDebate_C_usedAjaxConfig_html',
        'tvsDebate_doSettingsSections',
        'tvsDebate_CommonConfig_section'
    );

    add_settings_field(
        'ShowVideoSpeaker',
        __( 'Show video and speaker on transcript page', 'wordpress' ),
        'tvsDebate_C_ShowVideoSpeakerConfig_html',
        'tvsDebate_doSettingsSections',
        'tvsDebate_CommonConfig_section'
    );


}

function tvsDebate_C_usedAjaxConfig_html(  ) {
global $CommonSettingsOptions;
    ?>
    <select name='tvsDebate_CommonSettings[tvsDebate_usedAjax]'>
        <option value="yes" <?php selected( $CommonSettingsOptions['tvsDebate_usedAjax'] , "yes"); ?>>Yes</option>
        <option value="no" <?php selected( $CommonSettingsOptions['tvsDebate_usedAjax'] , "no" ); ?>>No</option>
    </select>
    <?php
}

function tvsDebate_C_ShowVideoSpeakerConfig_html(  ) {
    global $CommonSettingsOptions;
        ?>
        <select name='tvsDebate_CommonSettings[ShowVideoSpeaker]'>
            <option value="yes" <?php selected( $CommonSettingsOptions['ShowVideoSpeaker'] , "yes"); ?>>Yes</option>
            <option value="no" <?php selected( $CommonSettingsOptions['ShowVideoSpeaker'] , "no" ); ?>>No</option>
        </select>
        <?php
    }
    

function tvsDebate_CommonConfig_section_callback(  ) {
    echo __( 'Common Settings', 'wordpress' );
}

function tvsDebate_config_common(  ) {
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields( 'tvsDebate_doSettingsSections' );
        do_settings_sections( 'tvsDebate_doSettingsSections' );
        submit_button();
        ?>
    </form>
    <?php
}