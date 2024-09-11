<?php
require_once '65_41_conDB.php';
include 'header.php';
$center = "style = 'text-align:center; '";
$reservationss = $server->getDataTable($connect,$table);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Data</title>
    

    
</head>

<body>
    <div class="container">
        <h1>Student Records</h1>
        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ชื่อผู้เข้าจอง</th>
                    <th>Email ผู้เข้าจอง</th>
                    <th>จำนวนวันที่เข้าพัก</th>
                    <th>จำนวนผู้เข้าพัก</th>
                    <th>ประเภทห้อง</th>
                    <th>ประเภทลูกค้า</th>
                    <th>ราคา</th>
                    <th>ภาษี</th>
                    <th>รวม</th>
                    <th>ลงวันที่</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            
            foreach ($reservationss as $reservations) {
                $isMember = "";
               if($reservations['member'] === 1 ){
                  $isMember = "สมาชิก";
               }else{
                 $isMember = "ไม่ใช่สมาชิก";
               };

                echo "<tbody><tr>
                    <td $center>" . $reservations['id'] . "</td>
                    <td $center>" . $reservations['reservedBy'] . "</td>
                    <td $center>" . $reservations['email'] . "</td>
                    <td $center>" . $reservations['dayAmount'] . "</td>
                    <td $center>" . $reservations['peopleAmount'] . "</td>
                    <td $center>" . $reservations['roomType'] . "</td>
                    <td $center>" . $isMember . "</td>
                    <td $center>" . $reservations['price'] . "</td>
                    <td $center>" . $reservations['taxFee'] . "</td>
                    <td $center>" . $reservations['total'] . "</td>
                    <td $center>" . $reservations['reg_date'] . "</td>
                    ";
                    
                ?>

                <td >
                    <div class="d-flex gap-2">
                        <form action="edit_form.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $reservations['id']; ?>">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
                    <form action="delete_data.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $reservations['id']; ?>">
                        <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                        <button type="button" class="btn btn-danger delete-button"
                            data-user-id="<?php echo $reservations['id']; ?>">Delete</button>
                    </form>
                    </div>
                </td>

                </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
        <div>
            <a class="btn btn-secondary" href="index.php">ย้อนกลับไปหน้าหลัก</a>
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // let table = new DataTable('#productTable');
        function intializingDataTable(table) {
            $(table).DataTable();
        };

        intializingDataTable('#userTable');


    </script>
<script>
        // ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
        function showDeleteConfirmation(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณจะไม่สามารถเรียกคืนข ้อมูลกลับได ้!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'delete_data.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'id';
                    input.value = id;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        // แนบตัวตรวจจับเหตุการณ์คลิกกับองค์ปุ่ มลบทั้งหมดที่มีคลาส delete-button
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const get_id = button.getAttribute('data-user-id');
                showDeleteConfirmation(get_id);
            });
        });
    </script>

</body>

</html>