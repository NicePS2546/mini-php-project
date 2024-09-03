<?php
    
 include "loginCrud/65_41_conDB.php";
// upload.php
// Directory where images will be stored
$targetDir = "image/upload/";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['picture'];
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    
    

    // Set default status to true in case no picture is uploaded
    $upload_picture['status'] = true;

    // Check if the file is uploaded
    if (isset($file) && $file['error'] == UPLOAD_ERR_OK) {
        // Call the upload function if a file is uploaded
        if ($user && !empty($user['avatar'])) {
            $oldFile = $targetDir . $user['avatar'];

            // Check if the file exists and delete it
            if (file_exists($oldFile)) {
                unlink($oldFile); // Deletes the old file
            }
        }
        $upload_picture = $server->upload_picture($connect, $userInfoTable, $id, $file, $targetDir);
    }

    $update = $server->update_info($connect,$userInfoTable,$fname,$lname,$id);
    if ($update) {
        $user = $server->getSole($connect,$userInfoTable,$id);
        $fullname = ((isset($user['fname']) && $user['fname'] != "ยังไม่ได้ตั้ง") && (isset($user['lname']) && $user['lname'] != "ยังไม่ได้ตั้ง"))
        ? $user['fname'] . " " . $user['lname']
        : "ยังไม่ได้ตั้งชื่อ";
        session_start();
        $_SESSION['fullname'] = $fullname;
        
    };
   echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
   if ($upload_picture['status'] && $update) {
    echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "แก้ไขข้อมูลสําเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "profile.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    
                });
                    }, 1000);
                    </script>';
    exit();
}  else {
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
