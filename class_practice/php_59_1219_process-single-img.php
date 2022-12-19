
<?php

header('Content-Type: application/json');

// 輸出的格式--
$output = [
    'success' => false,
    'Files' => $_FILES,
    'error' => '',
    'filename' => '',
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


if (!empty($_FILES['avatar'])){
    $f = $_FILES['avatar'];

    $ext = isset($extMap[$f['type']]) ? $extMap[$f['type']] : '';
    if (empty($ext)){
        $output['error'] = '檔案類型錯誤';

    } else {
        $fname = sha1($f['name'] . rand()) . $ext;
        if (! move_uploaded_file(
            $f['tmp_name'],
            $path . $fname
        )) {
            $output['error'] = '無法搬移檔案';
        } else {
            $output['success'] = true;
            $output['filename'] = $fname;
        };
    }
};


echo json_encode($output);

// if (!empty($_FILES['avatar']) and is_string($_FILES['avatar']['name'])) { // string: 1 file; array: multiple files

//     // move_uploaded_file 只能針對上傳的檔案--
//     if (move_uploaded_file(
//         $_FILES['avatar']['tmp_name'],
//         './../uploads/' . $_FILES['avatar']['name']
//     )) {
//         $success = true;
//     } else {
//         $error = '無法搬移';
//     };
// };



// echo json_encode([
//     'success' => $success,
//     'FILES' => $_FILES,
//     'error' => $error,
//     'note' => $note
// ]);


?>