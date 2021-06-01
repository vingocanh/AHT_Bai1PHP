
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>Quản lý Account</title>
</head>
<body>
    <div class="container-fluid">
    <h3 class= "">Sửa thành viên</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="fullName">Họ Tên</label>
                <input type="text" class="form-control" name = "name" value="<?php echo $result['name']?>">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" name = "email" value="<?php echo $result['email']?>">
            </div>
            <div class="form-group">
                <label for="Created_date">Created_date</label>
                <input type="date" class="form-control" name = "created_date" value="<?php echo $result['created_date']?>">
            </div>
            <div class="form-group">
                <label for="Updated_date">Created_date</label>
                <input type="date" class="form-control" name = "updated_date" value="<?php echo $result['updated_date']?>">
            </div>
            <button type="submit" name="btnSua" class="btn btn-success">Sửa</button>
        </form>
</div>
</body>
</html>