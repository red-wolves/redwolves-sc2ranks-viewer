<?php

/*
=== REDWOLV.ES ===

    //
   |..~~~O  
  {   ~vv'
    |
   >O<

==================  
*/

?>
	
	<?php 
		// include custom header
		include('inc-header.php');
	
		// search form
		$sbnetid = $_GET['bnetid'];
		$sbnetname = $_GET['bnetname'];
		$sbnetregion = $_GET['region'];
		echo '<div class="searchform">';
			echo '<form id="zip_search" method="get" action="rank.php?bnetid='.$sbnetid.'&bnetname='.$sbnetname.'&region='.$sbnetregion.'">';
			echo '<ul>';
				echo '<li><strong>Get Your Own Ranks</strong></li>';
    			echo '<li><label for="bnetid">BattleNet ID</label>';
    			echo '<input class="field" name="bnetid" type="text" id="bnetid" value="ex:1582414" /></li>';
    			echo '<li><label for="bnetname">BattleNet Name</label>';
    			echo '<input class="field" name="bnetname" type="text" id="bnetname" value="ex:ATǂCENSURE" /></li>';
    			echo '<li><label for="region">Region</label>';
    			echo '<input class="field" name="region" type="text" id="region" value="ex:eu/am/kr/sea/cn" /></li>';
    			echo '<li><input class="button" type="submit" value="Submit" class="submitbutton" /></li>';
			echo '</ul>';
    		echo '</form>';
    		echo '<div class="clear"></div>';
		echo '</div>';
	
    	//disable errors reporting
    	error_reporting( 0 );
    	
    	// Character vars
    	$bnetid 	= $_GET["bnetid"];
    	$bnetname 	= $_GET["bnetname"];
    	$region 	= $_GET["region"];
    	$yoururl 	= 'redwolv.es';

    	// Parsing base infos
    	$fichierinfos = 'http://sc2ranks.com/api/base/char/'.$region.'/'.$bnetname.'!'.$bnetid.'.xml?appKey='.$yoururl;
    	
    	$dominfos = new DOMDocument();
    	if (!$dominfos->load($fichierinfos)) {
	    	echo '<p class="error">No profile loaded</p>';
	    } else {

		    $itemListinfos = $dominfos->getElementsByTagName('hash');
		    foreach ($itemListinfos as $iteminfos) {
			    echo '<div class="base-info">';
		
			    	$portraitid = $iteminfos->getElementsByTagName('icon-id');
			    	$achievpoints = $iteminfos->getElementsByTagName('achievement-points');
		
			    	$portraitcolumn = $iteminfos->getElementsByTagName('column');
			    	$c_first_number = $portraitcolumn->item(0)->nodeValue;
			    	$c_second_number = 90;
			    	$c_sum_total = $c_second_number * $c_first_number;
		
			    	$portraitrow = $iteminfos->getElementsByTagName('row');
			    	$r_first_number = $portraitrow->item(0)->nodeValue;
			    	$r_second_number = 90;
			    	$r_sum_total = $r_second_number * $r_first_number;
		
			    	echo '<div class="portrait" style="background:url(imgs/'.$portraitid->item(0)->nodeValue.'-90.jpg) -'.$c_sum_total.'px -'.$r_sum_total.'px no-repeat"></div>';
			    	echo '<div class="title-holder">';
			    		echo '<div class="name"><h1>'.$bnetname.'</h1></div>';
			    		echo '<div class="region">'.$region.' LADDER</div>';
			    		echo '<div class="achiev"><span>Achievements:</span> '.$achievpoints->item(0)->nodeValue.'pts</div>';
			    		echo '<div class="links"><a href="http://sc2ranks.com/'.$region.'/'.$bnetid.'/'.$bnetname.'" target="_blank"><img src="imgs/sc2ranks.png" width="30"/></a><a href="http://battle.net/sc2/profile/'.$bnetid.'/1/'.$bnetname.'/" target="_blank"><img src="imgs/battlenet.png" width="30"/></a></div>';
			    		echo '<div class="clear"></div>';
			    	echo '</div>';
			    	echo '<div class="clear"></div>';	
		
			    echo '</div>';
			} // End Foreach
		
			echo '<div class="random-ranks">';

		// Parse 1V1 Rank

		echo '<div class="full-ranks">';
			echo '<h2>Solo Ranks</h2>';

			$fichier1v1 = 'http://sc2ranks.com/api/char/teams/'.$region.'/'.$bnetname.'!'.$bnetid.'/1/0.xml?appKey='.$yoururl;
			
			$dom1v1 = new DOMDocument();
			if (!$dom1v1->load($fichier1v1)) {
				die('Impossible de charger le fichier XML');
			}

			$itemList1v1 = $dom1v1->getElementsByTagName('team');
			if ($itemList1v1->length > 0) {
				foreach ($itemList1v1 as $item1v1) {
					echo '<div class="rank-holder">'."\n";
	
					$league1v1 = $item1v1->getElementsByTagName('league');
					$rank1v1 = $item1v1->getElementsByTagName('division-rank');
					$favrace1v1 =  $item1v1->getElementsByTagName('fav-race');
					$division1v1 =  $item1v1->getElementsByTagName('division');
					$worldrank1v1 =  $item1v1->getElementsByTagName('world-rank');
					$regionrank1v1 =  $item1v1->getElementsByTagName('region-rank');
					$wins1v1 = $item1v1->getElementsByTagName('wins');
					$losses1v1 = $item1v1->getElementsByTagName('losses');
    	
    	if ($league1v1->item(0)->nodeValue == 'grandmaster') {
    	
    		if (($rank1v1->item(0)->nodeValue >= 1) && ($rank1v1->item(0)->nodeValue <= 16)) {
		    	echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-1.png"/></div>';
		    } 
		    elseif (($rank1v1->item(0)->nodeValue >= 17) && ($rank1v1->item(0)->nodeValue <= 50))  {
				echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-2.png"/></div>';
			} 
			elseif (($rank1v1->item(0)->nodeValue >= 51) && ($rank1v1->item(0)->nodeValue <= 100))  {
				echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-3.png"/></div>';
			} 
			elseif (($rank1v1->item(0)->nodeValue >= 101) && ($rank1v1->item(0)->nodeValue <= 200))  {
				echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-4.png"/></div>';
			}
		} else {
			if (($rank1v1->item(0)->nodeValue >= 1) && ($rank1v1->item(0)->nodeValue <= 8)) {
		    	echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-1.png"/></div>';
		    } 
		    elseif (($rank1v1->item(0)->nodeValue >= 9) && ($rank1v1->item(0)->nodeValue <= 25))  {
				echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-2.png"/></div>';
			} 
			elseif (($rank1v1->item(0)->nodeValue >= 26) && ($rank1v1->item(0)->nodeValue <= 50))  {
				echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-3.png"/></div>';
			} 
			elseif (($rank1v1->item(0)->nodeValue >= 51) && ($rank1v1->item(0)->nodeValue <= 100))  {
				echo ' <div class="rank-icon"><img src="imgs/'.$league1v1->item(0)->nodeValue.'-4.png"/></div>';
			}
		}
		
	    echo '<div class="infos">';
	    echo '<div class="bracket">1v1</div>';
    	echo '<div class="rank"><span style="background:url(imgs/race-'.$favrace1v1->item(0)->nodeValue.'.png) top left no-repeat;">RANK</span>'.$rank1v1->item(0)->nodeValue.'</div>';
	    echo '<div class="division">'.$division1v1->item(0)->nodeValue.'</div>';
	    echo '<div class="worldrank">World <span>#'.$worldrank1v1->item(0)->nodeValue.'</span></div>';
	    echo '<div class="regionrank">Region <span>#'.$regionrank1v1->item(0)->nodeValue.'</span></div>';
	    
	    if ($league1v1->item(0)->nodeValue == 'master' || $league1v1->item(0)->nodeValue == 'grandmaster') {
    		$Pourcent1v1 =  $wins1v1->item(0)->nodeValue * 100 / ($wins1v1->item(0)->nodeValue + $losses1v1->item(0)->nodeValue);
    		if ($Pourcent1v1 == 0) {
	    		//
    		} else {
    			echo '<div class="winrate"><div class="rate" style="width:'.$Pourcent1v1.'%;"><span>WINRATE: '.(int)$Pourcent1v1.'%</span></div></div>';
    		}
    	}
    	
    	echo '</div>';
    
    echo '</div>'."\n";
    }
} else {
	echo '<div class="rank-holder">';
		echo '<div class="rank-icon"><img src="imgs/norank.png"/></div>';
		echo '<div class="infos">';
			echo '<div class="bracket">1v1</div>';
			echo '<div class="norank"><span>NOT RANKED</span></div>';
			echo '<div class="clear"></div>';
		echo '</div>';
	echo '</div>';
}
/* PARSE 2V2 RANDOM XML */

$fichier2v2 = 'http://sc2ranks.com/api/char/teams/'.$region.'/'.$bnetname.'!'.$bnetid.'/2/1.xml?appKey='.$yoururl;
$dom2v2 = new DOMDocument();
if (!$dom2v2->load($fichier2v2)) {
    die('Impossible de charger le fichier XML');
}

$itemList2v2 = $dom2v2->getElementsByTagName('team');
if ($itemList2v2->length > 0) {
	foreach ($itemList2v2 as $item2v2) {
	echo '<div class="rank-holder">'."\n";
    	
    	$league2v2 = $item2v2->getElementsByTagName('league');
    	$rank2v2 = $item2v2->getElementsByTagName('division-rank');
    	$favrace2v2 =  $item2v2->getElementsByTagName('fav-race');
    	$division2v2 =  $item2v2->getElementsByTagName('division');
    	$worldrank2v2 =  $item2v2->getElementsByTagName('world-rank');
    	$regionrank2v2 =  $item2v2->getElementsByTagName('region-rank');
    	$wins2v2 = $item2v2->getElementsByTagName('wins');
    	$losses2v2 = $item2v2->getElementsByTagName('losses');
    	
    	if (($rank2v2->item(0)->nodeValue >= 1) && ($rank2v2->item(0)->nodeValue <= 8)) {
		    echo ' <div class="rank-icon"><img src="imgs/'.$league2v2->item(0)->nodeValue.'-1.png"/></div>'; // TOP 8
		} 
		elseif (($rank2v2->item(0)->nodeValue >= 9) && ($rank2v2->item(0)->nodeValue <= 25))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league2v2->item(0)->nodeValue.'-2.png"/></div>';
		} 
		elseif (($rank2v2->item(0)->nodeValue >= 26) && ($rank2v2->item(0)->nodeValue <= 50))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league2v2->item(0)->nodeValue.'-3.png"/></div>';
		} 
		elseif (($rank2v2->item(0)->nodeValue >= 51) && ($rank2v2->item(0)->nodeValue <= 100))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league2v2->item(0)->nodeValue.'-4.png"/></div>';
		}
	    echo '<div class="infos">';
	    echo '<div class="bracket">2v2</div>';
    	echo '<div class="rank"><span style="background:url(imgs/race-'.$favrace2v2->item(0)->nodeValue.'.png) top left no-repeat;">RANK</span>'.$rank2v2->item(0)->nodeValue.'</div>';
	    echo '<div class="division">'.$division2v2->item(0)->nodeValue.'</div>';
	    echo '<div class="worldrank">World <span>#'.$worldrank2v2->item(0)->nodeValue.'</span></div>';
	    echo '<div class="regionrank">Region <span>#'.$regionrank2v2->item(0)->nodeValue.'</span></div>';
    	
    	if ($league2v2->item(0)->nodeValue == 'master' || $league2v2->item(0)->nodeValue == 'grandmaster') {
    		$Pourcent2v2 =  $wins2v2->item(0)->nodeValue * 100 / ($wins2v2->item(0)->nodeValue + $losses2v2->item(0)->nodeValue);
    		if ($Pourcent2v2 == 0) {
	    		// Disable if 0%
    		} else {
    			echo '<div class="winrate"><div class="rate" style="width:'.$Pourcent2v2.'%;"><span>WINRATE: '.(int)$Pourcent2v2.'%</span></div></div>';
    		}
    	}
    	
    	echo '</div>';
    
    echo '</div>'."\n";
    }
} else {
	echo '<div class="rank-holder">';
		echo '<div class="rank-icon"><img src="imgs/norank.png"/></div>';
		echo '<div class="infos">';
			echo '<div class="bracket">2v2</div>';
			echo '<div class="norank"><span>NOT RANKED</span></div>';
			echo '<div class="clear"></div>';
		echo '</div>';
	echo '</div>';
}

