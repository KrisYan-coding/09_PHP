

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form 
    action="./php_56_1219_process-files.php" 
    method="post"
    enctype="multipart/form-data" 
    id="form1"
    name="form1"
    >
        <input type="file" name="avatar" accept="image/*" multiple>
        <!-- accept: 限制 file 類型 -->
        <!-- image/jpeg -->
        <!-- image/jpeg,image/png -->
        <!-- image/* : 主類型為 image -->
        <!-- multiple 才可以多選，name要加[] -->
        <!-- js get FileList : document.forms[0].avatar.files 不會知道檔案路徑(安全性)-->
        <input type="submit">

    </form>

    <script>
        // document.querySelector('#form1').addEventListener('change', (event) => {
        //     console.log(document.form1.avatar.files); // 
        // })

        const f = document.form1.avatar;
        f.onchange = (e) => {
            console.log(f.files);
        }
    </script>
</body>
</html>