<?php

class ContentController { 	
	private $database;
	
    public function __construct() {
        $this->database = new Database;
		$this->database->init();
    }
	
    public function getGroupContents($userGroupID) {
		$sql = 'SELECT * FROM contents JOIN user_groups_contents ON user_groups_contents.id_content = contents.id ';
		$sql .= 'HAVING user_groups_contents.id_user_group = '.$userGroupID;
		$this->database->sqlRaw($sql);	
		return $this->database->getSelectResult();
    }
	
    public function getArticle($contentID, $userGroupID) {
		$sql = 'SELECT * FROM contents JOIN user_groups_contents ON user_groups_contents.id_content = contents.id ';
		$sql .= 'HAVING user_groups_contents.id_user_group = '.$userGroupID.' AND id_content = '.$contentID;
		$this->database->sqlRaw($sql);	
		$result = $this->database->getSelectResult();

		if ($result) {
			return $result[0]['file'];
		} else {
			$sql = 'SELECT * FROM contents JOIN user_groups_contents ON user_groups_contents.id_content = contents.id ';
			$sql .= 'HAVING id_content = '.$contentID;
			$this->database->sqlRaw($sql);	
			$result = $this->database->getSelectResult();
			if ($result) {
				return 'no-grant';
			} else {
				return 'no-content';
			}
		}
    }
}