/* PARSE 3V3 RANDOM XML */

$fichier3v3 = 'http://sc2ranks.com/api/char/teams/'.$region.'/'.$bnetname.'!'.$bnetid.'/3/1.xml?appKey='.$yoururl;
$dom3v3 = new DOMDocument();
if (!$dom3v3->load($fichier3v3)) {
    die('Impossible de charger le fichier XML');
}

$itemList3v3 = $dom3v3->getElementsByTagName('team');
if ($itemList3v3->length > 0) {
foreach ($itemList3v3 as $item3v3) {
	echo '<div class="rank-holder">'."\n";
    	
    	$rank3v3 = $item3v3->getElementsByTagName('division-rank');
    	$league3v3 = $item3v3->getElementsByTagName('league');
    	$favrace3v3 =  $item3v3->getElementsByTagName('fav-race');
    	$division3v3 =  $item3v3->getElementsByTagName('division');
    	$worldrank3v3 =  $item3v3->getElementsByTagName('world-rank');
    	$regionrank3v3 =  $item3v3->getElementsByTagName('region-rank');
    	$wins3v3 = $item3v3->getElementsByTagName('wins');
    	$losses3v3 = $item3v3->getElementsByTagName('losses');
    
    	if (($rank3v3->item(0)->nodeValue >= 1) && ($rank3v3->item(0)->nodeValue <= 8)) {
		    echo ' <div class="rank-icon"><img src="imgs/'.$league3v3->item(0)->nodeValue.'-1.png"/></div>'; // TOP 8
		} 
		elseif (($rank3v3->item(0)->nodeValue >= 9) && ($rank3v3->item(0)->nodeValue <= 25))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league3v3->item(0)->nodeValue.'-2.png"/></div>';
		} 
		elseif (($rank3v3->item(0)->nodeValue >= 26) && ($rank3v3->item(0)->nodeValue <= 50))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league3v3->item(0)->nodeValue.'-3.png"/></div>';
		} 
		elseif (($rank3v3->item(0)->nodeValue >= 51) && ($rank3v3->item(0)->nodeValue <= 100))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league3v3->item(0)->nodeValue.'-4.png"/></div>';
		}
	    echo '<div class="infos">';
	    echo '<div class="bracket">3v3</div>';
    	echo '<div class="rank"><span style="background:url(imgs/race-'.$favrace3v3->item(0)->nodeValue.'.png) top left no-repeat;">RANK</span>'.$rank3v3->item(0)->nodeValue.'</div>';
	    echo '<div class="division">'.$division3v3->item(0)->nodeValue.'</div>';
	    echo '<div class="worldrank">World <span>#'.$worldrank3v3->item(0)->nodeValue.'</span></div>';
	    echo '<div class="regionrank">Region <span>#'.$regionrank3v3->item(0)->nodeValue.'</span></div>';
	    
	    if ($league3v3->item(0)->nodeValue == 'master' || $league3v3->item(0)->nodeValue == 'grandmaster') {
    		$Pourcent3v3 =  $wins3v3->item(0)->nodeValue * 100 / ($wins3v3->item(0)->nodeValue + $losses3v3->item(0)->nodeValue);
    		if ($Pourcent3v3 == 0) {
	    		//
    		} else {
    			echo '<div class="winrate"><div class="rate" style="width:'.$Pourcent3v3.'%;"><span>WINRATE: '.(int)$Pourcent3v3.'%</span></div></div>';
    		}
    	}
	    
    	echo '</div>';
    
    
    echo '</div>'."\n";
    }
} else {
	echo '<div class="rank-holder">';
		echo '<div class="rank-icon"><img src="imgs/norank.png"/></div>';
		echo '<div class="infos">';
			echo '<div class="bracket">3v3</div>';
			echo '<div class="norank"><span>NOT RANKED</span></div>';
			echo '<div class="clear"></div>';
		echo '</div>';
	echo '</div>';
}

