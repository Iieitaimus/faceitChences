<?php 

function getTeam($teams, $nick){
    foreach($teams as $team => $names){
        foreach($names as $name => $id){
            if($name == $nick){
                return $team;
            }
        }
    }
}

function request($url, $api_key){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Bearer {$api_key}"]);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($curl));
    curl_close($curl);

    return $response;
}


function getPlayersInfo($teams, $api_key){
    $playersInfo = array();

    foreach($teams as $team => $players){
        foreach($players as $name => $id){
            $response = request("https://open.faceit.com/data/v4/players/{$id}/stats/csgo", $api_key);
            $maps = array();
            
            foreach ($response->segments as $segment) {
                if($segment->mode != "5v5")continue; 
                
                $map = $segment->label;
                $matches = $segment->stats->Matches;
                $wins = $segment->stats->Wins;
                $loses = $matches - $wins;
                $winRate = $segment->stats->{'Win Rate %'};
                
                $tmp = array($matches, $wins, $loses, $winRate);
                
                $maps[$map] = $tmp;   
            }
            $playersInfo[$name] = $maps;
        }
    }

    return $playersInfo;
}
?>