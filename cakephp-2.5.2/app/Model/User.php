<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Username has been existed',
                'required' => 'create'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        ),
        'group_id' => array(
            'valid' => array(
                'rule' => array('inList', array('1','2','3')),
                'message' => 'Please enter a valid group_id',
                'allowEmpty' => 'false'
            )
        )

    );

    public function beforeSave($options = array()) {
    	if(isset($this->data[$this->alias]['password'])) {
    		$passwordHasher = new SimplePasswordHasher();
    		$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
    	}
    	return true;
    }

    var $actsAs = array('Acl' => array('type' => 'requester'));

    function parentNode() {
        if(!$this->id && empty($this->data)) {
            return null;
        }
        if(isset($this->data['User']['group_id'])) {
            $groupdId = $this->data['User']['group_id'];
        } else {
            $groupdId = $this->field('group_id');
        }
        if(!$groupdId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupdId));
        }
    }
}