<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/chota.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>PMC Registration Portal</title>
</head>

<body>
    <div class="coner">
        <div class="text-center" style="margin-bottom:8px; display: flex; justify-content: center; align-items: center;">
            <img src="assets/logo.png" width="80px" alt="">
            <h4>PMC '21 <br> Registeration Portal</h4>
        </div>
        <h5>Input your pin to proceed</h5>
        <div class="container">
            <form method="GET" action="<?=base_url('pin')?>">
                <div class="mb-3 row">
                    <label for="inputName" class="col-sm-1-12 col-form-label">Pin</label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="pin" id="pin" placeholder="e.g iop0842">
=======
        <h5>Input your pin to proceed</h5>
        <div class="container">
            <form method="GET" action="<?=base_url('pin')?>" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                <div class="mb-3 row" style="align-items: center;">
                    <label for="inputName" class="col-sm-1-12 col-form-label">Pin:</label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" style="width: 200px;" name="pin" id="pin" placeholder="e.g N097C">
>>>>>>> 5b6c122 (2022)
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Begin Registeration</button>
                    </div>
                </div>
            </form>
<<<<<<< HEAD
        </div>
    </div>
    <script src="assets/script.js"></script>
</body>

</html>
=======
        </div>
>>>>>>> 5b6c122 (2022)
