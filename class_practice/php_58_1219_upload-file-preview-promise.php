

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

        function getDataURLByFile(file){
            if (! (file instanceof File)){ // 是否為 File 類型
                throw new Error('必須是 File 類型')
            };

            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = function (){
                    resolve(reader.result);
                };

                reader.onerror = function (error){
                    reject(error);
                };

                reader.readAsDataURL(file);
            })
        }

        f.onchange = async (e) => {
            console.log(f.files);
            myImg.src = await getDataURLByFile(f.files[0]);
        }
    </script>
</body>
</html