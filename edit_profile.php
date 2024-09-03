<?php include "user_manage.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }

        .opacity-input {
            width: 70%;
            height: 40px;
            border: 1;
            background: rgba(255, 255, 255, 0.1);
            color: #000;
            padding-left: 0 !important;
            text-indent: 20px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
    </style>
</head>

<body>
    <form action="edit_profile.php">
        <section class="vh-100" style="background-color: #f4f5f7;">
            <div class="container py-5 h-75">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-6 mb-4 mb-lg-0">
                        <div class="card mb-3" style="border-radius: .5rem;">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-white"
                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                        alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                    
                                    
                                    <p><?php echo $fullname ?></p>
                                    <p><?php echo $user_data['role'] == 1 ? "Admin" : "User" ?></p>
                                    <i class="far fa-edit mb-5"></i>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <h6>ข้อมูลโปรไฟล์</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <div class="col-8 mb-3">
                                                <h6>อีเมลล์</h6>
                                                <p class="text-muted"><?php echo $user_data['email'] ?></p>
                                            </div>
                                            <div class="col-8 mb-3">
                                                <h6>ชื่อ</h6>
                                                <input class="form-control opacity-input" style="text-align: start;"
                                                    value="<?php echo $fullname ?>">
                                                    
                                            </div>
                                            <div class="col-8 mb-3">
                                                <h6>เลือกรูปภาพ</h6>
                                                <input type="file"  class="form-control mb-3" id="customFile" />
                                                    
                                            </div>
                                            
                                        </div>

                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <button type="submit" class="btn btn-primary">บันทึก</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </form>
</body>

</html>