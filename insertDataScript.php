<?php
    
    include '65_41_conDB.php';
    

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['reservedBy'];
        $roomType = $_POST['roomType'];
        $email = $_POST['email'];
        $dayAmount = $_POST['dayAmount'];
        $peopleAmount = $_POST['peopleAmount'];
        $isMember = filter_var($_POST['member'], FILTER_VALIDATE_BOOLEAN);
        $price = 0;
        if($roomType === 'normal'){
            $price = 850;
        }else if($roomType === 'deluxe'){
            $price = 1750;
        }else{
            $price = 3500;
        };

       $result = $server->reservation($connect,$table,$dayAmount,$price,$isMember,$name,$email,$peopleAmount,$roomType);

       if ($result) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "เพิ่มข้อมูลสําเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "insertData.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
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
                window.location = "insertData.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
    }
        
    }
    ?>

