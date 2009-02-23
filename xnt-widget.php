<?php
/*
Plugin Name: TNX Simple Widget
Plugin URI: http://yukcariduit.co.cc/plugin
Description: This is a simple widget plugin to show your TNX links at the sidebar. For details, please visit the plugin homepage or read the "readme.txt" file.
Author: Soelaiman
Version: 1.0.0
Author URI: http://yukcariduit.co.cc
*/

function showlink()
{
  include('xnt.php');
}

function widget_tsw_partner_sites($args) {
  extract($args);

  $options = get_option("widget_tsw_partner_sites");
  if (!is_array( $options ))
	{
		$options = array(
      'title' => 'Partner Sites'
      );
  }      

  echo $before_widget;
    echo $before_title;
      echo $options['title'];
    echo $after_title;
    //Our Widget Content
    showlink();
  echo $after_widget;
}

function showlink_control()
{
  $options = get_option("widget_tsw_partner_sites");

  if (!is_array( $options ))
	{
		$options = array(
      'title' => 'Partner Sites'
      );
  }      

  if ($_POST['showlink-Submit'])
  {
    $options['title'] = htmlspecialchars($_POST['showlink-WidgetTitle']);

    update_option("widget_tsw_partner_sites", $options);
  }

?>
  <p>
    <label for="showlink-WidgetTitle">Widget Title: </label>
    <input type="text" id="showlink-WidgetTitle" name="showlink-WidgetTitle" value="<?php echo $options['title'];?>" />
    <input type="hidden" id="showlink-Submit" name="showlink-Submit" value="1" />
  </p>
<?php
}

function showlink_init()
{
  register_sidebar_widget(__('Partner Sites'), 'widget_tsw_partner_sites');
  register_widget_control(   'Partner Sites', 'showlink_control', 300, 200 );
}
add_action("plugins_loaded", "showlink_init");

?>