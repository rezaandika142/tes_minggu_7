<?php

// include "inc/connection.php";

// function delete_task($task_id){
//     include 'connection.php';
    
//     $sql = 'DELETE FROM tasks WHERE task_id = ?';
    
//     try {
//         $results = $db->prepare($sql);
//         $results->bindValue(1, $task_id, PDO::PARAM_INT);
//         $results->execute();
//     } catch (Exception $e) {
//         echo "Error!: " . $e->getMessage() . "<br />";
//         return false;
//     }
//     return true;
