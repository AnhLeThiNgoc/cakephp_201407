<?php
class Group extends AppModel {
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A groupname is required'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'GroupName has been existed',
				'required' => 'create'
			)
		)
	);
	var $actsAs = array('Acl' => array('type' => 'requester'));

	function parentNode() {
		return null;
	}

}