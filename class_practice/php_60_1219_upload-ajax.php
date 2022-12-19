

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <button onclick="f.click()">選檔案並上傳</button>
    <!-- click button trigger click f=document.form1.avatar -->
    <!-- 按這個 = 按 document.form1.avatar = 選檔案 -->
    <form 
    action="./php_56_1219_process-files.php" 
    method="post"
    enctype="multipart/form-data" 
    id="form1"
    name="form1"
    >
        <input type="file" name="avatar" accept="image/*" multiple>
        <input type="submit">

    </form>
    <img src="" alt="" id="my-img">

    <script>

        const f = document.form1.avatar;
        const myImg = document.querySelector('#my-img');


        // 若有選檔案 or 若有變更檔案--
        f.onchange = async () => {
            const fd = new FormData(document.form1);
            const r = await fetch('php_59_1219_process-single-img.php', {
                method: 'POST',
                body: fd
            });
            console.log(r);

            const data = await r.json();
            console.log(data);

            if (data.success){
                myImg.src = 'http://localhost/09_PHP/uploads/' + data.filename;
            } else {
                alert(data.error || '沒有上傳檔案');
            }
        }
    </script>
</body>
</html