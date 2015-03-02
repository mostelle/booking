<?php

class bookit{

	protected $_user ='root';
	protected $_pass ='';
	protected $_dbh;
	protected static $_errors;

	public function __construct(){
		date_default_timezone_set('Europe/paris');
		setlocale(LC_TIME, "fr_FR");
		$this->_connex();
	}

	protected function _connex(){
		try {
		    $this->_dbh = new PDO('mysql:host=localhost;dbname=booking;charset=UTF8', $this->_user, $this->_pass, array(PDO::ATTR_PERSISTENT => true)); // sans charset=UTF8 = pas d'accents
		} catch (PDOException $e) {
		    print "Erreur !: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	public function setErrors($msg){
		self::$_errors = $msg;
	}

	public function getError(){
		return self::$_errors;
	}

	public function today(){
		$today = date('Y-m-d');
		return $today;
	}

	public function dateConvert($date){
		$newDate = array_reverse( explode('-', $date));
		$newDate = implode('/', $newDate);
		return $newDate;
	}

	public function getHostel(){
		$stmt = $this->_dbh->prepare('SELECT id,name,adresse FROM hostel');
		$stmt->execute();
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getRoom($idHostel){
		
		if (!is_int($idHostel)) {
            throw new Exception("Type invalide : '" . gettype($idHostel) . "', une valeur numérique est demandée.");
        }

		$stmt = $this->_dbh->prepare('SELECT id,number FROM room WHERE hotel_id=:hotelid');
		$stmt->bindparam(':hotelid',$idHostel,PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
	}

	public function isEmpty($idHostel,$dateStart,$dateEnd){
		
		if (!is_int($idHostel) && !is_int($dateStart) && !is_int($dateEnd)) {
            throw new Exception("Type invalide : '" . gettype($idHostel) . ' | ' . gettype($dateStart) . ' | ' . gettype($dateEnd) . "', une valeur numérique est demandée pour ces valeurs.");
        }
        $sql = 'SELECT DISTINCT room.id,room.number FROM room
				LEFT JOIN bookit ON room.id=bookit.room_id
				WHERE room.hotel_id=:hotelid
				AND ( :timestart <= bookit.start AND :timeend >= bookit.end )
				OR ( :timestart >= bookit.start AND :timeend <= bookit.end )';
				// Je dois admettre que j'ai 3 plombes à trouver la bonne formule pour créer cette requête…
				// Bien qu'elle paraît simple une fois terminé, j'ai dû poser des conditions sur papier.
				// Impossible à faire de tête. 

		$stmt = $this->_dbh->prepare($sql);
		$stmt->bindparam(':hotelid',$idHostel,PDO::PARAM_INT);
		$stmt->bindparam(':timestart',$dateStart,PDO::PARAM_INT);
		$stmt->bindparam(':timeend',$dateEnd,PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);
		return $result;
	}

	/* A VOIR COMPLETEMENT */
	public function isEmptyRoom($roomId,$dateStart,$dateEnd){
		
		if (!is_int($roomId) && !is_int($dateStart) && !is_int($dateEnd)) {
            throw new Exception("Type invalide : '" . gettype($roomId) . ' | ' . gettype($dateStart) . ' | ' . gettype($dateEnd) . "', une valeur numérique est demandée pour ces valeurs.");
        }
		
		$sql = 'SELECT room.id FROM room
				LEFT JOIN bookit ON :roomid=bookit.room_id
				WHERE ( :timestart <= bookit.start AND :timeend >= bookit.end )
				OR ( :timestart >= bookit.start AND :timeend <= bookit.end )';
		$stmt = $this->_dbh->prepare($sql);
		$stmt->bindparam(':roomid',$roomId,PDO::PARAM_INT);
		$stmt->bindparam(':timestart',$dateStart,PDO::PARAM_INT);
		$stmt->bindparam(':timeend',$dateEnd,PDO::PARAM_INT);
		$stmt->execute();
		
		if ( $stmt->fetchColumn() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function insertBooking($clientId,$roomId,$dateStart,$dateEnd){
		
		if (!is_int($clientId) && !is_int($roomId) && !is_int($dateStart) && !is_int($dateEnd)) {
            throw new Exception("Type invalide : '" . gettype($clientId) . ' | ' . gettype($roomId) . ' | ' . gettype($dateStart) . ' | ' . gettype($dateEnd) . "', une valeur numérique est demandée pour ces valeurs.");
        }

        $isEmptyRoom = $this->isEmptyRoom($roomId,$dateStart,$dateEnd);
        
        if ($isEmptyRoom == false){
			$sql = 'INSERT INTO bookit (client_id, creation, start, end, room_id)
					VALUES (:clientid, CURRENT_DATE(), :timestart, :timeend, :roomid)';
			$stmt = $this->_dbh->prepare($sql);
			$stmt->bindparam(':clientid',$clientId,PDO::PARAM_INT);
			$stmt->bindparam(':roomid',$roomId,PDO::PARAM_INT);
			$stmt->bindparam(':timestart',$dateStart,PDO::PARAM_INT);
			$stmt->bindparam(':timeend',$dateEnd,PDO::PARAM_INT);
			$stmt->execute();
			$count = $stmt->rowCount();
			return true;
		}else{
			return false;
		}
	}

	public function getClient($mail){

		$mail = trim($mail);
		
		if( filter_var($mail, FILTER_VALIDATE_EMAIL ) ){

			$stmt = $this->_dbh->prepare('SELECT id, name, mail FROM client WHERE mail=:clientmail');
			$stmt->bindparam(':clientmail',$mail);
			$stmt->execute();
			$count = $stmt->rowCount();

			if ($count == 1){
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result;
			}else{
				return false;
			}

		}else{
			return false;
		}

	}

	public function getPwd($mail,$pwd){

		$mail = trim($mail);
		
		if( filter_var($mail, FILTER_VALIDATE_EMAIL ) ){
	
			$pwd = trim($pwd);

			if ( isset($pwd) && !empty($pwd) ){

				$stmt = $this->_dbh->prepare('SELECT pwd FROM client WHERE mail=:clientmail');
				$stmt->bindparam(':clientmail',$mail);
				$stmt->execute();
				$count = $stmt->rowCount();

				if ($count == 1){

					$pwdResult = $stmt->fetch(PDO::FETCH_ASSOC);

					if ( password_verify($pwd, $pwdResult['pwd']) ){

						return true;

					}else{
						$this->setErrors("Identifiants non reconnus. Veuillez vérifiez votre saisie SVP.");
						return false;//mauvais pwd
					}

				}else{
					$this->setErrors("Adresse mail inexistante. Veuillez vérifiez votre saisie SVP.");
					return false;//mail inexistant ou en double
				}

			}else{
				$this->setErrors("Entrez SVP un mot de passe.");
				return false;//pwd non renseigné ou vide
			}

		}else{
			$this->setErrors("Votre adresse mail ne semble pas valide, veuillez vérifiez votre saisie SVP.");
			return false;//mail invalide
		}

	}

	public function createClient($name,$mail,$pwd){

		$mail = trim($mail);
		
		if( filter_var($mail, FILTER_VALIDATE_EMAIL ) ){

			$name = trim($name);
			$pwd = trim($pwd);
			
			if	( isset($name) && !empty($name) && is_string($name) && isset($pwd) && !empty($pwd) ){

				if ( (strlen($name)>=6) && (strlen($pwd)>=6) ){
				
					$stmt = $this->_dbh->prepare('SELECT mail FROM client WHERE mail=:clientmail');
					$stmt->bindparam(':clientmail',$mail);
					$stmt->execute();
					$count = $stmt->rowCount();

					if ($count <= 0){
						$hash = password_hash( $pwd, PASSWORD_DEFAULT );
						$stmt = $this->_dbh->prepare('INSERT INTO client (name,mail,pwd) VALUES (:clientname, :clientmail, :clientpwd)');
						$stmt->bindparam(':clientname',$name);
						$stmt->bindparam(':clientmail',$mail);
						$stmt->bindparam(':clientpwd',$hash);
						$stmt->execute();
						$count = $stmt->rowCount();

						if ($count > 0){
							return true;
						}else{
							return false;
						}

					}else{
						$this->setErrors("Adresse mail déjà existante ! La création du compte a échoué.");
						return false;//mail existant
					}
				}else{
					$this->setErrors("Votre nom ou votre mot de passe sont trop courts ! Veuillez vérifiez votre saisie SVP.");
					return false;//nom trop court
				}
			}else{
				$this->setErrors("Identifiants non reconnus. Veuillez vérifiez votre saisie SVP.");
				return false;//probleme identifiants
			}
		}else{
			$this->setErrors("Votre adresse mail ne semble pas valide, veuillez vérifiez votre saisie SVP.");
			return false;//mail incorrect
		}
	} 

}

?>