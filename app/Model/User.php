<?php
App::uses('AppModel','Model');
App::uses('AuthComponent','Controller/Component');
class User extends AppModel{

/*public $hasMany = array(
        'Image' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'Attachment.model' => 'User',
            ),
        ),
    );*/
	var $name = 'User';
        public $hasMany = 'Attachment';
		


//入力チェック機能
public $validate = array(
	'username' => array(
		array(
			'rule' => 'isUnique',
			'message' => '既に使用されている名前です。'
			),
		array(
			'rule' => 'alphaNumeric',
			'message' => '名前は半角英数字にしてください。'
	),
		array(
			'rule' => array('between',1,10),
			'message' => '名前は１文字以上１０文字以内にしてください。'
)
),
	'password' => array(
		array(
			'rule' => 'alphaNumeric',
			'message' => 'パスワードは半角英数字にしてください。'
			),
		array(
			'rule' => array('between',4,10),
			'message' => 'パスワードは４文字以上１０文字以内にしてください。'
			)
			),
'talk' => array(
            'rule' => 'notEmpty'
        )
			);


	/*public function beforeSave($options = array()) {
		if(!empty($this->data[$this->alias]['pass'])){
		
		$this->data[$this->alias]['pass'] = AuthComponent::password($this->data[$this->alias]['pass']);
}
		return true;
	}*/
	
	public function beforeSave($options = array()) {
		if(!empty($this->data[$this->alias]['password'])){
		
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
}
		return true;
	}
	}
	

