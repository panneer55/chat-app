<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    require_once("../config.php");
    $output = '';
    $outgoing_id = $_POST['outgoing_id'];
    $incoming_id =  $_POST['incoming_id'];


    $statement = $pdo->prepare("SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_id WHERE (outgoing_id = {$outgoing_id} AND incoming_id = {$incoming_id})
    OR (outgoing_id = {$incoming_id} AND incoming_id = {$outgoing_id}) ORDER BY msg_id");
    $statement->execute();
    $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($messages)) {
        foreach ($messages as $message) {
            if ($message['outgoing_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>' . $message['message'] . '</p>
                            </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                            <img src="' . $message['img'] . '" alt="">
                            <div class="details">
                                <p>' . $message['message'] . '</p>
                            </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }

    echo $output;
}
