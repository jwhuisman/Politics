<?php
require(ROOT . "model/PartiesModel.php");
function index()
{
	echo "No Index";
}

function getParties($student_number){
	if(!empty($student_number)){
		if(!studentHasVoted($student_number)){
			$student = getStudent($student_number);
			if(is_array($student)){
				$result = Array();
				$result["firstname"] = $student["firstname"];
				$result["lastname"] = $student["lastname"];
				$result["student_number"] = $student_number;
				$result["parties"] = getPartiesWithExclude($student["party"]);
				echo json_encode($result);
			} else {
				echo "No student";
			}			
		} else {
			echo "Already voted";
		}
	}
}

function vote($student_number, $party){

	doVote($student_number, $party);

	echo "OK";
}

function result(){
	render('result/show');
}

function getResult(){
	$votes = getResultByVotes();

	$result = array();
	$result["total_votes"] = 0;
	foreach($votes as $vote){
		$result["total_votes"] += $vote['votes'];
	}
	$result["votes"] = $votes;


	echo json_encode($result);
}