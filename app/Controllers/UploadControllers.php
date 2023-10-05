<?php

namespace Huuhuy\DemoSlide5;

class UploadControllers
{
    public static function show()
    {
        echo '<form action="index.php?url=createFile"
 method="post" enctype="multipart/form-data">
               <input name="file" id="fileID" type="file">
               <button type="submit">Upload</button></form>';
    }
    public static function createFile(){
        $uploads = 'uploads/'; // dinh nghia thu muc luu file
        // dinh nghia ten file cung voi dia chi luu file
        // file : thuoc tinh name cua form . basename là hàm lấy ra tên file
        $target_file = $uploads . basename($_FILES['file']['name']);
        // dùng câu lệnh move_uploaded_file . để di chuyển file đc tải lên tới
        // thư mục uploads . tmp_name là thuộc tính chỉ thư mục "tạm" mà server lưu file
        if (move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
            echo 'Upload Thanh cong!!! : '. $target_file;
        }else echo "Upload Loi!!!. Vui long kiem tra lai !!!";
    }
}