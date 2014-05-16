<?php
class Attachment extends AppModel {
		public $actsAs = array(
			'Upload.Upload' => array(
			'photo'=> array(
                'thumbnailSizes' => array(
                    'thumb150' => '150x150',
                    'thumb80' => '80x80',
                ),
                'thumbnailMethod' => 'php',//GDでサムネイル作成
                'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),//許可するmimetype
                'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),//許可する画像の拡張子
                'maxSize' => 2097152, //許可する画像のサイズ 2MB
				)
		)
				);
	//public $belongsTo = "User";
}