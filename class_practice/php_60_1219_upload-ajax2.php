

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form name="form2" onsubmit="return false">
        <input type="text" name="my_img_file" readonly>
        <button onclick="f.click()">選檔案並上傳</button>
        <img src="" alt="" id="my-img">
    </form>

    <form name="form1" onsubmit="return false" style="display: none;">
        <input type="file" name="avatar" accept="image/*">
        <input type="submit">

    </form>
    

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
                document.form2.my_img_file.value = data.filename;
            } else {
                alert(data.error || '沒有上傳檔案');
            }
        }
    </script>
</body>
</html