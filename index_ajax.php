<?php
@error_reporting (0);
@ini_set ( 'display_errors', false );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', 0 );
define ( 'ROOT_DIR', dirname ( __FILE__ ) ); //dont change!
//load user.json
if(intval($_GET['user_id'])>0) {
    $file_temp = file_get_contents(ROOT_DIR.'/data/users_skills.json');
    $file = json_decode($file_temp);
    foreach($file as $item){
        if($item->{'id'}==$_GET['user_id']) {
            $user = $item->{user};
            $lastlogin = date('d.m.Y H:i:s',$item->{lastlogin});
            if($item->{party}!='null'){$party=$item->{party};}else $party='No Party';
            echo '{
            "user":"'.$user.'",
            "lastlogin":"'.$lastlogin.'",
            "part":"'.$part.'",
            "taming":'.$item->{'taming'}.',
            "mining":'.$item->{'mining'}.',
            "woodcutting":'.$item->{'woodcutting'}.',
            "repair":'.$item->{'repair'}.',
            "unarmed":'.$item->{'unarmed'}.',
            "herbalism":'.$item->{'herbalism'}.',
            "excavation":'.$item->{'excavation'}.',
            "archery":'.$item->{'archery'}.',
            "swords":'.$item->{'swords'}.',
            "axes":'.$item->{'axes'}.',
            "acrobatics":'.$item->{'acrobatics'}.'
            }';
        }
    }
}
//
?>