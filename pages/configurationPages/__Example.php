<?php
add_action( 'admin_init', 'stncWpKiosk_Weather_Settings_init' );
$stncWpKiosk_Weather_Settingsoptions = get_option('stncWpKiosk_Weather_Settings');
function stncWpKiosk_Weather_Settings_init(  ) {

    // register_setting('stncWpKiosk_WeatherConfig', 'stncWpKiosk_Weather_Settings');

    add_settings_section(
        'tvsDebate_CommonConfig_section',
        __( 'Common', 'wordpress' ),
        'tvsDebate_CommonConfig_section_callback',
        'tvsDebate_doSettingsSections'
    );


    add_settings_field(
        'tvsDebate_usedAjax',
        __( 'Open all pages with modal box', 'wordpress' ),
        'tvsDebate_usedAjaxConfig_html',
        'tvsDebate_doSettingsSections',
        'tvsDebate_CommonConfig_section'
    );

    // add_settings_field(
    //     'stncWpKiosk_text_field_weather_date',
    //     __( 'Tarih', 'wordpress' ),
    //     'weather_date_stncWpKiosk_text_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // );


    // add_settings_field(
    //     'stncWpKiosk_text_field_weather_day',
    //     __( 'Gun', 'wordpress' ),
    //     'weather_day_stncWpKiosk_text_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // ); 
    


    // add_settings_field(
    //     'stncWpKiosk_text_field_weather_description',
    //     __( 'Hava Durumu', 'wordpress' ),
    //     'weather_description_stncWpKiosk_text_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // ); 

    // add_settings_field(
    //     'stncWpKiosk_text_field_weather_description_en',
    //     __( 'Hava Durumu (ingilizce)', 'wordpress' ),
    //     'weather_description_en_stncWpKiosk_text_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // ); 

    // add_settings_field(
    //     'stncWpKiosk_text_field_weather_degree',
    //     __( 'Derece', 'wordpress' ),
    //     'weather_degree_stncWpKiosk_text_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // ); 

    // add_settings_field(
    //     'stncWpKiosk_text_field_weather_night',
    //     __( 'Gece Sicakligi', 'wordpress' ),
    //     'weather_night_stncWpKiosk_text_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // );   
    
    // add_settings_field(
    //     'stncWpKiosk_text_field_weather_humidity',
    //     __( 'Nem Orani', 'wordpress' ),
    //     'weather_humidity_stncWpKiosk_text_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // ); 

    // add_settings_field(
    //     'stncWpKiosk_Weather_Today',
    //     __( '7 Günlük Hava Bilgisi ', 'wordpress' ),
    //     'weather_humidity_stncWpKiosk_read_field_render',
    //     'stncWpKiosk_WeatherConfig',
    //     'stncWpKiosk_Weather_section'
    // ); 

}


function tvsDebate_usedAjaxConfig_html(  ) {
    $options = get_option( 'tvsDebate_CommonSettings' );
    ?>

    <select name='tvsDebate_CommonSettings[tvsDebate_usedAjax]'>

        <option value="yes" <?php selected( $options['tvsDebate_usedAjax'] , "yes"); ?>>Yes</option>
        <option value="no" <?php selected( $options['tvsDebate_usedAjax'] , "no" ); ?>>No</option>

    </select>


    <?php
}





function weather_day_stncWpKiosk_text_field_render(  ) {
    global  $stncWpKiosk_Weather_Settingsoptions;
    $options = $stncWpKiosk_Weather_Settingsoptions;
    ?>
    <input type='text' name='stncWpKiosk_Weather_Settings[stncWpKiosk_text_field_weather_day]' value='<?php   print (isset($options['stncWpKiosk_text_field_weather_day'])) ? $options['stncWpKiosk_text_field_weather_day'] : "";?>'>
    <small>Kullanimda degildir  bilgi amaclidir</small>
  <?php
}


