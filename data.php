<?php 
    session_start();

    if(isset($_POST['game']) && !empty($_POST['game'])){
        $gameId = $_POST['game'];
    }else{
        header('Location: index.php');
        exit();
    }

    include_once 'functions.php';

    $api_key = '6aab9e78-bfa1-4b29-af9c-cb41dc7a231d';
    $matchUrl = "https://open.faceit.com/data/v4/matches/{$gameId}";
    $response = request($matchUrl, $api_key);
    $teams = array();


    foreach($response->teams as $team){
        $tmp = array();

        foreach($team->roster as $info){
            $tmp[$info->nickname] = $info->player_id;
        }
    
        $teams[$team->name] = $tmp;
    } 

    
    $playersInfo = getPlayersInfo($teams, $api_key);
    
    $_SESSION['playersInfo'] = $playersInfo;
    $_SESSION['teams'] = $teams;

    echo "<table><tr><th>team</th><th>nick</th><th>mapa</th><th>mecze</th><th>winy</th><th>loses</th><th>win rate</th></tr>";

    foreach($playersInfo as $player => $info){
        foreach($info as $mapa => $inf){
            echo "<tr><td>".getTeam($teams, $player)."</td><td>".$player."</td><td>".$mapa."</td><td>".$info[$mapa][0]."</td><td>".$info[$mapa][1]."</td><td>".$info[$mapa][2]."</td><td>".$info[$mapa][3]."</td></tr>";

        }
      
    }
    echo "</table>";

?>