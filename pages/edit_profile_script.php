<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Ensure the session is started
}
include "../loginCrud/db_config.php";
// upload.php
// Directory where images will be stored
$targetDir = "../image/upload/";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['picture'];
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];


    $upload_picture = true;
    $user = $server->getSole($connect, $userInfoTable, $id);
    // Check if the file is uploaded
    if (isset($file) && $file['error'] == UPLOAD_ERR_OK) {
        // Call the upload function if a file is uploaded
        if ($user && !empty($user['avatar'])) {
            $oldFile = $targetDir . $user['avatar'];
            
            $upload_picture = $server->upload_picture($connect, $userInfoTable,  $file, $targetDir,$id);
            if($upload_picture && file_exists($oldFile)){
                unlink($oldFile); // Deletes the old file
            };
        }
       
    }

    $update = $server->update_info($connect, $userInfoTable, $table, $fname, $lname, $email, $id);
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    
    if ($upload_picture && $update) {
        $user = $server->getSole($connect, $userInfoTable, $id);
        $fullname = ((isset($user['fname']) && $user['fname'] != "ยังไม่ได้ตั้ง") && (isset($user['lname']) && $user['lname'] != "ยังไม่ได้ตั้ง"))
                ? $user['fname'] . " " . $user['lname']
                : "ยังไม่ได้ตั้งชื่อ";
        $_SESSION['fullname'] = $fullname;

        echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "แก้ไขสำเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "profile.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    
                });
                    }, 1000);
                    </script>';
        exit();
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
            window.location = "edit_profile.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                });
            }, 1000);
        </script>';
        exit();
    }
} else {
    echo "Invalid request.";
}
?>