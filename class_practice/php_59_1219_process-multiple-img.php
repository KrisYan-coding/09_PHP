
<?php

header('Content-Type: application/json');

// 輸出的格式--
$output = [
    'success' => false,
    'FILES' => $_FILES,
    'errors' => [],
    'filenames' => [],
    'note' => empty($_FILES['avatar'])
];

// 篩選檔案類型，決定副檔名--
$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png'
];

$path = __DIR__ . '/../uploads/'; // __DIR__ 結尾沒有斜線
$success = false;
$error = '';


if (!empty($_FILES['avatar']) and is_array($_FILES['avatar']['name'])){
    $f = $_FILES['avatar'];

    foreach($f['name'] as $k => $name){
        if ($f['error'][$k] === 0) {
            $ext = isset($extMap[$f['type'][$k]]) ? $extMap[$f['type'][$k]] : '';

            if (empty($ext)){
                array_push($output['errors'], "{$name} 檔案格式錯誤");
                continue; // next loop
            };
            
            $fname = sha1($name . rand()) . $ext;
            if (! move_uploaded_file(
                $f['tmp_name'][$k],
                $path . $fname
            )) {
                array_push($output['errors'], "{$name} 無法搬移檔案");
            } else {
                $output['success'] = true;
                array_push($output['filenames'], $fname);
            };
        }
    }
};



echo json_encode($output);




?>