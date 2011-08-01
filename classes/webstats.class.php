<?php
/*
@last change (15.07.2011)
---
@class maine
---
@author Kiborgik (maile and donate black_don@ukr.net)
---
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
class webstats extends db
{
    public $users_array;
    public $users_array_json;
    public $users_skills_array;
    public $users_skills_array_json;
    private $time_cache = 300; //default 5 min
    private $prefix = 'mcmmo_'; //default prefix
    
    public function processingUsers()
    {
        $modif = time() - @filemtime (ROOT_DIR.'/data/users.json'); //chek time of creation for caching
        if ($modif > $this->time_cache)
        { 
            $this->getUsers();
            $this->getUsersSkills();
            $this->encodeJson();
        }
    }
    public function config($key, $value)
    {
        switch ($key)
        {
            case 'time_cache':
            $this->time_cache = $value;
            break;
            case 'prefix':
            $this->prefix = $value;
            break;
        }
    }
    private function encodeJson()
    {
        $this->users_array_json = json_encode($this->users_array);
        $this->users_skills_array_json = json_encode($this->users_skills_array);
        file_put_contents(ROOT_DIR.'/data/users.json', $this->users_array_json);
        file_put_contents(ROOT_DIR.'/data/users_skills.json', $this->users_skills_array_json);
    }
    private function getUsers()
    {
        $this->users_array = $this->super_query("SELECT * FROM `".$this->prefix."users` WHERE `user`!='' ORDER BY `lastlogin` LIMIT 0, 1000", true);
    }
    private function getUsersSkills()
    {
        $this->users_skills_array = $this->super_query("SELECT * FROM `".$this->prefix."users` as mu LEFT JOIN `".$this->prefix."skills` as ms ON (mu.id=ms.user_id) WHERE mu.user !='' AND ms.mining >0 ORDER BY ms.mining DESC LIMIT 0, 1000", true);
    }
}
?>