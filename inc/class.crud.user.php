<?php
	class USER{
		
		public function read($link){
			$sql = "SELECT * FROM user";
			$sq = mysqli_query($link,$sql);
    		return $sq;
    	}

		public function find($link, $id){
			
			$id = mysqli_real_escape_string($link, $id);
			$sql = "SELECT * FROM user WHERE id = '$id' ";
			
			$sq = mysqli_query($link,$sql);
			$s = mysqli_fetch_array($sq);
    		return $s;
    	}
		
		public function delete($link, $id){
			$id = mysqli_real_escape_string($link, $id);
			$sql = "DELETE FROM user WHERE id = '$id' ";
			$sq = mysqli_query($link,$sql);
		}

		public function create($link, $name, $email, $startDate){
			$name = mysqli_real_escape_string($link, $name);
			$email = mysqli_real_escape_string($link, $email);
			$startDate = mysqli_real_escape_string($link, $startDate);

			$sql = "INSERT INTO user (name,email, startDate) values ('$name', '$email', '$startDate') ";
			$sq = mysqli_query($link,$sql);
		}

		public function update($link, $name, $email, $startDate, $id){
			$id = mysqli_real_escape_string($link, $id);
			$name = mysqli_real_escape_string($link, $name);
			$email = mysqli_real_escape_string($link, $email);
			$startDate = mysqli_real_escape_string($link, $startDate);

			$sql = "UPDATE user SET name = '$name', email = '$email', startDate = '$startDate' WHERE id = '$id' ";
			$sq = mysqli_query($link,$sql);
		}
		
	}
?>