/* PARSE 4V4 RANDOM XML */

$fichier4v4 = 'http://sc2ranks.com/api/char/teams/'.$region.'/'.$bnetname.'!'.$bnetid.'/4/1.xml?appKey='.$yoururl;
$dom4v4 = new DOMDocument();
if (!$dom4v4->load($fichier4v4)) {
    die('Impossible de charger le fichier XML');
}

$itemList4v4 = $dom4v4->getElementsByTagName('team');
if ($itemList4v4->length > 0) {
foreach ($itemList4v4 as $item4v4) {
	echo '<div class="rank-holder">'."\n";
    	
    	$league4v4 = $item4v4->getElementsByTagName('league');
    	$rank4v4 = $item4v4->getElementsByTagName('division-rank');
    	$favrace4v4 =  $item4v4->getElementsByTagName('fav-race');
    	$division4v4 =  $item4v4->getElementsByTagName('division');
    	$worldrank4v4 =  $item4v4->getElementsByTagName('world-rank');
    	$regionrank4v4 =  $item4v4->getElementsByTagName('region-rank');
    	$wins4v4 = $item4v4->getElementsByTagName('wins');
    	$losses4v4 = $item4v4->getElementsByTagName('losses');
    	
    	if (($rank4v4->item(0)->nodeValue >= 1) && ($rank4v4->item(0)->nodeValue <= 8)) {
		    echo ' <div class="rank-icon"><img src="imgs/'.$league4v4->item(0)->nodeValue.'-1.png"/></div>'; // TOP 8
		} 
		elseif (($rank4v4->item(0)->nodeValue >= 9) && ($rank4v4->item(0)->nodeValue <= 25))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league4v4->item(0)->nodeValue.'-2.png"/></div>';
		} 
		elseif (($rank4v4->item(0)->nodeValue >= 26) && ($rank4v4->item(0)->nodeValue <= 50))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league4v4->item(0)->nodeValue.'-3.png"/></div>';
		} 
		elseif (($rank4v4->item(0)->nodeValue >= 51) && ($rank4v4->item(0)->nodeValue <= 100))  {
			echo ' <div class="rank-icon"><img src="imgs/'.$league4v4->item(0)->nodeValue.'-4.png"/></div>';
		}
	    echo '<div class="infos">';
	    echo '<div class="bracket">4v4</div>';
    	echo '<div class="rank"><span style="background:url(imgs/race-'.$favrace4v4->item(0)->nodeValue.'.png) top left no-repeat;">RANK</span>'.$rank4v4->item(0)->nodeValue.'</div>';
	    echo '<div class="division">'.$division4v4->item(0)->nodeValue.'</div>';
	    echo '<div class="worldrank">World <span>#'.$worldrank4v4->item(0)->nodeValue.'</span></div>';
	    echo '<div class="regionrank">Region <span>#'.$regionrank4v4->item(0)->nodeValue.'</span></div>';
	    
	    if ($league4v4->item(0)->nodeValue == 'master' || $league4v4->item(0)->nodeValue == 'grandmaster') {
    		$Pourcent4v4 = $wins4v4->item(0)->nodeValue * 100 / ($wins4v4->item(0)->nodeValue + $losses4v4->item(0)->nodeValue);
    		if ($Pourcent4v4 == 0) {
	    		//
    		} else {
    			echo '<div class="winrate"><div class="rate" style="width:'.$Pourcent4v4.'%;"><span>WINRATE: '.(int)$Pourcent4v4.'%</span></div></div>';
    		}
    	}
	    
    	echo '</div>';
    
    
    echo '</div>'."\n";
    }
} else {
	echo '<div class="rank-holder">';
		echo '<div class="rank-icon"><img src="imgs/norank.png"/></div>';
		echo '<div class="infos">';
			echo '<div class="bracket">4v4</div>';
			echo '<div class="norank"><span>NOT RANKED</span></div>';
			echo '<div class="clear"></div>';
		echo '</div>';
	echo '</div>';
}

