<?php
$conn = new mysqli("localhost","root","","GamesStudio") OR die("Error: ".mysqli_error($conn));
session_start();
if(isset($_POST['save']))
{
	if(!empty($_POST['gamename']) && !empty('status'))
	{
		$gamename = $_POST['gamename'];
		$status = $_POST['status'];
		$iQuery = "INSERT INTO tbl_games(gamename, status) VALUES (?, ?)";
		$stmt = $conn->prepare($iQuery);
		$stmt->bind_param("ss", $gamename, $status);
		if($stmt->execute())
		{
			# Alert Message
			$_SESSION['msg'] = "New game is successfully inserted.";
			$_SESSION['alert'] = "alert alert-success";
		}
		$stmt->close();
		$conn->close();
	}
	else
	{
		# Alert Message
		$_SESSION['msg'] = "Game name and Status should not be empty.";
		$_SESSION['alert'] = "alert alert-warning";
	}
	header("location: index.php");
}
# Delete data from selected entry (data)
if(isset($_POST['delete']))
{
	$id = $_POST['delete'];
	$dQuery = "DELETE FROM tbl_games WHERE id = ?";
	$stmt = $conn->prepare($dQuery);
	$stmt->bind_param('i', $id);
	if($stmt->execute())
	{
		$_SESSION['msg'] = "Selected game is successfully deleted.";
		$_SESSION['alert'] = "alert alert-danger";
	}
	$stmt->close();
	$conn->close();
	header("location: index.php");
}
# Edit data from the server
if(isset($_POST['edit']))
{
	if(!empty($_POST['gamename']) && !empty('status'))
	{
		$gamename = $_POST['gamename'];
		$status = $_POST['status'];
		$id = $_POST['edit'];
		$uQuery = "UPDATE tbl_games SET gamename = ?, status = ? WHERE id = ?";
		$stmt = $conn->prepare($uQuery);
		$stmt->bind_param('ssi', $gamename, $status, $id);
		if($stmt->execute())
		{
			$_SESSION['msg'] = "Selected record is successfully updated.";
			$_SESSION['alert'] = "alert alert-success";
		}
		$stmt->close();
		$conn->close();
	}
	else
	{
		$_SESSION['msg'] = "Game name and Status should not be empty.";
		$_SESSION['alert'] = "alert alert-warning";
	}
	header("location: index.php");
}
?>