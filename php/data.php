<?Php
foreach ($users as $user) {

    $statement2 = $pdo->prepare("SELECT * FROM messages WHERE (incoming_id = {$user['unique_id']}
    OR outgoing_id = {$user['unique_id']}) AND (outgoing_id = {$outgoing_id} 
    OR incoming_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1");
    $statement2->execute();
    $msg = $statement2->fetch(PDO::FETCH_ASSOC);
    if (empty($msg)) {
        $result = "No message available";
    } else {
        $result = $msg['message'];
    }
    (strlen($result) > 28) ? $res =  substr($result, 0, 28) . '...' : $res = $result;
    if (isset($msg['outgoing_id'])) {
        ($outgoing_id === $msg['outgoing_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($user['status'] == "Offline now") ? $offline = "offline" : $offline = "";


    $output .= '<a href="chat.php?user_id= ' . $user['unique_id'] . '">
                <div class="content">
                  <img src="' . $user['img'] . '" alt="">
                  <div class="details">
                    <span>' . $user['fname'] . ' ' . $user['lname'] . '</span>
                    <p>' . $you . $res . '.</p>
                  </div>
                </div>
                <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
              </a>';
}
