var id = "0";
function scrollto(newclass,ele) {
	document.body.className = newclass;
	if (newclass == "bracket"){
		document.getElementById("navBracket").className = "icon-exchange icon-2x selected";
		document.getElementById("navBracket").style.display = 'block';
		document.getElementById("navBracket").innerHTML = "Brackets";
		document.getElementById("navInventory").className = "icon-briefcase icon-2x";
		document.getElementById("navInventory").style.display = 'block';
		document.getElementById("navAbout").className = "icon-question icon-2x";
		document.getElementById("navAbout").style.display = 'block';
		document.getElementById("navContact").className = "icon-comments icon-2x";
		document.getElementById("navContact").style.display = 'block';
		document.getElementById("team1").style.opacity = "1";
		document.getElementById("team1").style.cursor = "pointer";
		document.getElementById("team1").style.color = "#7a94ae";
		document.getElementById("team2").style.opacity = "1";
		document.getElementById("team2").style.cursor = "pointer";
		document.getElementById("team2").style.color = "#7a94ae";
	} else if (newclass == "inventory"){
		document.getElementById("navBracket").className = "icon-exchange icon-2x";
		document.getElementById("navInventory").className = "icon-briefcase icon-2x selected";
		document.getElementById("navAbout").className = "icon-question icon-2x";
		document.getElementById("navContact").className = "icon-comments icon-2x";
	} else if (newclass == "about"){
		document.getElementById("navBracket").className = "icon-exchange icon-2x";
		document.getElementById("navInventory").className = "icon-briefcase icon-2x";
		document.getElementById("navAbout").className = "icon-question icon-2x selected";
		document.getElementById("navContact").className = "icon-comments icon-2x";
	} else if (newclass == "contact"){
		document.getElementById("navBracket").className = "icon-exchange icon-2x";
		document.getElementById("navInventory").className = "icon-briefcase icon-2x";
		document.getElementById("navAbout").className = "icon-question icon-2x";
		document.getElementById("navContact").className = "icon-comments icon-2x selected";
	} else if (newclass == "matchup") {
		document.getElementById("navBracket").className = "icon-backward icon-2x";
		document.getElementById("navBracket").style.display = 'block';
		document.getElementById("navBracket").innerHTML = "Go Back";
		document.getElementById("navInventory").className = "icon-briefcase icon-2x";
		document.getElementById("navInventory").style.display = 'none';
		document.getElementById("navAbout").className = "icon-question icon-2x";
		document.getElementById("navAbout").style.display = 'none';
		document.getElementById("navContact").className = "icon-comments icon-2x";
		document.getElementById("navContact").style.display = 'none';
		//pull match data for selected matchup
		var id = ele.id;
		pullMatchup(id);
	}
	return false;
}
function pullMatchup(ID) {
	$.ajax({
		url: '../matchup.php',
		type: 'GET',
		dataType: "json",
		data: {
			matchup: ID
		},
		success: function(data) {
			console.log(data);
			var selectedMatch = data;
			var matchID = selectedMatch.id;
			var team1Name = selectedMatch.team1Name;
			var team2Name = selectedMatch.team2Name;
			var team1Logo = selectedMatch.team1Logo;
			var team2Logo = selectedMatch.team2Logo;
			var team1WinChance = selectedMatch.team1WinChance;
			var team2WinChance = selectedMatch.team2WinChance;
			var streamURL = selectedMatch.steamURL;
			var startTime = selectedMatch.startTime;
			document.getElementById("mTime").innerHTML = '<span class="highlight"> '+startTime+' </span>';
			document.getElementById("mLogo1").src = team1Logo;
			document.getElementById("mLogo2").src = team2Logo;
			document.getElementById("mName1").innerHTML = team1Name;
			document.getElementById("mName2").innerHTML = team2Name;
			document.getElementById("mWin1").innerHTML = team1WinChance + "%";
			document.getElementById("mWin2").innerHTML = team2WinChance + "%";
			//document.getElementById("mStreamURL").innerHTML = streamURL;
		},
		error: function (err) {
		   console.log(err);
		} 
	});
}
var team1 = false;
var team2 = false;
function pickedTeam1(){
	team1 = true;
	document.getElementById("team1").style.opacity = "0.8";
	document.getElementById("team1").style.cursor = "pointer";
	document.getElementById("team1").style.color = "green";	
	if (team2 == true) {
		team2 = false;
		document.getElementById("team2").style.opacity = "1";
		document.getElementById("team2").style.cursor = "pointer";
		document.getElementById("team2").style.color = "#7a94ae";
	}
}
function pickedTeam2(){
	team2 = true;
	document.getElementById("team2").style.opacity = "0.8";
	document.getElementById("team2").style.cursor = "pointer";
	document.getElementById("team2").style.color = "green";	
	if (team1 == true) {
		team1 = false;
		document.getElementById("team1").style.opacity = "1";
		document.getElementById("team1").style.cursor = "pointer";
		document.getElementById("team1").style.color = "#7a94ae";
	}
}