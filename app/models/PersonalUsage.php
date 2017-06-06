<?php 


/**
* ORM model that handels the personal_usage table
*/
class PersonalUsage extends fActiveRecord {

}

if (!fORM::isClassMappedToTable('PersonalUsage')) fORM::mapClassToTable('PersonalUsage', 'personal_usage');
	            