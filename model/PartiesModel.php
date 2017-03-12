<?php

	function getStudent($student_number){
		$db = openDatabaseConnection();
		$query = $db->prepare("SELECT * FROM students WHERE student_number = :student_number");
		$query->bindParam(":student_number", $student_number);
		$query->execute();
		return $query->fetchAll()[0];
	}

	function getPartiesWithExclude($exclude_id){
		$db = openDatabaseConnection();
		$query = $db->prepare("SELECT * FROM parties WHERE id <> :exclude_id ORDER BY RAND();");
		$query->bindParam(":exclude_id", $exclude_id);
		$query->execute();
		return $query->fetchAll();
	}

	function studentHasVoted($student_number){
		$db = openDatabaseConnection();
		$query = $db->prepare("SELECT * FROM votes WHERE student_number = :student_number");
		$query->bindParam(":student_number", $student_number);
		$query->execute();
		
		if(isset($query->fetch()['student_number'])){
			return true;
		} else {
			return false;
		}
		
	}

	function doVote($student_number, $party){
		if(!studentHasVoted($student_number)){
			$db = openDatabaseConnection();
			$query = $db->prepare("INSERT INTO votes (`student_number`, `party_id`) VALUES ( :student_number , :party )");
			$query->bindParam(":student_number", $student_number);
			$query->bindParam(":party", $party);
			$query->execute();
		}
		return true;		
	}

	function getResultByVotes(){
		$db = openDatabaseConnection();
		$query = $db->prepare("SELECT count(party_id) as `votes`, parties.name as name FROM `parties` LEFT JOIN votes ON parties.id = votes.party_id GROUP BY party_id, parties.name ORDER BY votes DESC, parties.name ASC");
		$query->execute();
		return $query->fetchAll();
	}