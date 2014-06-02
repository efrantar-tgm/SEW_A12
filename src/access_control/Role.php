<?php
require_once("Permission.php");
require_once("ManageInvitations.php");
require_once("ManageDates.php");
require_once("ManageEvent.php");
require_once("Poll.php");
require_once("../PropelInit.php");

/**
 * This class defines a role for a user with certain permission for an event.
 * @author Elias Frantar
 * @version 24.5.2014
 */
class Role {
	var $permissions;
	
	/**
	 * Creates a new role for the given user and event with the given permissions.
     * @param int[] the types of the permissions this role should habe (only constants from Permission)
     * @param MyUser the user of this role
     * @param Event the event this role is for
   	 */
	public function __construct($permissiontypes, $user, $event) {
		$this->permissions = array();

		foreach($permissiontypes as $permissiontype) {
			switch($permissiontype) {
				case Permission::MANAGE_INVITATIONS:
					$permission = new ManageInvitations($event, $user);
					break;
				case Permission::MANAGE_DATES:
					$permission = new ManageDates($event, $user);
					break;
				case Permission::MANAGE_EVENT:
					$permission = new ManageEvent($event, $user);
					break; 	
				case Permission::POLL:
					$permission = new Poll($event, $user);
					break;		
			}
			$this->permissions[$permissiontype] = $permission;		
		}
	}

	/**
	 * Returns the implementation of the specified permission.
   	 * @param int the type of the permission to return (a constant from Permission)
   	 * @return Permission the implmentation of the given permission-type if exists and this role has access to; NULL otherwise
   	 */
	public function getPermission($permissiontype) {
		return $this->permissions[$permissiontype];
	}
}
?>
