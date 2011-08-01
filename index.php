<?php
/*
@last change (15.07.2011)
---
@index file
---
@author Kiborgik (maile and donate black_don@ukr.net)
---
v0.5
* perfomance relise & secure
- add index_ajax.php for all ajax request
- add posible gzip compression for css/js (minify_2.1.4_beta)
- add cache images and others to .htaccess
- add google charts
- need mining > 0 for adding to table
- now limit 1000 users whith biggest mining skill
- fix some html errors
v0.4
- rewrite front-end
- better css+js
- change to Datatables v1.8.0 http://www.datatables.net/
    - add search
    - all previos functions stay
    - add power functional for future
- add ui themes http://www.datatables.net/styling/themes
- more customizations whith http://www.datatables.net/examples/
- fix "Error: can't load data/users.json"
- moved style.css to "css" folder
- remove "them" folder & add "themes"
- remove not used js files
- add config.php (now all customizations on it)
- other fixes
v0.3
- add icons & tooltips
- some fixes
- remove page "users" & add it to popup on click name
- fixed width
- fixed "zebra"
v0.2
- add powerlevel
- some bugfix
- some cleanups
- compare phpversion
- add config (time_cache, prefix)
v0.1
- initial relise
- support mcMMO
- caching json files
*/
@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );
define ( 'ROOT_DIR', dirname ( __FILE__ ) ); //dont change!


//start of compare
if (version_compare(PHP_VERSION, '5.2.1') >= 0 && !$_GET['user_id']) {
    include_once (ROOT_DIR.'/classes/mysql.php');
    include_once (ROOT_DIR.'/classes/webstats.class.php');
    include_once (ROOT_DIR.'/config.php');
    
    $ws = new webstats();
    //$ws->connect('mysql_user', 'mysql_password', 'mysql_database', 'localhost:3306');
    $ws->connect($config['mysql_user'], $config['mysql_password'], $config['mysql_database'], $config['mysql_server_ip'].':'.$config['mysql_port']);
    $ws->config('time_cache', $config['time_cache']); //in sec
    $ws->config('prefix', $config['prefix']); //default prefix - change only if you know what you do
    $ws->processingUsers();

?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <title>webstats for mcMMO</title> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <meta name="author" lang="en" content="Kiborgik (black_don@ukr.net)">
  <link rel="stylesheet" type="text/css" href="min/?g=css">
  <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
  <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script> 
  <script src="min/?g=js" type="text/javascript"></script> 
  <script type="text/javascript">
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['corechart']});
      // Set a callback to run when the Google Visualization API is loaded.
      //google.setOnLoadCallback(drawChart);
  </script>
</head>
<body id="dt_example"> 
<div id="opaco" class="hidden"></div> 
<div id="popup" class="hidden"></div>
<div id="popup_user" class="hidden">
    <div id="script"></div>      
    <div id="username">Username: </div>
    <div id="lastlogin">Lastlogin: </div>
    <div id="party">Party: </div>
    <div id="chart_div"></div>
    <div id="close" onclick="$('#popup_bug').togglePopup(); return false;" >Close</div>
</div>
 
<div class="tabs"> 
    <ul class="tabNavigation">
        <li><a class="" href="#first">Users Skills</a></li>
        <li><a class="" href="#second">Other</a></li>
    </ul>
    <div id="first">
        <div id="demo">
            <h2>Users Skills Table</h2>
                <table class="display" id="content_users_skills"> 
                    <thead><tr>
                       <th><img src="themes/icons/user.png" width="32" height="32" title="User Names"></th><th><img src="themes/icons/powerlevel.png" width="32" height="32" title="Power Level"></th><th><img src="themes/icons/taming.png" width="32" height="32" title="Taming"></th><th><img src="themes/icons/mining.png" width="32" height="32" title="Mining"></th><th><img src="themes/icons/woodcutting.png" width="32" height="32" title="Wood Cutting"></th><th><img src="themes/icons/repair.png" width="32" height="32" title="Repair"></th><th><img src="themes/icons/unarmed.png" width="32" height="32" title="Unarmed"></th><th><img src="themes/icons/herbalism.png" width="32" height="32" title="Herbalism"></th><th><img src="themes/icons/excavation.png" width="32" height="32" title="Excavation"></th><th><img src="themes/icons/archery.png" width="32" height="32" title="Archery"></th><th><img src="themes/icons/swords.png" width="32" height="32" title="Swords"></th><th><img src="themes/icons/axes.png" width="32" height="32" title="Axes"></th><th><img src="themes/icons/acrobatics.png" width="32" height="32" title="Acrobatics"></th>  
                    </tr></thead>
                    <tbody>
                    <?php
                    $file_temp = file_get_contents(ROOT_DIR.'/data/users_skills.json');
                    $file = json_decode($file_temp);
                    foreach($file as $item)
                    {
                        $power_level = $item->{'taming'} + $item->{'mining'} + $item->{'woodcutting'} + $item->{'repair'} + $item->{'unarmed'} + $item->{'herbalism'} + $item->{'excavation'} + $item->{'archery'} + $item->{'swords'} + $item->{'axes'} + $item->{'acrobatics'};
                        echo '<tr><td><span style="cursor:pointer;" onCLick="$(\'#popup_user\').togglePopup(); load_user('.$item->{'id'}.'); return false;" >'.$item->{'user'}.'</span></td><td>'.$power_level.'</td><td>'.$item->{'taming'}.'</td><td>'.$item->{'mining'}.'</td><td>'.$item->{'woodcutting'}.'</td><td>'.$item->{'repair'}.'</td><td>'.$item->{'unarmed'}.'</td><td>'.$item->{'herbalism'}.'</td><td>'.$item->{'excavation'}.'</td><td>'.$item->{'archery'}.'</td><td>'.$item->{'swords'}.'</td><td>'.$item->{'axes'}.'</td><td>'.$item->{'acrobatics'}.'</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
        </div>
        <div class="spacer"></div>
    </div>
    <div id="second">
        coming soon...    
    </div>
</div>
<script>
 $(document).ready(function(){   
    //for tabs
    var tabContainers = $('div.tabs > div'); 
    tabContainers.hide().filter(':first').show();
    $('div.tabs ul.tabNavigation a').click(function () {
        tabContainers.hide();
        tabContainers.filter(this.hash).show(); 
        $('div.tabs ul.tabNavigation a').removeClass('selected'); 
        $(this).addClass('selected'); 
        return false;
    }).filter(':first').click();
    
});
</script>

<script>
 $(document).ready(function(){ 
    $('#content_users_skills').dataTable( {
		"aaSorting": [[ 1, "desc" ]],
        "bJQueryUI": true,
		"sPaginationType": "full_numbers"
	} );
    simple_tooltip("img","tooltip");
    
}); 
</script>
</body>
</html>
<?php
//end of compare
} elseif(!$_GET['user_id']) echo 'Pls install php version 5.2.1 or better!';
?>