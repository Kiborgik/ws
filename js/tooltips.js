function simple_tooltip(target_items, name){
var reclam_text="<p>all questions and other <a href=\"http://forums.bukkit.org/threads/info-web-ws-v0-1-web-stat-page-for-mcmmo-740.15315/\"> on Bukkit forum </a><br />&copy <a href=\"http://crafthero.net\"> Kiborgik </a>2011 (mailto: black_don@ukr.net)</p>";
    $("#first").append(reclam_text);
    $("#second").append(reclam_text);
 $(target_items).each(function(i){
 $("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
 var my_tooltip = $("#"+name+i);

 $(this).removeAttr("title").mouseover(function(){
 my_tooltip.css({opacity:0.8, display:"none"}).fadeIn(400);
 }).mousemove(function(kmouse){
 my_tooltip.css({left:kmouse.pageX-50, top:kmouse.pageY+15});
 }).mouseout(function(){
 my_tooltip.fadeOut(400);
 });
 });
}
function load_user(id){
    //load user data
        var jqxhr = $.getJSON("index_ajax.php?user_id="+id, function(json) { 
                    $("#username").append(json.user);
                    $("#lastlogin").append(json.lastlogin);
                    $("#party").append(json.party);
                    $("#script").prepend("<script type=\"text/javascript\"> var data = new google.visualization.DataTable();data.addColumn('string', 'Skill');data.addColumn('number', 'skillpower');data.addRows([['taming',"+json.taming+"],['mining',"+json.mining+"],['woodcutting',"+json.woodcutting+"],['repair',"+json.repair+"],['unarmed',"+json.unarmed+"],['herbalism',"+json.herbalism+"],['excavation',"+json.excavation+"],['archery',"+json.archery+"],['swords',"+json.swords+"],['axes',"+json.axes+"],['acrobatics',"+json.acrobatics+"]]);var chart = new google.visualization.BarChart(document.getElementById('chart_div'));chart.draw(data, {width: 600, height: 240});</script>");
        }).error(function() { alert("Error: can't load data/users_skills.json"); });
      
}