echo '<div class="clear"></div></div>'."\n";




/* ====================================================== */
/* FULL 2V2 LIST ======================================== */
/* ====================================================== */

$fichierfull2v2 = 'http://sc2ranks.com/api/char/teams/'.$region.'/'.$bnetname.'!'.$bnetid.'/2/0.xml?appKey='.$yoururl;
$domfull2v2 = new DOMDocument();
if (!$domfull2v2->load($fichierfull2v2)) {
    die('Impossible de charger le fichier XML');
}

$itemListfull2v2 = $domfull2v2->getElementsByTagName('team');
if ($itemListfull2v2->length > 0) {
	echo '<div class="clear"></div><div class="full-ranks"><h2>2v2 Teams Ranks</h2>';
	foreach ($itemListfull2v2 as $itemfull2v2) {
		echo '<div class="rank-full-holder">'."\n";
    	
    	$leaguefull2v2 = $itemfull2v2->getElementsByTagName('league');
    	$rankfull2v2 = $itemfull2v2->getElementsByTagName('division-rank');
    	$favraceme2v2 =  $itemfull2v2->getElementsByTagName('fav-race');
    	$divrankfull2v2 =  $itemfull2v2->getElementsByTagName('division-rank');
    	$divisionfull2v2 =  $itemfull2v2->getElementsByTagName('division');
    	$worldrankfull2v2 =  $itemfull2v2->getElementsByTagName('world-rank');
    	$regionrankfull2v2 =  $itemfull2v2->getElementsByTagName('region-rank');
    	$winsfull2v2 = $itemfull2v2->getElementsByTagName('wins');
    	$lossesfull2v2 = $itemfull2v2->getElementsByTagName('losses');
    	// Displaying Rank icon
    	if ($leaguefull2v2->length > 0) {
        	if (($rankfull2v2->item(0)->nodeValue >= 1) && ($rankfull2v2->item(0)->nodeValue <= 8)) {
		    	echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull2v2->item(0)->nodeValue.'-1.png"/></div>'; // TOP 8
		    } 
		    elseif (($rankfull2v2->item(0)->nodeValue >= 9) && ($rankfull2v2->item(0)->nodeValue <= 25))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull2v2->item(0)->nodeValue.'-2.png"/></div>';
			} 
		    elseif (($rankfull2v2->item(0)->nodeValue >= 26) && ($rankfull2v2->item(0)->nodeValue <= 50))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull2v2->item(0)->nodeValue.'-3.png"/></div>';
			} 
		    elseif (($rankfull2v2->item(0)->nodeValue >= 51) && ($rankfull2v2->item(0)->nodeValue <= 100))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull2v2->item(0)->nodeValue.'-4.png"/></div>';
			}
        }
    	
    	echo '<div class="members">';
    	// Displaying division rank with fav race
    	echo '<h3><span style="background:url(imgs/race-'.$favraceme2v2->item(0)->nodeValue.'.png) top left no-repeat;">RANK</span> '.$divrankfull2v2->item(0)->nodeValue.'</h3>';
    	//displaying division
	    echo '<div class="division">'.$divisionfull2v2->item(0)->nodeValue.'</div>';
	    // displaying worldrank
	    echo '<div class="worldrank">World <span>#'.$worldrankfull2v2->item(0)->nodeValue.'</span></div>';
	    //displaying region rank
	    echo '<div class="regionrank">Region <span>#'.$regionrankfull2v2->item(0)->nodeValue.'</span></div>';
	    // displaying winrate for master & grandmaster
	    if ($leaguefull2v2->item(0)->nodeValue == 'master' || $leaguefull2v2->item(0)->nodeValue == 'grandmaster') {
    		$Pourcentfull2v2 = $winsfull2v2->item(0)->nodeValue * 100 / ($winsfull2v2->item(0)->nodeValue + $lossesfull2v2->item(0)->nodeValue);
    		if ($Pourcentfull2v2 == 0) {
	    		//
    		} else {
    			echo '<div class="winrate"><div class="rate" style="width:'.$Pourcentfull2v2.'%;"><span>WINRATE: '.(int)$Pourcentfull2v2.'%</span></div></div>';
    		}
    	}
	    //displaying team mates
    	echo '<ul>';
    	echo '<li><span>'.$bnetname.'</span></li>';
    	$memberListfull2v2 = $itemfull2v2->getElementsByTagName('member');
    	foreach ($memberListfull2v2 as $memberfull2v2) {
    	
    		$namefull2v2 = $memberfull2v2->getElementsByTagName('name');
    		$bnetidfull2v2 = $memberfull2v2->getElementsByTagName('bnet-id');
    		echo '<li>';
	    	echo '<span><a href="rank.php?bnetid='.$bnetidfull2v2->item(0)->nodeValue.'&bnetname='.$namefull2v2->item(0)->nodeValue.'&region='.$region.'">'.$namefull2v2->item(0)->nodeValue.'</a></span>';
	    	echo '</li>';
    	}
    	echo '</ul></div>';
    
    echo '</div>'."\n";
    }
    echo '</div>';
} else {
	echo '';
}






