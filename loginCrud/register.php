<?php require "session_manage.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center  align-items-center h-100">

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">


                    <form class="d-flex  flex-rows card p-5" action='register_script.php' method='post'>

                        <!-- Email input -->

                        <h4 class="mb-4">Register</h4>
                        <div data-mdb-input-init class="form-outline form-floating mb-4">

                            <input type="text" id="Username" name="username" class="form-control form-control-lg"
                                placeholder="Enter Username" />
                            <label class="form-label" for="Username">Username</label>
                        </div>

                        <div data-mdb-input-init class="form-outline form-floating mb-4">

                            <input type="email" id="email" name="email" class="form-control form-control-lg"
                                placeholder="Enter Email" />
                            <label class="form-label" for="email">Email</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline form-floating mb-3">

                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label class="form-label" for="password">Password</label>
                        </div>



                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Have an account? <a href="login.php"
                                    class="link-danger">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </section>

</body>


</html>