function weather_date_stncWpKiosk_text_field_render(  ) {
   global  $stncWpKiosk_Weather_Settingsoptions;
   $options = $stncWpKiosk_Weather_Settingsoptions;
    ?>
    <input type='text' name='stncWpKiosk_Weather_Settings[stncWpKiosk_text_field_weather_date]' value='<?php print (isset($options['stncWpKiosk_text_field_weather_date'])) ? $options['stncWpKiosk_text_field_weather_date'] : "";?>'>
    <small>Kullanimda degildir  bilgi amaclidir</small>
    <?php
}


function weather_description_stncWpKiosk_text_field_render(  ) {
    global  $stncWpKiosk_Weather_Settingsoptions;
    $options = $stncWpKiosk_Weather_Settingsoptions;
    ?>
    <input type='text' name='stncWpKiosk_Weather_Settings[stncWpKiosk_text_field_weather_description]' 
    value='<?php print (isset($options['stncWpKiosk_text_field_weather_description'])) ? $options['stncWpKiosk_text_field_weather_description'] : ""; ?>'>
    <?php
}

function weather_description_en_stncWpKiosk_text_field_render(  ) {
    global  $stncWpKiosk_Weather_Settingsoptions;
    $options = $stncWpKiosk_Weather_Settingsoptions;
    ?>
    <input type='text' name='stncWpKiosk_Weather_Settings[stncWpKiosk_text_field_weather_description_en]' 
    value='<?php print (isset($options['stncWpKiosk_text_field_weather_description_en'])) ? $options['stncWpKiosk_text_field_weather_description_en'] : "";  ?>'>
    <small>Kullanimda degildir  bilgi amaclidir</small>
    <?php
}
function weather_degree_stncWpKiosk_text_field_render(  ) {
    global  $stncWpKiosk_Weather_Settingsoptions;
    $options = $stncWpKiosk_Weather_Settingsoptions;
    ?>
    <input type='text' name='stncWpKiosk_Weather_Settings[stncWpKiosk_text_field_weather_degree]' 
    value='<?php print (isset($options['stncWpKiosk_text_field_weather_degree'])) ? $options['stncWpKiosk_text_field_weather_degree'] : "";  ?>'>
    <?php
}

function weather_night_stncWpKiosk_text_field_render(  ) {
    global  $stncWpKiosk_Weather_Settingsoptions;
   $options = $stncWpKiosk_Weather_Settingsoptions;
    ?>
    <input type='text' name='stncWpKiosk_Weather_Settings[stncWpKiosk_text_field_weather_night]' 
    value='<?php  print (isset($options['stncWpKiosk_text_field_weather_night'])) ? $options['stncWpKiosk_text_field_weather_night'] : ""; ?>'>
    <?php
}

function weather_humidity_stncWpKiosk_text_field_render(  ) {
    global  $stncWpKiosk_Weather_Settingsoptions;
    $options = $stncWpKiosk_Weather_Settingsoptions;
    
    ?>
    <input type='text' name='stncWpKiosk_Weather_Settings[stncWpKiosk_text_field_weather_humidity]' 
    value='<?php print (isset($options['stncWpKiosk_text_field_weather_humidity'])) ? $options['stncWpKiosk_text_field_weather_humidity'] : "";  ?>'>
    <?php
}


function weather_humidity_stncWpKiosk_read_field_render(  ) {
    $optionsWeather6Today = get_option('stncWpKiosk_Weather_Today');
  //  $weather6Today = json_decode($optionsWeather6Today, true);
    ?>
<textarea rows="4" cols="50">
<?php echo $optionsWeather6Today; ?>
</textarea>
<small>kaydetmek için değildir,  bilgi amaclidir</small>
    <?php
}

function stncWpKiosk_Weather_Settings_section_callback(  ) {
    //echo __( 'bu konuda ayrintili bilgi icin bu sayfaya bakiniz ', 'wordpress' );
}

function stncWpKiosk_config_sdp(  ) {
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields( 'stncWpKiosk_WeatherConfig' );
        do_settings_sections( 'stncWpKiosk_WeatherConfig' );
      //  submit_button();
        ?>
    </form>
    <?php
}