/* ====================================================== */
/* FULL 3V3 LIST ======================================== */
/* ====================================================== */

$fichierfull3v3 = 'http://sc2ranks.com/api/char/teams/'.$region.'/'.$bnetname.'!'.$bnetid.'/3/0.xml?appKey='.$yoururl;
$domfull3v3 = new DOMDocument();
if (!$domfull3v3->load($fichierfull3v3)) {
    die('Impossible de charger le fichier XML');
}

$itemListfull3v3 = $domfull3v3->getElementsByTagName('team');
if ($itemListfull3v3->length > 0) {
	echo '<div class="clear"></div><div class="full-ranks"><h2>3v3 Teams Ranks</h2>';
	foreach ($itemListfull3v3 as $itemfull3v3) {
		echo '<div class="rank-full-holder">'."\n";
    	
    	$leaguefull3v3 		= $itemfull3v3->getElementsByTagName('league');
    	$rankfull3v3 		= $itemfull3v3->getElementsByTagName('division-rank');
    	$favraceme3v3 		= $itemfull3v3->getElementsByTagName('fav-race');
    	$divrankfull3v3 	= $itemfull3v3->getElementsByTagName('division-rank');
    	$divisionfull3v3 	= $itemfull3v3->getElementsByTagName('division');
    	$worldrankfull3v3 	= $itemfull3v3->getElementsByTagName('world-rank');
    	$regionrankfull3v3 	= $itemfull3v3->getElementsByTagName('region-rank');
    	$winsfull3v3 		= $itemfull3v3->getElementsByTagName('wins');
    	$lossesfull3v3 		= $itemfull3v3->getElementsByTagName('losses');
    	
    	if ($leaguefull3v3->length > 0) {
        	if (($rankfull3v3->item(0)->nodeValue >= 1) && ($rankfull3v3->item(0)->nodeValue <= 8)) {
		    	echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull3v3->item(0)->nodeValue.'-1.png"/></div>'; // TOP 8
		    } 
		    elseif (($rankfull3v3->item(0)->nodeValue >= 9) && ($rankfull3v3->item(0)->nodeValue <= 25))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull3v3->item(0)->nodeValue.'-2.png"/></div>';
			} 
		    elseif (($rankfull3v3->item(0)->nodeValue >= 26) && ($rankfull3v3->item(0)->nodeValue <= 50))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull3v3->item(0)->nodeValue.'-3.png"/></div>';
			} 
		    elseif (($rankfull3v3->item(0)->nodeValue >= 51) && ($rankfull3v3->item(0)->nodeValue <= 100))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull3v3->item(0)->nodeValue.'-4.png"/></div>';
			}
        }
        
        echo '<div class="members">';
    	// Displaying division rank with fav race
    	echo '<h3><span style="background:url(imgs/race-'.$favraceme3v3->item(0)->nodeValue.'.png) top left no-repeat;">RANK</span> '.$divrankfull3v3->item(0)->nodeValue.'</h3>';
    	//displaying division
	    echo '<div class="division">'.$divisionfull3v3->item(0)->nodeValue.'</div>';
	    // displaying worldrank
	    echo '<div class="worldrank">World <span>#'.$worldrankfull3v3->item(0)->nodeValue.'</span></div>';
	    //displaying region rank
	    echo '<div class="regionrank">Region <span>#'.$regionrankfull3v3->item(0)->nodeValue.'</span></div>';
	    // displaying winrate for master & grandmaster
	    if ($leaguefull3v3->item(0)->nodeValue == 'master' || $leaguefull3v3->item(0)->nodeValue == 'grandmaster') {
    		$Pourcentfull3v3 = $winsfull3v3->item(0)->nodeValue * 100 / ($winsfull3v3->item(0)->nodeValue + $lossesfull3v3->item(0)->nodeValue);
    		if ($Pourcentfull3v3 == 0) {
	    		//
    		} else {
    			echo '<div class="winrate"><div class="rate" style="width:'.$Pourcentfull3v3.'%;"><span>WINRATE: '.(int)$Pourcentfull3v3.'%</span></div></div>';
    		}
    	}
	    //displaying team mates
    	echo '<ul>';
    	echo '<li><span>'.$bnetname.'</span></li>';
    	$memberListfull3v3 = $itemfull3v3->getElementsByTagName('member');
    	foreach ($memberListfull3v3 as $memberfull3v3) {
    	
    		$namefull3v3 = $memberfull3v3->getElementsByTagName('name');
    		$bnetidfull3v3 = $memberfull3v3->getElementsByTagName('bnet-id');
    		//$favracefull3v3 =  $memberfull3v3->getElementsByTagName('fav-race');
	    	echo '<li>';
	    	echo '<span><a href="rank.php?bnetid='.$bnetidfull3v3->item(0)->nodeValue.'&bnetname='.$namefull3v3->item(0)->nodeValue.'&region='.$region.'">'.$namefull3v3->item(0)->nodeValue.'</a></span>';
	    	echo '</li>';
    	}
    	echo '</ul></div>';
    
    echo '</div>'."\n";
    }
    echo '</div>';
} else {
	echo '';
}

