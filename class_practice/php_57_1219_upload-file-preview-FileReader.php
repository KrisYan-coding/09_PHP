

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
        <input type="submit">

    </form>
    <img src="" alt="" id="my-img">

    <script>

        const f = document.form1.avatar;
        const myImg = document.querySelector('#my-img');

        f.onchange = (e) => {
            console.log(f.files);

            const reader = new FileReader();

            // reader讀取完內容後--
            reader.onload = function (e){
                console.log(reader.result); // 把照片編碼為字串，可以直接存進資料庫，但體積很大
                myImg.src = reader.result;
            };

            reader.readAsDataURL(f.files[0]);  // 讀取img內容
            // readAsDataURL : read the file's data as a base64 encoded string
        }
    </script>
</body>
</html