<?php
$id = $GLOBALS['id'];
$this->db->reconnect();
$query = $this->db->query("select * from user where id_user = $id");
$row = $query->row_array();
$username = $row['username'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$website = $row['website'];
?>

    <table cellpadding="10">
      <tr><td>Username</td><td>:</td><td><?php echo $username; ?></td></tr>
      <tr><td>Sure Name</td><td>:</td><td><?php echo $name; ?></td></tr>
      <tr><td>Email</td><td>:</td><td><?php echo $email; ?></td></tr>
      <tr><td>Phone</td><td>:</td><td><?php echo $phone; ?></td></tr>
      <tr><td>Web Site</td><td>:</td><td><a href="<?php echo $website; ?>" target="blank"><?php echo $website; ?></a></td></tr>
    </table>
