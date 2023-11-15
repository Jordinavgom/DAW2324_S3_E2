<?php
   $servername = "mariadb";
   $username = "root";
   $password = "rootpwd";

class Database {
   private $id;
    public function connect($servername, $username, $password,$database) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function retrieve($conn,$tabla){
        $sql = "SELECT * from {$tabla}";
        $result = $conn->query($sql);
        $datos = array();
        if ($result->num_rows > 0) {
            $i = 0;
          while($row = $result->fetch_assoc()) {
                $datos = $this->returnTabla($tabla,$datos,$i,$row);
                $i++;
            }
          } else {
            echo "0 results";
          }
          return $datos;
     }

     public function update($conn,$apellido,$nombre,$calle,$ciudad,$codigoPostal,$telefono,$id){
        $sql = "UPDATE users SET firstname = '{$apellido}', lastname = '{$nombre}', street_primary = '{$calle}', city = '{$ciudad}', postcode = '{$codigoPostal}', telephone = '{$telefono}' WHERE id_user = {$id}";
        $result = $conn->query($sql);

     }




     public function mostarOrdenado($datos){
        echo '<pre>'; print_r($datos); echo '</pre>';
     }


     public function login($email,$password,$conn){
        $sql = "SELECT * from users where email = '{$email}' and password = '{$password}'";
        $result = $conn->query($sql); 

        if ($result->num_rows > 0) {
            $i = 0;
          while($row = $result->fetch_assoc()) {
            $datos[$i] = [
                "id_user"=> $row["id_user"],
                "email"=> $row["email"],
                "password"=> $row["password"],
                "firstname"=> $row["firstname"],
                "lastname"=> $row["lastname"],
                "street_primary"=> $row["street_primary"],
                "city"=> $row["city"],
                "postcode"=> $row["postcode"],
                "telephone"=> $row["telephone"]
            ];
            $i++;
          }
          return $datos;
        }
     }


     public function insert($conn,$email,$password){
        $sql = "INSERT INTO users (email,password,firstname,lastname,street_primary,city,postcode,telephone)
        VALUES ('{$email}', '{$password}',null,null,null,null,null,null)";
        $result = $conn->query($sql); 
     }

     public function retrieveOne($conn,$tabla,$id){
        $campo = $this->returnCampoId($tabla);
        $sql = "SELECT * from {$tabla} where {$campo}={$id}";
        $result = $conn->query($sql);
        $datos = array();
        if ($result->num_rows > 0) {
            $i = 0;
          while($row = $result->fetch_assoc()) {
            $datos = $this->returnTabla($tabla,$datos,$i,$row);
            $i++;
          }
          return $datos;
          
        } else {
          echo "0 results";
    }
     }



     public function returnTabla($tabla,$datos,$i,$row){
        switch ($tabla) {
            case 'orders':
                $datos[$i] = [
                    "id_order"=> $row["id_order"],
                    "id_user"=> $row["id_user"],
                    "date"=> $row["date"],
                    "status"=> $row["status"]
                ];
                return $datos;
            case 'users':
                $datos[$i] = [
                    "id_user"=> $row["id_user"],
                    "email"=> $row["email"],
                    "password"=> $row["password"],
                    "firstname"=> $row["firstname"],
                    "lastname"=> $row["lastname"],
                    "street_primary"=> $row["street_primary"],
                    "city"=> $row["city"],
                    "postcode"=> $row["postcode"],
                    "telephone"=> $row["telephone"]
                ];
                return $datos;
            case 'products':
                $datos[$i] = [
                    "id_product"=> $row["id_product"],
                    "name"=> $row["name"],
                    "costPrice"=> $row["costPrice"],
                    "image"=> $row["image"],
                    "img_width"=> $row["img_width"],
                    "img_height"=> $row["img_height"]
                ];
                return $datos;
            case 'orderDetails':
                $datos[$i] = [
                    "id_order"=> $row["id_order"],
                    "id_product"=> $row["id_product"],
                    "quantity"=> $row["quantity"],
                    "priceEach"=> $row["priceEach"],
                    "carrier"=> $row["carrier"],
                    "shipping_price"=> $row["shipping_price"]
                ];
                return $datos;    
            default:
                # code...
                break;
        }
     }

     public function returnCampoId($tabla){
        switch ($tabla) {
            case 'orders':
                return "id_order";
            case 'users':
                return "id_user";
            case 'products':
                return "id_product";

              
            
            default:
                # code...
                break;
        }
    }

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
}
?>