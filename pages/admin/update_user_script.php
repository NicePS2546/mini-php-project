<?php
    require_once "../../loginCrud/db_config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $p_url = $_POST['p_url'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role = floatval($_POST['role']);
    $email = $_POST['email'];
    $file = $_FILES['picture'];
    $targetDir = "../../image/upload/$id/";

    $user = $server->getSole($connect, $userInfoTable, $id);
    // Check if the file is uploaded
    $upload_picture = true;
    if (isset($file) && $file['error'] == UPLOAD_ERR_OK) {
        // Call the upload function if a file is uploaded
        if ($user && !empty($user['avatar'])) {
            $oldFile = $targetDir . $user['avatar'];
            
            $upload_picture = $server->upload_pictureById($connect, $userInfoTable,  $id,$file ,$targetDir);
            if($upload_picture && file_exists($oldFile)){
                unlink($oldFile); // Deletes the old file
            };
        }
       
    }

    $callbacks = $server->update_infoByAdmin($connect,$userInfoTable,$table,$fname,$lname,$email,$role,$id);
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    if ($upload_picture && $callbacks) {
        echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "แก้ไขข้อมูลสมาชิกสําเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "'.$p_url.'?p_url='.$p_url.'"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                        }, 1000);
                        </script>';
    } else {
        echo '<script>
        setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    showConfirmButton: true,
                    // timer: 1500
                    }).then(function() {
                window.location = "'.$p_url.'?p_url='.$p_url.'"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
    }
}


?>