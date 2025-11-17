<?php
    include '../../../config/connectDatabase.php';
    session_start();
    $email = $_POST['email'];
            $password = $_POST['password'];
        $sql = "SELECT Usuario, ContrasenaHash, Rol FROM Usuarios WHERE Usuario = :email";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($response){
            if(password_verify($password, $response['ContrasenaHash'])){
                $_SESSION['email'] = $response['Usuario'];
                $_SESSION['rol'] = $response['Rol'];
                switch($response['Rol']) {
                    case 'admin': 
                        echo json_encode(['success' => true, 'redirect' => 'admin/dashboard_admin.php']);
                        break;
                    case 'doctor': 
                        echo json_encode(['success' => true, 'redirect' => 'doctor/dashboard_doctor.php']);
                        break;
                    case 'receptionist': 
                        echo json_encode(['success' => true, 'redirect' => 'receptionist/dashboard_receptionist.php']);
                        break;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'La contraseña ingresada es incorrecta']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Parece que ese usuario no existe. Comunícate con director de área para llevar registro de tu cuenta']);
            }
        ?>