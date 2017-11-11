<?php
class Verify extends DbConn
{
    public function verifyUser($uid, $email, $verify)
    {
        try {
            $vdb = new DbConn;
            $tbl_members = $vdb->tbl_members;
			$verr = '';

			//Check file to determine status
			$a_handle = fopen("/var/www/admin_list.txt","r");
			$a_stat = 0;
			$a_email = $email."\n";
			while($a_line = fgets($a_handle)) {	
					if($a_line == $a_email) {
							$a_stat = 1;
							fclose($a_handle);
							break;
					}
			}

			// prepare sql and bind parameters
			$vstmt = $vdb->conn->prepare('UPDATE '.$tbl_members.' SET verified = :verify, teacher_status = :stat WHERE id = :uid');
            $vstmt->bindParam(':uid', $uid);
			$vstmt->bindParam(':verify', $verify);
			$vstmt->bindParam(':stat', $a_stat);
            $vstmt->execute();

			if($a_stat) {
					$vstmt = $vdb->conn->prepare('INSERT INTO teachers (id) VALUES ( :uid)');
					$vstmt->bindParam(':uid', $uid);
					$vstmt->execute();
			} else {
					$vstmt = $vdb->conn->prepare('INSERT INTO students (id) VALUES ( :uid)');
					$vstmt->bindParam(':uid', $uid);
					$vstmt->execute();
			}
        } catch (PDOException $v) {

            $verr = 'Error: ' . $v->getMessage();

        }

    //Determines returned value ('true' or error code)
    $resp = ($verr == '') ? 'true' : $verr;

        return $resp;

    }
}