/* ====================================================== */
/* FULL 4V4 LIST ======================================== */
/* ====================================================== */

$fichierfull4v4 = 'http://sc2ranks.com/api/char/teams/'.$region.'/'.$bnetname.'!'.$bnetid.'/4/0.xml?appKey='.$yoururl;
$domfull4v4 = new DOMDocument();
if (!$domfull4v4->load($fichierfull4v4)) {
    die('Impossible de charger le fichier XML');
}

$itemListfull4v4 = $domfull4v4->getElementsByTagName('team');
if ($itemListfull4v4->length > 0) {
	echo '<div class="clear"></div><div class="full-ranks"><h2>4v4 Teams Ranks</h2>';
	foreach ($itemListfull4v4 as $itemfull4v4) {
		echo '<div class="rank-full-holder">'."\n";
    	
    	$leaguefull4v4 = $itemfull4v4->getElementsByTagName('league');
    	$rankfull4v4 = $itemfull4v4->getElementsByTagName('division-rank');
    	$favraceme4v4 =  $itemfull4v4->getElementsByTagName('fav-race');
    	$divrankfull4v4 =  $itemfull4v4->getElementsByTagName('division-rank');
    	$divisionfull4v4 	= $itemfull4v4->getElementsByTagName('division');
    	$worldrankfull4v4 	= $itemfull4v4->getElementsByTagName('world-rank');
    	$regionrankfull4v4 	= $itemfull4v4->getElementsByTagName('region-rank');
    	$winsfull4v4 		= $itemfull4v4->getElementsByTagName('wins');
    	$lossesfull4v4 		= $itemfull4v4->getElementsByTagName('losses');
    	
    	if ($leaguefull4v4->length > 0) {
        	if (($rankfull4v4->item(0)->nodeValue >= 1) && ($rankfull4v4->item(0)->nodeValue <= 8)) {
		    	echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull4v4->item(0)->nodeValue.'-1.png"/></div>'; // TOP 8
		    } 
		    elseif (($rankfull4v4->item(0)->nodeValue >= 9) && ($rankfull4v4->item(0)->nodeValue <= 25))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull4v4->item(0)->nodeValue.'-2.png"/></div>';
			} 
		    elseif (($rankfull4v4->item(0)->nodeValue >= 26) && ($rankfull4v4->item(0)->nodeValue <= 50))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull4v4->item(0)->nodeValue.'-3.png"/></div>';
			} 
		    elseif (($rankfull4v4->item(0)->nodeValue >= 51) && ($rankfull4v4->item(0)->nodeValue <= 100))  {
				echo ' <div class="rank-full-icon"><img src="imgs/'.$leaguefull4v4->item(0)->nodeValue.'-4.png"/></div>';
			}
        }
    	
    	echo '<div class="members">';
    	// Displaying division rank with fav race
    	echo '<h3><span style="background:url(imgs/race-'.$favraceme4v4->item(0)->nodeValue.'.png) top left no-repeat;">RANK</span> '.$divrankfull4v4->item(0)->nodeValue.'</h3>';
    	//displaying division
	    echo '<div class="division">'.$divisionfull4v4->item(0)->nodeValue.'</div>';
	    // displaying worldrank
	    echo '<div class="worldrank">World <span>#'.$worldrankfull4v4->item(0)->nodeValue.'</span></div>';
	    //displaying region rank
	    echo '<div class="regionrank">Region <span>#'.$regionrankfull4v4->item(0)->nodeValue.'</span></div>';
	    // displaying winrate for master & grandmaster
	    if ($leaguefull4v4->item(0)->nodeValue == 'master' || $leaguefull4v4->item(0)->nodeValue == 'grandmaster') {
    		$Pourcentfull4v4 = $winsfull4v4->item(0)->nodeValue * 100 / ($winsfull4v4->item(0)->nodeValue + $lossesfull4v4->item(0)->nodeValue);
    		if ($Pourcentfull4v4 == 0) {
	    		//
    		} else {
    			echo '<div class="winrate"><div class="rate" style="width:'.$Pourcentfull4v4.'%;"><span>WINRATE: '.(int)$Pourcentfull4v4.'%</span></div></div>';
    		}
    	}
	    //displaying team mates
    	echo '<ul>';
    	echo '<li><span>'.$bnetname.'</span></li>';
    	$memberListfull4v4 = $itemfull4v4->getElementsByTagName('member');
    	foreach ($memberListfull4v4 as $memberfull4v4) {
    	
    		$namefull4v4 = $memberfull4v4->getElementsByTagName('name');
    		$bnetidfull4v4 = $memberfull4v4->getElementsByTagName('bnet-id');
	    	echo '<li>';
	    	echo '<span><a href="rank.php?bnetid='.$bnetidfull4v4->item(0)->nodeValue.'&bnetname='.$namefull4v4->item(0)->nodeValue.'&region='.$region.'">'.$namefull4v4->item(0)->nodeValue.'</a></span>';
	    	echo '</li>';
    	}
    	echo '</ul></div>';
    
    echo '</div>'."\n";
    }
    
    echo '</div>';
} else {
	echo '';
}
 
 
echo '</div>';


}
// include custom footer
include('inc-footer.php');
?>
